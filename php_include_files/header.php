<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php echo "<title>{$pageName}</title>"; ?>

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/personalstyle.css" rel="stylesheet">

        <?php echo "<link href=\"images/{$glyphiconName}.ico\" rel=\"shortcut icon\" type=\"image/x-icon\">\n"; ?>
    </head>

    <body class="bg-map"<?php echo ( isset( $printLines ) ) ? " onload=\"printNextLine()\" onclick=\"printNextLine()\"" : "";?>>

        <!--top navigation bar-->
        <?php include( "php_include_files/start-row-10.php" ); ?>
        <div class="navbar">
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li<?php echo ( $pageName === "Home" ) ? " class=\"active\"" : ""; ?>>
                        <a href="index.php" title="Home"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li<?php echo ( $pageName === "Portfolio" ) ? " class=\"active\"" : ""; ?>>
                        <a href="portfolio.php" title="Portfolio"><span class="glyphicon glyphicon-folder-open"></a>
                    </li>
                    <li<?php echo ( $pageName === "Contact Me" ) ? " class=\"active\"" : ""; ?>>
                        <a href="contact.php" title="Contact Me"><span class="glyphicon glyphicon-envelope"></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php include( "php_include_files/end-row-10.php" ); ?>

        <!--header-->
        <?php include( "php_include_files/start-row-10.php" ); ?>
        <hr class="brown">
            <h1 class="font-ubuntu font-header brown">
                <?php
                    echo "<span class=\"glyphicon glyphicon-{$glyphiconName} brown\"></span>";
                    echo ( $pageName === "Portfolio" ) ? " {$pageName}" : "{$pageName}";    //this if is just for formatting since the folder in Portfolio will cover part of the 'P' without a space
                ?>
            </h1>
        <hr class="brown">
        <?php include( "php_include_files/end-row-10.php" ); ?>

        <!--start the main container which is closed in footer.php-->
        <?php include( "php_include_files/start-row-10.php" ); ?>
        <div class="container-main">
