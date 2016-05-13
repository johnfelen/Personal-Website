<?php
    if( isset( $_GET[ "AJAX" ] ) )
    {
        $pageData = [ "pageName" => $pageName,
        "fontAwesome" => $fontAwesome ];
        ob_start();
    }
?>
