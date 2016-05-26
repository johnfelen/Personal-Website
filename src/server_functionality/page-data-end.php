<?php
    if( isset( $_GET[ "AJAX" ] ) )
    {
        unset( $_GET[ "AJAX" ] );
        include( "./format_files/end-row-10.php" );
        $pageData[ "mainContainer" ] = ob_get_clean();
        echo json_encode( $pageData );
    }

    else
    {
        include( "./format_files/end-row-10.php" );
        include( "./format_files/footer.php" );
    }
?>
