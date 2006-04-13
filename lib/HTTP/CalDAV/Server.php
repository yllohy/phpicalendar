<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CalDav Server class
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
 * @version CVS: $Id: Server.php,v 1.3 2006/04/13 21:14:17 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */

require_once 'Tools/ReportParser.php';

/**
 * CalDav Server class
 *
 * Long description
 *
 * @category HTTP
 * @package HTTP_CalDAV_Server
 * @author Jack Bates <ms419@freezone.co.uk>
 * @copyright 2006 The PHP Group
 * @license PHP License 3.0 http://www.php.net/license/3_0.txt
 * @version CVS: $Id: Server.php,v 1.3 2006/04/13 21:14:17 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */
class HTTP_CalDAV_Server extends HTTP_WebDAV_Server
{
    /**
     * Make a property in the CalDAV namespace
     *
     * @param string property name
     * @param string property value
     * @return array string property namespace
     *               string property name
     *               string property value
     */
    function calDavProp($name, $value=null, $status=null) {
        return $this->mkprop('urn:ietf:params:xml:ns:caldav', $name, $value,
            $status);
    }

    /**
     * REPORT request helper - prepares data-structures from REPORT requests
     *
     * @param options
     * @return void
     * @access public
     */
    function report_request_helper(&$options)
    {
        $options = array();
        $options['path'] = $this->path;

        $options['depth'] = 'infinity';
        if (isset($_SERVER['HTTP_DEPTH'])) {
            $options['depth'] = $_SERVER['HTTP_DEPTH'];
        }

        $parser = new ReportParser('php://input');
        if (!$parser->success) {
            $this->http_status('400 Bad Request');
            return;
        }

        $options['props'] = $parser->props;
        $options['filters'] = $parser->filters;

        return true;
    }

    /**
     * REPORT response helper - format REPORT response
     *
     * @param options
     * @return void
     * @access public
     */
    function report_response_helper($options, $files)
    {
        $responses = array();

        // now loop over all returned files
        foreach ($files as $file) {

            // collect namespaces here
            $ns_hash = array('urn:ietf:params:xml:ns:caldav' => 'C');

            $response = array();

            $response['href'] = $this->getHref($file['path']);
            if (isset($file['href'])) {
                $response['href'] = $file['href'];
            }

            $response['propstat'] = array();

            // nothing to do if no properties were returend
            if (isset($file['props']) && is_array($file['props'])) {

                // now loop over all returned properties
                foreach ($file['props'] as $prop) {
                    $status = '200 OK';

                    // as a convenience feature we do not require user handlers
                    // restrict returned properties to the requested ones
                    // here we ignore unrequested entries
                    switch ($options['props']) {
                    case 'propname':

                        // only names of all existing properties were requested
                        // so remove values
                        unset($prop['value']);

                    case 'allprop':
                        if (isset($prop['status'])) {
                            $status = $prop['status'];
                        }

                        if (!isset($response['propstat'][$status])) {
                            $response['propstat'][$status] = array();
                        }

                        $response['propstat'][$status][] = $prop;
                        break;

                    default:

                        // search property name in requested properties
                        foreach($options['props'] as $reqprop) {
                            if ($reqprop['name'] == $prop['name'] &&
                                    $reqprop['ns'] == $prop['ns']) {
                                if (isset($prop['status'])) {
                                    $status = $prop['status'];
                                }

                                if (!isset($response['propstat'][$status])) {
                                    $response['propstat'][$status] = array();
                                }

                                $response['propstat'][$status][] = $prop;
                                break (2);
                            }
                        }

                        continue (2);
                    }

                    // namespace handling
                    if (empty($prop['ns']) || // empty namespace
                            $prop['ns'] == 'DAV:' || // default namespace
                            isset($ns_hash[$prop['ns']])) { // already known
                        continue;
                    }

                    // register namespace
                    $ns_hash[$prop['ns']] = 'ns' . count($ns_hash);
                }
            }

            // also need empty entries for properties requested
            // but for which no values where returned
            if (isset($options['props']) && is_array($options['props'])) {

                // now loop over all requested properties
                foreach ($options['props'] as $reqprop) {
                    $status = '404 Not Found';

                    // check if property exists in result
                    foreach ($file['props'] as $prop) {
                        if ($reqprop['name'] == $prop['name'] &&
                                $reqprop['ns'] == $prop['ns']) {
                            continue (2);
                        }
                    }

                    if ($reqprop['name'] == 'lockdiscovery' &&
                            $reqprop['ns'] == 'DAV:' &&
                            method_exists($this, 'getLocks')) {

                        $status = '200 OK';
                        if (!isset($response['propstat'][$status])) {
                            $response['propstat'][$status] = array();
                        }

                        $response['propstat'][$status][] =
                            $this->mkprop('DAV:', 'lockdiscovery',
                            $this->getLocks($file['path']));
                        continue;
                    }

                    if ($reqprop['name'] == 'calendar-data' &&
                            $reqprop['ns'] == 'urn:ietf:params:xml:ns:caldav' &&
                            method_exists($this, 'get')) {

                        $prop = $this->_calendarData($reqprop, $file, $options);
                        if (isset($prop)) {
                            $status = '200 OK';
                            if (isset($prop['status'])) {
                                $status = $prop['status'];
                            }
                        } else {
                            $prop = HTTP_CalDAV_Server::calDavProp(
                                'calendar-data');
                        }

                        if (!isset($response['propstat'][$status])) {
                            $response['propstat'][$status] = array();
                        }

                        $response['propstat'][$status][] = $prop;
                        continue;
                    }

                    if (!isset($response['propstat'][$status])) {
                        $response['propstat'][$status] = array();
                    }

                    // add empty value for this property
                    $response['propstat'][$status][] =
                        $this->mkprop($reqprop['ns'], $reqprop['name'],
                        null);

                    // namespace handling
                    if (empty($reqprop['ns']) || // empty namespace
                            $reqprop['ns'] == 'DAV:' || // default namespace
                            isset($ns_hash[$reqprop['ns']])) { // already known
                        continue;
                    }

                    // register namespace
                    $ns_hash[$reqprop['ns']] = 'ns' . count($ns_hash);
                }
            }

            $response['ns_hash'] = $ns_hash;
            $responses[] = $response;
        }

        $this->_multistatus($responses);
    }

    /**
     * REPORT method wrapper
     *
     * @param void
     * @return void
     * @access public
     */
    function report_wrapper()
    {
        /* Prepare data-structure from REPORT request */
        if (!$this->report_request_helper($options)) {
            return;
        }

        /* Call user handler */
        if (method_exists($this, 'report')) {
            if (!$this->report($options, $files)) {
                return;
            }
        } else {

            /* Empulate REPORT using PROPFIND */
            if (!$this->propfind($options, $files)) {
                return;
            }
        }

        /* Format REPORT response */
        $this->report_response_helper($options, $files);
    }

    function _calendarData($reqprop, $file, $options)
    {
        $filters = $options['filters'];

        $options = array();
        $options['path'] = $file['path'];

        $status = $this->get($options);
        if (empty($status)) {
            $status = '403 Forbidden';
        }

        if ($status !== true) {
            return HTTP_CalDAV_Server::calDavProp('calendar-data', null,
                $status);
        }

        if ($options['mimetype'] != 'text/calendar') {
            return;
        }

        if ($options['stream']) {
            $handle = $options['stream'];
        } else if ($options['data']) {
            // What about data?
        } else {
            return;
        }

        if (!($value = HTTP_CalDAV_Server::_parseComponent($handle,
            $reqprop['value'], $filters))) {
            return;
        }

        return HTTP_CalDAV_Server::calDavProp('calendar-data', $value);
    }

    function _parseComponent($handle, $value=null, $filters=null)
    {
        $components = array();
        $compValues = array($value);
        $compFilters = array($filters);
        while (($line = fgets($handle, 4096)) !== false) {
            $line = explode(':', trim($line));

            if ($line[0] == 'END') {
                if ($line[1] != $components[key($components)]->name) {
                    return;
                }

                if (is_array($compFilters[key($compFilters)]['filters'])) {
                    foreach ($compFilters[key($compFilters)]['filters'] as $filter) {
print $filter['name'];
                        if ($filter['name'] == 'time-range') {
                            if ($filter['value']['start'] > $components[key($components)]->properties['DTEND'][0]->value || $filter['value']['end'] < $components[key($components)]->properties['DTSTART'][0]->value) {
                                array_pop($compValues);
                                array_pop($compFilters);
                                continue;
                            }
                        }
                    }
                }

                // If we're about to pop the root component, we ignore the rest
                // of our input
                if (count($components) == 1) {
                    return array_pop($components);
                }

                if (!$components[key($components)]->add_component(array_pop($components))) {
                    return;
                }

                array_pop($compValues);
                array_pop($compFilters);
                continue;
            }

            if ($line[0] == 'BEGIN') {
                $compName = $line[1];
var_dump($compName);
var_dump($compValues);
var_dump($compValues[key($compValues)]);
                if (is_array($compValues[key($compValues)]['comps']) &&
                        !isset($compValues[key($compValues)]['comps'][$compName])) {
                    while (($line = fgets($handle, 4096)) !== false) {
                        if (trim($line) == "END:$compName") {
                            continue (2);
                        }
                    }

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

                    return;
                }

                $components[] = new $className;
                end($components);
                $compValues[] = $compValues[key($compValues)]['comps'][$compName];
                end($components);
                $compFilters[] = $compFilters[key($compFilters)]['comps'][$compName];
                end($components);
                continue;
            }

            $line[0] = explode(';=', $line[0]);
            $propName = array_shift($line[0]);
            if (is_array($data['props']) &&
                    !in_array($propName, $data['props'])) {
                continue;
            }

            $params = array();
            while (!empty($line[0])) {
                $params[array_shift($line[0])] = array_shift($line[0]);
            }
            $components[key($components)]->add_property($propName, $line[1], $params);
        }
    }

    function _multistatus($responses)
    {
        // now we generate the response header...
        $this->http_status('207 Multi-Status');
        header('Content-Type: text/xml; charset="utf-8"');

        // ...and payload
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        echo "<D:multistatus xmlns:D=\"DAV:\">\n";

        foreach ($responses as $response) {

            // ignore empty or incomplete entries
            if (!is_array($response) || empty($response)) {
                continue;
            }

            $ns_defs = array();
            foreach ($response['ns_hash'] as $name => $prefix) {
                $ns_defs[] = "xmlns:$prefix=\"$name\"";
            }
            echo ' <D:response ' . implode(' ', $ns_defs) . ">\n";
            echo "  <D:href>$response[href]</D:href>\n";

            // report all found properties and their values (if any)
            // nothing to do if no properties were returend for a file
            if (isset($response['propstat']) &&
                    is_array($response['propstat'])) {

                foreach ($response['propstat'] as $status => $props) {
                    echo "  <D:propstat>\n";
                    echo "   <D:prop>\n";

                    foreach ($props as $prop) {
                        if (!is_array($prop) || !isset($prop['name'])) {
                            continue;
                        }

                        // empty properties (cannot use empty for check as '0'
                        // is a legal value here)
                        if (!isset($prop['value']) || empty($prop['value']) &&
                                $prop['value'] !== 0) {
                            if ($prop['ns'] == 'DAV:') {
                                echo "    <D:$prop[name]/>\n";
                                continue;
                            }

                            if (!empty($prop['ns'])) {
                                echo '    <' .
                                    $response['ns_hash'][$prop['ns']] .
                                    ":$prop[name]/>\n";
                                continue;
                            }

                            echo "    <$prop[name] xmlns=\"\"/>";
                            continue;
                        }

                        // some WebDAV properties need special treatment
                        if ($prop['ns'] == 'DAV:') {

                            switch ($prop['name']) {
                            case 'creationdate':
                                echo "    <D:creationdate ns0:dt=\"dateTime.tz\">\n";
                                echo '     ' . gmdate('Y-m-d\TH:i:s\Z', $prop['value']) . "\n";
                                echo "    </D:creationdate>\n";
                                break;

                            case 'getlastmodified':
                                echo "    <D:getlastmodified ns0:dt=\"dateTime.rfc1123\">\n";
                                echo '     ' . gmdate('D, d M Y H:i:s', $prop['value']) . " GMT\n";
                                echo "    </D:getlastmodified>\n";
                                break;

                            case 'resourcetype':
                                echo "    <D:resourcetype>\n";
                                echo "     <D:$prop[value]/>\n";
                                echo "    </D:resourcetype>\n";
                                break;

                            case 'supportedlock':

                                if (is_array($prop[value])) {
                                    $prop[value] = $this->_lockentries($prop[value]);
                                }
                                echo "    <D:supportedlock>\n";
                                echo "     $prop[value]\n";
                                echo "    </D:supportedlock>\n";
                                break;

                            case 'lockdiscovery':

                                if (is_array($prop[value])) {
                                    $prop[value] = $this->_activelocks($prop[value]);
                                }
                                echo "    <D:lockdiscovery>\n";
                                echo "     $prop[value]\n";
                                echo "    </D:lockdiscovery>\n";
                                break;

                            default:
                                echo "    <D:$prop[name]>\n";
                                echo '     ' . $this->_prop_encode(htmlspecialchars($prop['value'])) . "\n";
                                echo "    </D:$prop[name]>\n";
                            }

                            continue;
                        }

                        if ($prop['name'] == 'calendar-data' &&
                                is_object($prop['value'])) {
                            $prop['value'] = $prop['value']->serialize();
                        }

                        if (!empty($prop['ns'])) {
                            echo '    <' . $response['ns_hash'][$prop['ns']] . ":$prop[name]>\n";
                            echo '     ' . $this->_prop_encode(htmlspecialchars($prop['value'])) . "\n";
                            echo '    </' . $response['ns_hash'][$prop['ns']] . ":$prop[name]>\n";

                            continue;
                        }

                        echo "    <$prop[name] xmlns=\"\">\n";
                        echo '     ' . $this->_prop_encode(htmlspecialchars($prop['value'])) . "\n";
                        echo "    </$prop[name]>\n";
                    }

                    echo "   </D:prop>\n";
                    echo "   <D:status>HTTP/1.1 $status</D:status>\n";
                    echo "  </D:propstat>\n";
                }
            }

            if (isset($response['status'])) {
                echo "  <D:status>HTTP/1.1 $status</D:status>\n";
            }

            if (isset($response['responsedescription'])) {
                echo "  <D:responsedescription>\n";
                echo '   ' . $this->_prop_encode(htmlspecialchars($response['responsedescription'])) . "\n";
                echo "  </D:responsedescription>\n";
            }

            echo " </D:response>\n";
        }

        echo "</D:multistatus>\n";
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
