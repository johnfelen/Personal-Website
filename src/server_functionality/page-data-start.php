<?php
    if( isset( $_GET[ "AJAX" ] ) )
    {
        $pageData = [ "pageName" => $pageName,
        "fontAwesome" => $fontAwesome ];
        ob_start();
        include( "./format_files/start-row-10.php" );
    }

    else
    {
        include( "./format_files/header.php" );
        include( "./format_files/start-row-10.php" );
    }
?>
