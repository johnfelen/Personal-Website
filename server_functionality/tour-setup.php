<?php
    session_start();
    if( isset( $_POST[ "incomingTour" ] ) )
    {
        $_SESSION[ "incomingTour" ] = true;
    }
?>
