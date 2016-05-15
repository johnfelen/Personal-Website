<?php
    if( isset( $_POST[ "faviconPath" ] ) )
    {
        $faviconPath = $_POST[ "faviconPath" ];
        unset( $_POST[ "faviconPath" ] );
        copy( ".{$faviconPath}", "../favicon.ico" );
    }
?>
