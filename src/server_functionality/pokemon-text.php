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
        "<div class=\"col-xs-4\"></div>
            <div class=\"col-xs-4 container-main color\">
                <table class=\"font-ubuntu-mono font-large color color-border fill-n-center\" id=\"choose-name\">
                    <tr><td><i id=\"new-name\" class=\"fa fa-play select-name\"></i>NEW NAME</td></tr>
                    <tr><td><i id=\"red\" class=\"fa fa-play select-name\"></i>RED</td></tr>
                    <tr><td><i id=\"ash\" class=\"fa fa-play select-name\"></i>ASH</td></tr>
                    <tr><td><i id=\"jack\" class=\"fa fa-play select-name\"></i>JACK</td></tr>
                </table>
            </div>
        <div class=\"col-xs-4\"></div>",
        "<i class=\"fa fa-spinner fa-pulse fa-3x color\"></i>",
        "<i class=\"fa fa-spinner fa-3x color\"></i>",
        "It looks like the game froze.&nbsp;
        Maybe try to blow into the cartridge and restart the system or let the system cool down for <span id=\"time-left\">15 minutes</span>.&nbsp;
        While you are here, feel free to explore my personal website." ];
        echo json_encode( $textToBeDisplayed );
    }
?>
