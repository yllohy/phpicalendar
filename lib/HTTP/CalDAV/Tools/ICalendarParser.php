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
 * @version CVS: $Id: ICalendarParser.php,v 1.1 2006/04/18 03:22:12 jablko Exp $
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
 * @version CVS: $Id: ICalendarParser.php,v 1.1 2006/04/18 03:22:12 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */
class ICalendarParser
{
    /**
     * Success state flag
     *
     * @var bool
     * @access public
     */
    var $success = false;

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
     * Constructor
     *
     * @param resource input stream handle
     * @access public
     */
    function ICalendarParser($handle, $beginOffset=null, $endOffset=null,
        $value=null, $filters=null)
    {
        $comps = array();
        $beginOffsets = array();
        $compValues = array($value);
        $compFilters = array($filters);
        $this->success = true;
        while (($offset = ftell($handle)) !== false &&
                ($line = fgets($handle, 4096)) !== false) {
            if (isset($endOffset) && $offset > $endOffset) {
                return;
            }

            $line = explode(':', trim($line));

            if ($line[0] == 'END') {
                if ($line[1] != $comps[count($comps) - 1]->name) {
                    $this->success = false;
                    return;
                }

                if (is_array($compFilters[count($compFilters) - 1]['filters'])) {
                    foreach ($compFilters[count($compFilters) - 1]['filters'] as $filter) {
                        if ($filter['name'] == 'time-range') {
                            if ($filter['value']['start'] > $comps[count($comps) - 1]->properties['DTEND'][0]->value || $filter['value']['end'] < $comps[count($comps) - 1]->properties['DTSTART'][0]->value) {
                                array_pop($compValues);
                                array_pop($compFilters);
                                continue;
                            }
                        }
                    }
                }

                if (count($comps) > 1 &&
                        !$comps[count($comps) - 2]->add_component($comps[count(
                        $comps) - 1])) {
                    $this->success = false;
                    return;
                }

                if (($offset = ftell($handle)) === false) {
                    $this->success = false;
                    return;
                }

                $this->comps[] = array_pop($comps);
                $this->offsets[] = array(array_pop($beginOffsets), $offset);
                array_pop($compValues);
                array_pop($compFilters);
                continue;
            }

            if ($line[0] == 'BEGIN') {
                $compName = $line[1];
                if (is_array($compValues[count($compValues) - 1]['comps']) &&
                        !isset($compValues[count($compValues) - 1]['comps'][$compName])) {
                    while (($line = fgets($handle, 4096)) !== false) {
                        if (trim($line) == "END:$compName") {
                            continue (2);
                        }
                    }

                    $this->success = false;
                    return;
                }

                $className = 'iCalendar_' . ltrim(strtolower($compName), 'v');
                if ($line[1] == 'VCALENDAR') {
                    $className = 'iCalendar';
                }

                if (!class_exists($className)) {
                    while (($line = fgets($handle, 4096)) !== false) {
                        if (trim($line) == "END:$compName") {
                            continue (2);
                        }
                    }

                    $this->success = false;
                    return;
                }

                $comps[] = new $className;
                $beginOffsets[] = $offset;
                $compValues[] = $compValues[count($compValues) - 1]['comps'][$compName];
                $compFilters[] = $compFilters[count($compFilters) - 1]['comps'][$compName];
                continue;
            }

            $line[0] = explode(';=', $line[0]);
            $propName = array_shift($line[0]);
            if (is_array($compValues[count($compValues) - 1]['props']) &&
                    !in_array($propName,
                    $compValues[count($compValues) - 1]['props'])) {
                continue;
            }

            $params = array();
            while (!empty($line[0])) {
                $params[array_shift($line[0])] = array_shift($line[0]);
            }
            $comps[count($comps) - 1]->add_property($propName, $line[1], $params);
        }

        if (!feof($handle)) {
            $this->success = false;
        }
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
