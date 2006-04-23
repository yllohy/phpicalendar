<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Helper for parsing iCalendar format
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
 * @version CVS: $Id: ICalendarParser.php,v 1.3 2006/04/23 20:09:50 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */

/**
 * Helper for parsing iCalendar format
 *
 * Long description
 *
 * @category HTTP
 * @package HTTP_CalDAV_Server
 * @author Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 The PHP Group
 * @license PHP License 3.0 http://www.php.net/license/3_0.txt
 * @version CVS: $Id: ICalendarParser.php,v 1.3 2006/04/23 20:09:50 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */
class ICalendarParser
{
    /**
     * Input stream handle
     *
     * @var resource
     * @access private
     */
    var $_handle;

    /**
     * Line of input
     *
     * @var string
     * @access private
     */
    var $_line;

    /**
     * Offset of line
     *
     * @var int
     * @access private
     */
    var $_offset;

    /**
     * Success state flag
     *
     * @var bool
     * @access public
     */
    var $success = true;

    /**
     * Parsed components are collected here in post-order
     *
     * @var array
     * @access public
     */
    var $comps = array();

    /**
     * Parsed components' offsets are collected here in post-order
     *
     * @var array
     * @access public
     */
    var $offsets = array();

    /**
     * Component stack for parsing nested components
     *
     * @var array
     * @access private
     */
    var $_compStack = array();

    /**
     * Begin offset stack for tracking start offsets of nested components
     *
     * @var array
     * @access private
     */
    var $_startOffsetStack = array();

    /**
     * Offsets stack for parsing within specific ranges
     *
     * @var array
     * @access private
     */
    var $_offsetStack = array();

    /**
     * Value stack for parsing only specific components & properties
     *
     * @var array
     * @access private
     */
    var $_valueStack = array();

    /**
     * Filter stack for parsing only components & properties which match
     * specific filters
     *
     * @var array
     * @access private
     */
    var $_filterStack = array();

    /**
     * Parse RFC2445 date-time
     *
     * May eventually get moved someplace more appropriate
     * TODO Timezone support
     *
     * @param string RFC2445 date-time
     * @return int timestamp
     * @access public
     */
    function datetime_to_timestamp($datetime)
    {
        return gmmktime(substr($datetime, 9, 2), substr($datetime, 11, 2), substr($datetime, 13, 2), substr($datetime, 4, 2), substr($datetime, 6, 2), substr($datetime, 0, 4));
    }

    /**
     * Constructor
     *
     * @param resource input stream handle
     * @access public
     */
    function ICalendarParser($handle, $offsets=null, $value=null, $filters=null)
    {
        $this->_handle = $handle;
        $this->_offsetStack[] = $offsets;

        // FIXME Separate comps & props stacks?
        $this->_valueStack[] = array('comps' => $value);
        $this->_filterStack[] = $filters;
        while ($this->success &&
                ($this->_offset = ftell($this->_handle)) !== false &&
                ($this->_line = fgets($this->_handle, 4096)) !== false) {
            if (is_array($this->_offsetStack[count($this->_offsetStack) - 1]['offsets'])) {
                if ($this->_offset > $this->_offsetStack[count($this->_offsetStack) - 1]['offsets'][0][1]) {
                    if (array_shift($this->_offsetStack[count($this->_offsetStack) - 1]['offsets']) !== null) {
                        if (fseek($this->_offsetStack[count($this->_offsetStack) - 1]['offsets'][0][0])) {
                            $this->success = false;
                            return;
                        }

                        continue;
                    }

                    if (!empty($this->_compStack)) {
                        $name = $this->_compStack[count($this->_compStack) - 1]->name;
                        while (($line = fgets($this->_handle, 4096)) !== false) {
                            if (trim($line) == "END:$name") {
                                return;
                            }
                        }

                        $this->_endComp($name);
                        continue;
                    }

                    return;
                }
            }

            $line = explode(':', trim($this->_line));

            if ($line[0] == 'BEGIN') {
                $this->_startComp($line[1]);
                continue;
            }

            if ($line[0] == 'END') {
                $this->_endComp($line[1]);
                continue;
            }

            $line[0] = explode(';=', $line[0]);
            $name = array_shift($line[0]);
            if (is_array($this->_valueStack[count($this->_valueStack) - 1]['props']) && !in_array($name, $this->_valueStack[count($this->_valueStack) - 1]['props'])) {
                continue;
            }

            $params = array();
            while (!empty($line[0])) {
                $params[array_shift($line[0])] = array_shift($line[0]);
            }
            $this->_compStack[count($this->_compStack) - 1]->add_property($name, $line[1], $params);
        }

        if (!feof($this->_handle)) {
            $this->success = false;
        }
    }

    function _startComp($name)
    {
        if (is_array($this->_valueStack[count($this->_valueStack) - 1]['comps']) &&
                !isset($this->_valueStack[count($this->_valueStack) - 1]['comps'][$name])) {
            while (($line = fgets($this->_handle, 4096)) !== false) {
                if (trim($line) == "END:$name") {
                    return;
                }
            }

            $this->success = false;
            return;
        }

        $class = 'iCalendar_' . ltrim(strtolower($name), 'v');
        if ($name == 'VCALENDAR') {
            $class = 'iCalendar';
        }

        if (!class_exists($class)) {
            while (($line = fgets($this->_handle, 4096)) !== false) {
                if (trim($line) == "END:$name") {
                    return;
                }
            }

            $this->success = false;
            return;
        }

        $this->_compStack[] = new $class;
        $this->_startOffsetStack[] = $this->_offset;
        $this->_offsetStack[] = $this->_offsetStack[count($this->_offsetStack) - 1]['comps'][$name];
        $this->_valueStack[] = $this->_valueStack[count($this->_valueStack) - 1]['comps'][$name];
        $this->_filterStack[] = $this->_filterStack[count($this->_filterStack) - 1]['comps'][$name];
    }

    function _endComp($name)
    {
        if ($name != $this->_compStack[count($this->_compStack) - 1]->name) {
            $this->success = false;
            return;
        }

        if (is_array($this->_filterStack[count($this->_filterStack) - 1]['filters'])) {
            foreach ($this->_filterStack[count($this->_filterStack) - 1]['filters'] as $filter) {
                if ($filter['name'] == 'time-range') {
                    if ($filter['value']['start'] > $this->_compStack[count($this->_compStack) - 1]->properties['DTEND'][0]->value || $filter['value']['end'] < $this->_compStack[count($this->_compStack) - 1]->properties['DTSTART'][0]->value) {
                        array_pop($this->_compStack);
                        array_pop($this->_startOffsetStack);
                        array_pop($this->_offsetStack);
                        array_pop($this->_valueStack);
                        array_pop($this->_filterStack);
                        return;
                    }
                }
            }
        }

        if (count($this->_compStack) > 1 && !$this->_compStack[count($this->_compStack) - 2]->add_component($this->_compStack[count($this->_compStack) - 1])) {
            $this->success = false;
            return;
        }

        if (($offset = ftell($this->_handle)) === false) {
            $this->success = false;
            return;
        }

        $this->comps[] = array_pop($this->_compStack);
        $this->offsets[] = array(array_pop($this->_startOffsetStack), $offset);
        array_pop($this->_offsetStack);
        array_pop($this->_valueStack);
        array_pop($this->_filterStack);
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
