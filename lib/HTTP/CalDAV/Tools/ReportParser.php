<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Helper for parsing REPORT request bodies
 *
 * Long description for file (if any)...
 *
 * PHP versions 4 & 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License & are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately
 *
 * @category HTTP
 * @package HTTP_CalDAV_Server
 * @author Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 The PHP Group
 * @license PHP License 3.0 http://www.php.net/license/3_0.txt
 * @version CVS: $Id: ReportParser.php,v 1.4 2006/04/18 03:22:12 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */

/**
 * Helper for parsing REPORT request bodies
 *
 * Long description
 *
 * @category HTTP
 * @package HTTP_CalDAV_Server
 * @author Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 The PHP Group
 * @license PHP License 3.0 http://www.php.net/license/3_0.txt
 * @version CVS: $Id: ReportParser.php,v 1.4 2006/04/18 03:22:12 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */
class ReportParser
{
    /**
     * Success state flag
     *
     * @var bool
     * @access public
     */
    var $success = false;

    /**
     * Name of the requested report
     *
     * @var string
     * @access public
     */
    var $report;

    /**
     * Found properties are collected here
     *
     * @var array
     * @access public
     */
    var $props = array();

    /**
     * Found filters are collected here
     *
     * @var array
     * @access public
     */
    var $filters = array();

    /**
     * Stack of ancestor tag names
     *
     * @var array
     * @access private
     */
    var $_names = array();

    /**
     * Stack of component data
     *
     * @var array
     * @access private
     */
    var $_comps = array();

    /**
     * Constructor
     *
     * @param string path to report input data
     * @access public
     */
    function ReportParser($input)
    {
        // FIXME Take a handle, not a path
        $handle = fopen($input, 'r');
        if (!$handle) {
            return;
        }

        $parser = xml_parser_create_ns('UTF-8', ' ');
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
        xml_set_element_handler($parser, array(&$this, '_startElement'),
            array(&$this, '_endElement'));

        $this->success = true;
        while (($line = fgets($handle, 4096)) !== false) {
            $this->success = xml_parse($parser, $line);
            if (!$this->success) {
                return;
            }
        }

        if (!feof($handle)) {
            $this->success = false;
            return;
        }

        xml_parser_free($parser);
        fclose($handle);

        if (empty($this->props)) {
            $this->props = 'allprop';
        }
    }

    /**
     * Start tag handler
     *
     * @param object parser
     * @param string tag name
     * @param array tag attributes
     * @access private
     */
    function _startElement($parser, $name, $attrs)
    {
        $nameComponents = explode(' ', $name);
        if (count($nameComponents) > 2) {
            $this->success = false;
            return;
        }

        if (count($nameComponents) == 2) {
            list ($ns, $name) = $nameComponents;
            if (empty($ns)) {
                $this->success = false;
                return;
            }
        }

        if (empty($this->_names)) {
            $this->report = $name;
            $this->_names[] = $name;
            return;
        }

        if (count($this->_names) == 1 &&
                ($name == 'allprop' || $name == 'propname')) {
            $this->props = $name;
            $this->_names[] = $name;
            return;
        }

        if (count($this->_names) == 2 && end($this->_names) == 'prop') {
            $prop = array('name' => $name, 'ns' => $ns);

            if ($name == 'calendar-data') {
                $prop['value'] = array();
                $this->_comps[] =& $prop['value'];
            }

            $this->props[] = $prop;
            $this->_names[] = $name;
            return;
        }

        if ($name == 'comp') {
            if (!is_array($this->_comps[count($this->_comps) - 1]['comps'])) {
                $this->_comps[count($this->_comps) - 1]['comps'] = array();
            }

            $this->_comps[count($this->_comps) - 1]['comps'][$attrs['name']] =
                array();
            $this->_comps[] =& $this->_comps[count($this->_comps) - 1]['comps']
                [$attrs['name']];
            $this->_names[] = $name;
            return;
        }

        if (end($this->_names) == 'comp' && $name == 'prop') {
            if (!is_array($this->_comps[count($this->_comps) - 1]['props'])) {
                $this->_comps[count($this->_comps) - 1]['props'] = array();
            }

            $this->_comps[count($this->_comps) - 1]['props'][] = $attrs['name'];
            $this->_names[] = $name;
            return;
        }

        if (count($this->_names) == 1 && $name == 'filter') {
            $this->_comps[] =& $this->filters;
            $this->_names[] = $name;
            return;
        }

        if ($name == 'comp-filter') {
            if (!is_array($this->_comps[count($this->_comps) - 1]['comps'])) {
                $this->_comps[count($this->_comps) - 1]['comps'] = array();
            }

            $this->_comps[count($this->_comps) - 1]['comps'][$attrs['name']] =
                array();
            $this->_comps[] =& $this->_comps[count($this->_comps) - 1]['comps']
                [$attrs['name']];
            $this->_names[] = $name;
            return;
        }

        if (end($this->_names) == 'comp-filter') {
            if (!is_array($this->_comps[count($this->_comps) - 1]['filters'])) {
                $this->_comps[count($this->_comps) - 1]['filters'] = array();
            }

            $this->_comps[count($this->_comps) - 1]['filters'][] =
                array('name' => $name, 'value' => $attrs);
            $this->_names[] = $name;
            return;
        }

        $this->_names[] = $name;
    }

    /**
     * End tag handler
     *
     * @param object parser
     * @param string tag name
     * @param array tag attributes
     * @access private
     */
    function _endElement($parser, $name) {
        $nameComponents = explode(' ', $name);
        if (count($nameComponents) > 2) {
            $this->success = false;
            return;
        }

        if (count($nameComponents) == 2) {
            list ($ns, $name) = $nameComponents;
            if (empty($ns)) {
                $this->success = false;
                return;
            }
        }

        // Any need to pop at end of calendar-data?
        // Yes - $this->_comps is re-used for parsing filters
        if ($name == 'comp' || $name == 'calendar-data' ||
                $name == 'comp-filter' || $name == 'filter') {
            array_pop($this->_comps);
        }

        array_pop($this->_names);
    }
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-handling-comment-ender-p: nil
 * End:
 */

?>
