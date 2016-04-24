<?php
    session_start();

    if( !isset( $_SESSION[ "incomingTour" ] ) ) //redirects to page that called it when they typed the url in instead of actually going though the Bootstarap Tour, from accepted answer http://stackoverflow.com/questions/23917152/redirect-back-to-previous-page-in-php
    {
        header( "Location: javascript://history.go(-1)" );
    }
    unset( $_SESSION[ "incomingTour" ] );

    $pageName = "Tour";
    $glyphiconName = "tour";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );

    echo "<br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br>";

    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
