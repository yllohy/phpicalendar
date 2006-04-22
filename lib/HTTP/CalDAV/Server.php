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
 * @version CVS: $Id: Server.php,v 1.6 2006/04/22 22:50:24 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */

require_once 'Tools/ReportParser.php';
require_once 'Tools/ICalendarParser.php';

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
 * @version CVS: $Id: Server.php,v 1.6 2006/04/22 22:50:24 jablko Exp $
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

        /* The request MAY include a Depth header.  If no Depth header is
           included, Depth:0 is assumed. */
        $options['depth'] = 0;
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

        // TODO Make ns_hash a class variable so we can prettify C:
        // Or make getNsName so we can return C:
        $this->propfind_response_helper($options, $files);
    }

    function getProp($reqprop, $file, $options)
    {
        // check if property exists in response
        foreach ($file['props'] as $prop) {
            if ($reqprop['name'] == $prop['name'] &&
                    $reqprop['ns'] == $prop['ns']) {
                return $prop;
            }
        }

        if ($reqprop['name'] == 'lockdiscovery' &&
                $reqprop['ns'] == 'DAV:' &&
                method_exists($this, 'getLocks')) {
            return $this->mkprop('DAV:', 'lockdiscovery',
                $this->getLocks($file['path']));
        }

        if ($reqprop['name'] == 'calendar-data' &&
                $reqprop['ns'] == 'urn:ietf:params:xml:ns:caldav' &&
                method_exists($this, 'get')) {
            $filters = $options['filters'];

            $options = array();
            $options['path'] = $file['path'];

            $status = $this->get($options);
            if (empty($status)) {
                $status = '404 Not Found';
            }

            if ($status !== true) {
                return $this->calDavProp('calendar-data', null, $status);
            }

            if ($options['mimetype'] != 'text/calendar') {
                return $this->calDavProp('calendar-data', null,
                    '404 Not Found');
            }

            if ($options['stream']) {
                $handle = $options['stream'];
            } else if ($options['data']) {
                // What about data?
            } else {
                return $this->calDavProp('calendar-data', null,
                    '404 Not Found');
            }

            $parser = new ICalendarParser($handle, null, $reqprop['value'],
                $filters);
            if (!$parser->success) {
                return $this->calDavProp('calendar-data', null,
                    '404 Not Found');
            }

            return HTTP_CalDAV_Server::calDavProp('calendar-data',
                $parser->comps[count($parser->comps) - 1]);
        }

        // incase the requested property had a value, like calendar-data
        unset($reqprop['value']);
        $reqprop['status'] = '404 Not Found';
        return $reqprop;
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
