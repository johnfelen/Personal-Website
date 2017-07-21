<?php
    $pageName = "Home";
    $fontAwesome = "home";

    include( "./server_functionality/page-data-start.php" );
?>

<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="./images/me.jpg" id="picture-of-me"/>
            <div id="blink">
                <p class="font-main font-medium font-center color" id="broken"></p>
                <p class="font-ubuntu-mono font-medium font-center color" id="continue"> Click to Continue </p>
            </div>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center color" id="pokemon"></p>

<div class="row" id="names"></div>

<?php
    include( "./server_functionality/page-data-end.php" );
?>
