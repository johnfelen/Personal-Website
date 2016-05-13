<?php
    if( isset( $_GET[ "AJAX" ] ) )
    {
        unset( $_GET[ "AJAX" ] );
        $pageData[ "mainContainer" ] = ob_get_clean();
        echo json_encode( $pageData );
    }
?>
