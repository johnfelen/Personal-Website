<?php
    session_start();    //The time session is based off of the best answer from http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes because session.gc_maxlifetime is explained in the post to not be the best way because of the gabarge collection randomness
    if( isset( $_SESSION[ "lastStartTime" ] ) && time() - $_SESSION[ "lastStartTime" ] <= 900 )  //it hasn't been 15 minutes so show the static page
    {
        header( "Location: static-index.php" );
    }

    else if( isset( $_SESSION[ "lastStartTime" ] ) )    //its been 15 minutes since they first came here so show them this page and delete the old session
    {
        session_unset();
        session_destroy();
    }

    $_SESSION[ "lastStartTime" ] = time();  //fall through and set the time variable, the 15 minutes is so that the user won't have to continually go through the home page print outs wihtin a normal viewing of my website

    $pageName = "Home";
    $glyphiconName = "home";
    $printLines = true; //this will tell body to have the print line functions
    include( "php_include_files/header.php" );
    include( "php_include_files/start-row-10.php" );
?>

<!--Pokemon reference for a little humour-->
<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="images/me.jpg" class="picture" alt="Picture of Me" width="100%"/>
            <blink class="invisible">
                <p class="font-main font-medium font-center color" id="broken"></p>
                <p class="font-ubuntu-mono font-medium font-center color" id="continue"> Click to Continue </p>
            </blink>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center color" id="pokemon"></p>

<div class="row" id="names"></div>

<!--based on second last response on http://stackoverflow.com/questions/18105152/alternative-for-blink since the actual <blink> tag is deprecated, I wonder why
NOTE: I also tried to move the javascript into the home.js file but it did not work and kept saying that blink() was not defined, since it was not an error I decided to work on other parts of the project with my time-->
<script type="text/javascript">
    function blink()
    {
        var blinks = document.getElementsByTagName( "blink" );
        for ( var i = blinks.length - 1; i >= 0; i-- )
        {
            var s = blinks[ i ];

            if( currentlyTyping )   //this will make the keep continue stop blinking while typing out lines
            {
                s.style.visibility = "hidden";
            }

            else if( count == lines.length + 1 )    //they now can "choose" their name so change "click to continue" to "choose your name", because of the below else if must have the s.style.visibility line
            {
                document.getElementById( "continue" ).innerHTML =  "Choose Your Name<br>";
                s.style.visibility = ( s.style.visibility === "visible" ) ? "hidden" : "visible";
            }

            else if( count == lines.length + 2 )    //we are done with blinking, make the text visible so the "loading" simulation will show
            {
                s.style.visibility = "visible";
                return;
            }

            else if( count > 0 )    //the > 0 is to stop from having the short flash of click to continue when the page loads
            {
                s.style.visibility = ( s.style.visibility === "visible" ) ? "hidden" : "visible";
            }
        }

        window.setTimeout( blink, 350 );
    }

    //these for are from the stack overflow, it works so I'm not going to change it
    if ( document.addEventListener )
    {
        document.addEventListener( "DOMContentLoaded", blink, false );
    }

    else if ( window.addEventListener )
    {
        window.addEventListener( "load", blink, false );
    }

    else if ( window.attachEvent )
    {
        window.attachEvent( "onload", blink );
    }

    else
    {
        window.onload = blink;
    }
</script>

<?php
    include( "php_include_files/end-row-10.php" );
    include( "php_include_files/footer.php" );
?>
