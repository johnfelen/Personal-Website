<?php
    // session_start();
    // if( !isset( $_SESSION[ "lastStartTime" ] ) || ( isset( $_SESSION[ "lastStartTime" ] ) && ( time() - $_SESSION[ "lastStartTime" ] ) > 900 ) )  //its been 15 minutes so just send them back to the non-static home page
    // {
    //     header( "Location: index.php" );
    // }

    $pageName = "Home";
    $fontAwesome = "home";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );
?>

<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="images/me.jpg" id="static-picture-of-me" alt="Picture of Me"/>
            <p class="font-main font-medium font-center color" id="static-broken"></p>
            <p class="font-ubuntu-mono font-medium font-center color" id="static-continue"></p>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center color" id="static-pokemon"></p>

<div class="row" id="static-names"></div>

<?php
    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
