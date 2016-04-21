<?php
    // session_start();
    // if( !isset( $_SESSION[ "lastStartTime" ] ) || ( isset( $_SESSION[ "lastStartTime" ] ) && time() - $_SESSION[ "lastStartTime" ] > 900 ) )  //its been 15 minutes so just send them back to the non-static home page
    // {
    //     header( "Location: index.php" );
    // }

    $pageName = "Home";
    $glyphiconName = "home";
    include( "php_include_files/header.php" );
    include( "php_include_files/start-row-10.php" );
?>

<!--Pokemon reference for a little humour-->
<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="images/me.jpg" class="picture" alt="Picture of Me" width="100%"/>
                <p class="font-main font-medium font-center color" id="broken">
                    It looks like the game froze.&nbsp;
                    Maybe try to blow into the cartridge and try again in 15 minutes. &nbsp;
                    While you are here, feel free to explore my personal website.
                </p>
                <p class="font-ubuntu-mono font-medium font-center color" id="continue">
                    <i class="fa fa-spinner fa-3x color"></i>
                </p>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center color" id="pokemon">
    Hello there! Welcome to the world of Earth! <br>
    My name is John Felen! People call me John! <br>
    This world is inhabited by creatures called humans! <br>
    For some people, humans are pets. Other use them for fights. <br>
    Myself... <br>
    I study humans as profession. <br>
    First, what is your name? <br>
</p>

<div class="row" id="names">
    <div class="col-xs-3"></div>
    <div class="col-xs-6 container-main">
        <table class="font-ubuntu-mono font-header color color-border font-center fill-n-center" id="choose-name">
            <tr><td>NEW NAME</td></tr>
            <tr><td>RED</td></tr>
            <tr><td>ASH</td></tr>
            <tr><td>JACK</td></tr>
        </table>
    </div>
    <div class="col-xs-3"></div>
</div>

<?php
    include( "php_include_files/end-row-10.php" );
    include( "php_include_files/footer.php" );
?>
