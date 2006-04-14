<?php
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Hartmut Holzgraefe <hholzgra@php.net>                       |
// |          Christian Stocker <chregu@bitflux.ch>                       |
// +----------------------------------------------------------------------+
//
// $Id: _parse_propfind.php,v 1.2 2006/04/14 02:50:10 jablko Exp $

/**
 * helper class for parsing PROPFIND request bodies
 *
 * @package HTTP_WebDAV_Server
 * @author Hartmut Holzgraefe <hholzgra@php.net>
 * @version 0.99.1dev
 */
class _parse_propfind
{
    /**
     * success state flag
     *
     * @var bool
     * @access public
     */
    var $success = false;

    /**
     * found properties are collected here
     *
     * @var array
     * @access public
     */
    var $props = false;

    /**
     * internal tag nesting depth counter
     *
     * @var int
     * @access private
     */
    var $depth = 0;

    /**
     * constructor
     *
     * @access public
     */
    function _parse_propfind($input)
    {
        // success state flag
        $this->success = true;

        // property storage array
        $this->props = array();

        // internal tag depth counter
        $this->depth = 0;

        // remember if any input was parsed
        $had_input = false;

        // open input stream
        $handle = fopen($input, 'r');
        if (!$handle) {
            $this->success = false;
            return;
        }

        // create XML parser
        $parser = xml_parser_create_ns('UTF-8', ' ');

        // set tag and data handlers
        xml_set_element_handler($parser, array(&$this, '_startElement'),
            array(&$this, '_endElement'));

        // we want a case sensitive parser
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);

        // parse input
        while ($this->success && !feof($handle)) {
            $line = fgets($handle);
            if (is_string($line)) {
                $had_input = true;
                $this->success &= xml_parse($parser, $line, false);
            }
        }

        // finish parsing
        if ($had_input) {
            $this->success &= xml_parse($parser, '', true);
        }

        // free parser
        xml_parser_free($parser);

        // close input stream
        fclose($handle);

        // if no input was parsed it was a request
        if (empty($this->props)) {
            $this->props = 'allprop';
        }
    }

    /**
     * start tag handler
     *
     * @access private
     * @param resource parser
     * @param string tag name
     * @param array tag attributes
     */
    function _startElement($parser, $name, $attrs)
    {
        // name space handling
        if (strstr($name, ' ')) {
            list ($ns, $name) = explode(' ', $name);
            if (!$ns) {
                $this->success = false;
            }
        }

        // special tags at level 1: <allprop> and <propname>
        if ($this->depth == 1) {
            if ($name == 'allprop' || $name == 'propname') {
                $this->props = $name;
            }
        }

        // requested properties are found at level 2
        if ($this->depth == 2) {
            $prop = array('name' => $name);
            if ($ns) {
                $prop['ns'] = $ns;
            }
            $this->props[] = $prop;
        }

        // increment depth count
        $this->depth++;
    }

    /**
     * end tag handler
     *
     * @access private
     * @param resource parser
     * @param string tag name
     */
    function _endElement($parser, $name)
    {
        // here we only need to decrement the depth count
        $this->depth--;
    }
}
?>
