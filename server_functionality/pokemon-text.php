<?php
    session_start();

    if( isset( $_GET[ "getText" ] ) )
    {
        unset( $_GET[ "getText" ] );
        $textToBeDisplayed = [ "Hello there! Welcome to the world of Earth!",
        "My name is John Felen! People call me John!",
        "This world is inhabited by creatures called humans!",
        "For some people, humans are pets. Other use them for fights.",
        "Myself...",
        "I study humans as profession.",
        "First, what is your name?",
        "<div class=\"col-xs-3\"></div>
            <div class=\"col-xs-6 container-main\">
                <table class=\"font-ubuntu-mono font-header color color-border font-center fill-n-center\" id=\"choose-name\">
                    <tr class=\"accent-hover\"><td>NEW NAME</td></tr>
                    <tr class=\"accent-hover\"><td>RED</td></tr>
                    <tr class=\"accent-hover\"><td>ASH</td></tr>
                    <tr class=\"accent-hover\"><td>JACK</td></tr>
                </table>
            </div>
        <div class=\"col-xs-3\"></div>",
        "<i class=\"fa fa-spinner fa-pulse fa-3x color\"></i>",
        "<i class=\"fa fa-spinner fa-3x color\"></i>",
        "It looks like the game froze.&nbsp;
        Maybe try to blow into the cartridge and try again in <span id=\"time-left\">15 minutes</span>.&nbsp;
        While you are here, feel free to explore my personal website." ];
        echo json_encode( $textToBeDisplayed );
    }

    else if( isset( $_POST[ "setTime" ] ) )
    {
        unset( $_POST[ "setTime" ] );
        $_SESSION[ "lastStartTime" ] = time();
    }

    else if( isset( $_GET[ "getTime" ] ) )
    {
        unset( $_GET[ "getTime" ] );
        echo $_SESSION[ "lastStartTime" ];
    }
?>
