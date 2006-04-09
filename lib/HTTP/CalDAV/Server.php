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
 * @version CVS: $Id: Server.php,v 1.1 2006/04/09 19:43:59 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */

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
 * @version CVS: $Id: Server.php,v 1.1 2006/04/09 19:43:59 jablko Exp $
 * @link http://pear.php.net/package/HTTP_CalDAV_Server
 * @see HTTP_WebDAV_Server
 */
class HTTP_CalDAV_Server extends HTTP_WebDAV_Server
{

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

        return true;
    }

    /**
     * REPORT response helper - format REPORT response
     *
     * @param options
     * @return void
     * @access public
     */
    function report_response_helper($options, $responses)
    {
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
        // prepare data-structure from REPORT request
        if (!$this->report_request_helper($options)) {
            return;
        }

        // call user handler
        if (!$this->report($options, $responses)) {
            return;
        }

        // format REPORT response
        $this->report_response_helper($options, $responses);
    }

    /**
     * Make a property in the CalDAV namespace
     *
     * @param string property name
     * @param string property value
     * @return array string property namespace
     *               string property name
     *               string property value
     */
    function calDavProp($name, $value=null) {
        return $this->mkprop('urn:ietf:params:xml:ns:caldav', $name, $value);
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
