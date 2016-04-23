<?php
    session_start();    //The time session is based off of the best answer from http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes because session.gc_maxlifetime is explained in the post to not be the best way because of the gabarge collection randomness
    if( isset( $_SESSION[ "lastStartTime" ] ) && time() - $_SESSION[ "lastStartTime" ] < 900 )  //it hasn't been 15 minutes so show the static page
    {
        header( "Location: static-index.php" );
    }

    else if( isset( $_SESSION[ "lastStartTime" ] ) )    //its been 15 minutes since they first came here so show them this page and delete the old session
    {
        session_unset();
        session_destroy();
    }

    $pageName = "Home";
    $glyphiconName = "home";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );
?>

<!--Pokemon reference for a little humour-->
<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="images/me.jpg" id="picture-of-me" alt="Picture of Me"/>
            <blink>
                <p class="font-main font-medium font-center color" id="broken"></p>
                <p class="font-ubuntu-mono font-medium font-center color" id="continue"> Click to Continue </p>
            </blink>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center color" id="pokemon"></p>

<div class="row" id="names"></div>

<?php
    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
