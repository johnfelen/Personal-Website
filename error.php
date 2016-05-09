<?php
    /*the following $_SERVER index from an .htaccess redirect and and $codes hash map is based off of https://css-tricks.com/snippets/php/error-page-to-handle-all-errors/
    Furthermore the values in the $codes hash map are based on the error code descriptions here http://100pulse.com/http-statuscode/http-status-code-list.jsp*/
    $status = $_SERVER[ "REDIRECT_STATUS" ];
    $codes = [ "400" => [ "Bad Request", "The request could not be understood by the server due to malformed syntax. &nbsp;The client SHOULD NOT repeat the request without modifications. &nbsp;The request contains bad syntax or cannot be fulfilled." ],
    "401" => [ "Authorization Required", "The request requires user authentication. &nbsp;The response MUST include a WWW-Authenticate header field containing a challenge applicable to the requested resource." ],
    "402" => [ "Payment Required", "The 402 status code means that the request is not currently in use and it is , being listed as \"reserved for future use.\"" ],
    "403" => [ "Forbidden", "The server understood the request, but is refusing to fulfill it. &nbsp;Authorization will not help and the request SHOULD NOT be repeated. &nbsp;It is accessing a URL for which you don't have permission." ],
    "404" => [ "Not Found", "This is probably the most common status code. &nbsp;Your browser cannot locate the document corresponding to the URL you entered. &nbsp;An improperly typed URL is usually the cause. &nbsp;The document may also have been moved. &nbsp;If you cannot find it elsewhere on the site, it may have been permanently removed." ],
    "405" => [ "Method Not Allowed", "The method you are using to access the file is not allowed. &nbsp;A request was made of a resource using a request method not supported by that resource;for example, using GET on a form which requires data to be presented via POST, or using PUT on a read-only resource." ],
    "406" => [ "Not Acceptable", "The requested resource is only capable of generating content not acceptable according to the Accept headers sent in the request. &nbsp;A client( e.g. your Web browser ) can indicate to the Web server( running the Web site ) the characteristics of the data it will accept back from the Web server." ],
    "407" => [ "Proxy Authentication Required", "This code is similar to 401( Unauthorized ), but indicates that the client must first authenticate itself with the proxy. &nbsp;The proxy MUST return a Proxy-Authenticate header field containing a challenge applicable to the proxy for the requested resource. &nbsp;The client MAY repeat the request with a suitable Proxy-Authorization header field." ],
    "408" => [ "Request Timeout", "The server timed out waiting for the request( i.e. The client failed to send a request in the time allowed by the server )." ],
    "409" => [ "Conflict", "The request was unsuccessful due to a conflict in the state of the resource. &nbsp;For example, you may get a 409 error if you try to upload a file to the Web server which is older than the one already there - resulting in a version control conflict." ],
    "410" => [ "Gone", "A 410 status code is returned if the new address is altogether unavailable or the server admin does not want to reveal it. &nbsp;Upon receiving a 410 status code, the client should not request the resource again in the future. &nbsp;Clients such as search engines should remove the resource from their indexes." ],
    "411" => [ "Length Required", "The 411 status code occurs when the server refuses to process a request because the content length was not specified." ],
    "412" => [ "Precondition Failed", "A 412 status code indicates that one of the conditions the request was made under has failed. &nbsp;A precondition specified in one or more Request-Header fields returned false." ],
    "413" => [ "Request Entity Too Large", "The 413 status code indicates that the request was larger than the server can handle, either due to physical constraints or settings." ],
    "414" => [ "Request-URI Too Long", "The 414 status code indicates the the URL requested by the client was longer than it can process." ],
    "415" => [ "A 415 status code is returned by a server to indicate that part of the request was in an unsupported format( i.e. The request was unsuccessful because the entity of the request is in a format not supported by the requested resource for the method requested )." ],
    "416" => [ "Requested Range Not Satisfiable", "A 416 status code means the client has asked for a portion of a file, but the server cannot supply that portion." ],
    "417" => [ "Expectation Failed", "The 417 status code means that the server was unable to properly complete the request. &nbsp;The server cannot meet the requirements of the Expect request-header field." ],
    "418" => [ "I'm A Teapot", "The HTCPCP server is a teapot. &nbsp;The responding entity may be short and stout." ],
    "422" => [ "Unprocessable Entity", "The request was well-formed but was unable to be followed due to semantic errors." ],
    "423" => [ "Locked", "The resource that is being accessed is locked." ],
    "424" => [ "Failed Dependency", "Request failed due to the failure of the previous request( e.g. a PROPPATCH )." ],
    "425" => [ "Unordered Collection", "Defined in drafts of \"WebDAV Advanced Collections Protocol\", but not present in \"Web Distributed Authoring and Versioning( WebDAV ) Ordered Collections Protocol\"." ],
    "426" => [ "Upgrade Required", "The client should switch to a different protocol such as TLS/1.0." ],
    "449" => [ "Retry With", "A Microsoft extension. &nbsp;The request should be retried after doing the appropriate action." ],
    "450" => [ "Blocked By Windows Parental Controls", "A Microsoft extension. &nbsp;This error is given when Windows Parental Controls are turned on and are blocking access to the given webpage." ],
    "500" => [ "Internal Server Error", "A generic error message, given when no more specific message is suitable." ],
    "501" => [ "Not Implemented", "The server either does not recognize the request method, or it lacks the ability to fulfill the request." ],
    "502" => [ "Bad Gateway", "The server was acting as a gateway or proxy and received an invalid response from the upstream server." ],
    "503" => [ "Service Unavailable", "The server is currently unavailable( overloaded or down )." ],
    "504" => [ "Gateway Timeout", "The server was acting as a gateway or proxy and did not receive a timely response from the upstream server." ],
    "505" => [ "HTTP Version Not Supported", "The server does not support the HTTP protocol version used in the request." ],
    "506" => [ "Variant Also Negotiates", "Transparent content negotiation for the request, results in a circular reference." ],
    "507" => [ "Insufficient Storage", "The method could not be performed on the resource because the server is unable to store the representation needed to successfully complete the request. &nbsp;There is insufficient free space left in your storage allocation." ],
    "509" => [ "Bandwidth Limit Exceeded", "This status code, while used by many servers, is not specified in any RFCs.This occurs when the bandwidth limit exceeds." ],
    "510" => [ "Not Extended", "Further extensions to the request are required for the server to fulfill it. &nbsp;A mandatory extension policy in the request is not accepted by the server for this resource." ] ];

    if( !isset( $status ) || !array_key_exists( $status, $codes ) )
    {
        header( "Location: javascript://history.go( -1 )" );    //based on second answer here http://stackoverflow.com/questions/5285031/back-to-previous-page-with-header-location-in-php
    }

    $pageName = "{$status} Error";
    $fontAwesome = "exclamation-triangle";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );

    $title = $codes[ $status ][ 0 ];
    $description = $codes[ $status ][ 1 ];
?>

<hr class="color-border">
    <p class="font-title font-header font-center color colored-link">
        <?php echo $title; ?>
    </p>
<hr class="color-border">
<br><br><br>

<p class="font-main font-small font-center color" >
    <?php echo $description; ?>
</p>

<br><br><br>
<br><br><br>
<br><br><br>

<?php
    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
