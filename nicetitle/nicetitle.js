/*
 * Based on NiceTitle, by Stuart Langridge
 * http://www.kryogenix.org/code/browser/nicetitle/
 */


// Start configuration
var SHOW_LINKS = false; // Set to false to disable showing link URLs
var FOLLOW_MOUSE = true; // Set to false to disable title follows mouse

var MIN_WIDTH = 100; // Min/Max width/height of title
var MAX_WIDTH = 600;
var MIN_HEIGHT = 25;

var SNAP_LENGTH = 25; // Define the length from the edge of the window to snap to
var MOUSE_OFFSET = 15; // Define the distance to place the title from the mouse
// End configuration


// Let the magic begin...
addEvent(window, "load", makeNiceTitles);

// Get script self directory
var src = document.getElementById("nicetitle").src.split("/");
src.pop();
src = src.join("/");

// Pre-load background PNG
(new Image()).src = src + "/ntbg.png";

var XHTMLNS = "http://www.w3.org/1999/xhtml";
var CURRENT_NICE_TITLE;

function makeNiceTitles() {
    if (!document.createElement || !document.getElementsByTagName) return;
    // add namespace methods to HTML DOM; this makes the script work in both
    // HTML and XML contexts.
    if (!document.createElementNS) {
        document.createElementNS = function(ns,elt) {
            return document.createElement(elt);
        }
    }

    if (!document.links) {
        document.links = document.getElementsByTagName("a");
    }
    for (var ti = 0; ti < document.links.length; ti++) {
        var lnk = document.links[ti];
        if (lnk.title) {
            lnk.setAttribute("nicetitle", lnk.title);
            lnk.removeAttribute("title");
            addEvent(lnk, "mouseover", showNiceTitle);
            addEvent(lnk, "mouseover", moveNiceTitle);
            addEvent(lnk, "mouseout", hideNiceTitle);
            addEvent(lnk, "mousemove", moveNiceTitle);
            addEvent(lnk, "mousedown", hideNiceTitle);
            /*
             * Focus and blur events are not quite right. In Mozilla, titles do not show on keyboard focus.
             * This may present an accessibility issue, but it doesn't currently play nice
             * with FOLLOW_MOUSE=true, or mousedown events.
             */
//            addEvent(lnk, "focus", showNiceTitle);
//            addEvent(lnk, "blur", hideNiceTitle);
        }
    }
    var instags = document.getElementsByTagName("ins");
    if (instags) {
        for (var ti = 0; ti < instags.length; ti++) {
            var instag = instags[ti];
            if (instag.dateTime) {
                var strDate = instag.dateTime;
                var dtIns = new Date(
                    strDate.substring(0, 4),
                    parseInt(strDate.substring(4, 6) - 1),
                    strDate.substring(6, 8),
                    strDate.substring(9, 11),
                    strDate.substring(11, 13),
                    strDate.substring(13, 15)
                );
                instag.setAttribute("nicetitle", "Added on " + dtIns.toString());
                addEvent(instag, "mouseover", showNiceTitle);
                addEvent(instag, "mouseover", moveNiceTitle);
                addEvent(instag, "mouseout", hideNiceTitle);
                addEvent(instag, "mousemove", moveNiceTitle);
                addEvent(instag, "mousedown", hideNiceTitle);
//                addEvent(instag, "focus", showNiceTitle);
//                addEvent(instag, "blur", hideNiceTitle);
            }
        }
    }
}

function findPosition(oLink) {
    if (oLink.offsetParent) {
        for (var posX = 0, posY = 0; oLink.offsetParent; oLink = oLink.offsetParent) {
            posX += oLink.offsetLeft;
            posY += oLink.offsetTop;
        }
        return [posX, posY];
    } else {
        return [oLink.x, oLink.y];
    }
}

function get_longest(ary) {
    var l = 0;
    ary.forEach(function(el) {
        if (el.length > l) l = el.length;
    });

    return l;
}

function moveNiceTitle(e) {
    if (!CURRENT_NICE_TITLE) return;
    var d = CURRENT_NICE_TITLE;
    if (e && e.currentTarget && (typeof(e.currentTarget) != "undefined")) {
        var el = e.currentTarget
    }
    else if (window.event && window.event.srcElement) {
        var el = window.event.srcElement
    }

    // Browser size
    var xy = getWindowSize();
    var ww = xy[0];
    var wh = xy[1];

    // Title width and height
    var w = (d.offsetWidth || MIN_WIDTH);
    var h = (d.offsetHeight || MIN_HEIGHT);

    if (FOLLOW_MOUSE) {
        // Mouse position within document (not window)
        var xy = getMousePosition(e);
        var mx = xy[0];
        var my = xy[1];

        // Document scroll position within window
        var xy = getScrollPosition();
        var sx = xy[0];
        var sy = xy[1];

        // Title element position within document
        var x = mx + MOUSE_OFFSET;
        var y = my + MOUSE_OFFSET;
    }
    else {
        // Document scroll position within window
        // Unused
        var sx = 0;
        var sy = 0;

        // Title element position within document
        var elPos = findPosition(el);
        var x = elPos[0];
        var y = elPos[1] + el.offsetHeight + MOUSE_OFFSET;
    }

    // Find out if we've already snapped
    var SNAP_RIGHT = false;
    var SNAP_BOTTOM = false;

    // Snap title to the right side of the window
    if ((x + w + SNAP_LENGTH) >= (ww + sx)) {
        x = ((ww + sx) - w - SNAP_LENGTH);
        SNAP_RIGHT = true;
    }

    // Snap title to the bottom of the window
    if ((y + h + SNAP_LENGTH) >= (wh + sy)) {
        y = ((wh + sy) - h - SNAP_LENGTH);
        SNAP_BOTTOM = true;
    }

    // Ensure mouse can never enter the title in the lower right corner of the window
    if (FOLLOW_MOUSE && SNAP_RIGHT && SNAP_BOTTOM) {
        y = (my - MOUSE_OFFSET - h);
    }
    else if (!FOLLOW_MOUSE && SNAP_BOTTOM) {
        y = elPos[1] - h - MOUSE_OFFSET;
    }

    d.style.left = x + "px";
    d.style.top = y + "px";
}

function showNiceTitle(e) {
    if (CURRENT_NICE_TITLE) hideNiceTitle(CURRENT_NICE_TITLE);
    if (!document.getElementsByTagName) return;
    if (e && e.currentTarget && (typeof(e.currentTarget) != "undefined")) {
        var lnk = e.currentTarget
    }
    else if (window.event && window.event.srcElement) {
        var lnk = window.event.srcElement
    }

    if (!lnk) return;
    if (lnk.nodeName.toUpperCase() != "A") {
        // lnk is not actually the link -- ascend parents until we hit a link
        lnk = getParent(lnk, "A");
    }
    if (!lnk) return;
    var nicetitle = lnk.getAttribute("nicetitle");

    var d = document.createElementNS(XHTMLNS, "div");
    d.style.display = "none";
    d.className = "nicetitle";

    var nicetitle_parts = nicetitle.split("\n");
    nicetitle_parts.forEach(function(textpart) {
        var pat = document.createElementNS(XHTMLNS, "p");
        pat.className = "titletext";
        var tnt = document.createTextNode(textpart);
        pat.appendChild(tnt);
        var brk = document.createElementNS(XHTMLNS, "br");
        pat.appendChild(brk);
        d.appendChild(pat);
    });

    if (lnk.href && SHOW_LINKS) {
        var tnd = document.createTextNode(lnk.href);
        pad = document.createElementNS(XHTMLNS, "p");
        pad.className = "destination";
        pad.appendChild(tnd);
        d.appendChild(pad);
    }

    var l = get_longest(nicetitle_parts);

    // Approximate pixel width of longest line in the title
    var w = ((lnk.href && SHOW_LINKS) ? lnk.href.length : 0) * 6;
    var t = (l ? l : 0) * 8;

    // Use the greatest width: title text, link URL, or MIN_WIDTH. Limited to MAX_WIDTH
    w = ((w > MIN_WIDTH) ? w : MIN_WIDTH);
    w = ((w > t) ? w : t);
    w = ((w > MAX_WIDTH) ? MAX_WIDTH : w);
    d.style.width = w + "px";

    document.getElementsByTagName("body")[0].appendChild(d);
    d.style.display = "block";

    CURRENT_NICE_TITLE = d;
    moveNiceTitle(e);
}

function hideNiceTitle(e) {
    if (!document.getElementsByTagName) return;
    if (CURRENT_NICE_TITLE) {
        document.getElementsByTagName("body")[0].removeChild(CURRENT_NICE_TITLE);
        CURRENT_NICE_TITLE = null;
    }
}

// Add an eventListener to browsers that can do it somehow.
// Originally by the amazing Scott Andrew.
function addEvent(obj, evType, fn) {
    if (obj.addEventListener) {
        obj.addEventListener(evType, fn, false);
        return true;
    } else if (obj.attachEvent) {
        return obj.attachEvent("on" + evType, fn);
    } else {
        return false;
    }
}

function getParent(el, pTagName) {
	if (el == null) return null;
	else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())
		return el;
	else
		return getParent(el.parentNode, pTagName);
}

function getMousePosition(e) {
    var x = 0;
    var y = 0;

    if (e && (typeof(window.scrollX) != "undefined")) {
        x = e.clientX + window.scrollX;
        y = e.clientY + window.scrollY;
    }
    else if (window.event) {
        x = window.event.clientX + document.documentElement.scrollLeft;
        y = window.event.clientY + document.documentElement.scrollTop;
    }

    return [x, y];
}

function getScrollPosition() {
    var x = 0;
    var y = 0;

    if ((typeof(window.scrollX) != "undefined") &&
        (typeof(window.scrollY) != "undefined")) {
        x = window.scrollX;
        y = window.scrollY;
    }
    else if ((typeof(document.documentElement.scrollLeft) != "undefined") &&
             (typeof(document.documentElement.scrollTop) != "undefined")) {
        x = document.documentElement.scrollLeft;
        y = document.documentElement.scrollTop;
    }

    return [x, y];
}

function getWindowSize() {
    var x = 0;
    var y = 0;

    if ((typeof(window.innerWidth) != "undefined") &&
        (typeof(window.innerHeight) != "undefined")) {
        x = window.innerWidth;
        y = window.innerHeight;
    }
    else if ((typeof(document.documentElement.clientWidth) != "undefined") &&
             (typeof(document.documentElement.clientHeight) != "undefined")) {
        x = document.documentElement.clientWidth;
        y = document.documentElement.clientHeight;
    }

    return [x, y];
}

// IE does not support the Array.forEach() method... Try to approximate it
if (!Array.prototype.forEach) {
    Array.prototype.forEach = function(action, context) {
        var len = this.length;
        for (var i = 0; i < len; i++) {
            if (this[i] != undefined) action(this[i], context);
        }
    };
}
