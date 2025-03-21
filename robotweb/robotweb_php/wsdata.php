<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Simple WebSocket Client</title>
    <link rel="stylesheet" type="text/css" href="css/wsdata.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<?php
include_once("nav.php");
?>



<div id="content">
    <fieldset>
        <legend>Server Location</legend>
        <div class="option_row">
            <label>URL history:</label>
            <select id="urlHistory"></select>
            <button id="delButton">Del</button>
        </div>
        <div class="option_row">
            <label>Favorites:</label>
            <select id="favorites"></select>
            <button id="favApplyButton">Apply</button>
            <button id="favDelButton">Del</button>
        </div>
        <div class="option_row">
            <label>URL:</label>
            <input type="text" id="serverSchema" value="wss"/>&nbsp;&#58;&#47;&#47;
            <input type="text" id="serverHost" value="echo.websocket.org"/>&nbsp;&#58;
            <input type="text" id="serverPort" value=""/>&nbsp;&#47;
            <input type="text" id="serverPath" value=""/>&nbsp;&#63;
            <input type="text" id="serverParams" value=""/>
            <button id="parseURLButton">parse new URL</button>
        </div>
        <div class="option_row">
            <label>Binary type:</label>
            <select id="binaryType">
                <option value="">-</option>
                <option value="arraybuffer">arraybuffer</option>
            </select>
            <button id="connectButton">Open</button>
            <button id="disconnectButton" class="hidden">Close</button>
            <button id="favAddButton">Add to favorites</button>
        </div>
        <div class="option_row">
            <label>Status:</label>
            <span id="connectionStatus">CLOSED</span>
        </div>
    </fieldset>
    <fieldset>
        <legend>Request</legend>
        <div>
            <textarea id="sendMessage"></textarea>
        </div>
        <div>
            <button id="sendButton" disabled="disabled">Send</button>&nbsp;
            <span id="sendButtonHelp" class="disabledText">(Ctrl + Enter)</span>
        </div>
    </fieldset>
    <div class="option_row">
        <label>Show last&nbsp;<input type="text" id="lastMsgsNum">&nbsp;messages (default: 1000)</label>
    </div>
    <div class="option_row">
        <label>Show message timestamp milliseconds:&nbsp;<input type="checkbox" id="showMsgTsMilliseconds"></label>
    </div>
    <div class="option_row">
        <label>Show message panel:&nbsp;<input type="checkbox" id="viewMessageChk"></label> (Ctrl/Meta + click on message)
    </div>
    <fieldset>
        <legend>
            Message Log
            <button id="clearMessage">Clear</button>&nbsp;
            <label>Filter&nbsp;<input type="text" id="filterMessage"></label>
        </legend>
        <div id="messages"></div>
        <div id="viewMessage" class="viewMessage hidden"></div>
    </fieldset>
</div>
<script src="js/jquery.slim.min.js"></script>
<script src="js/json-format-highlight.js"></script>
<script src="js/wsdata.js"></script>
</body>
</html>
