<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php echo "<title>{$pageName}</title>"; ?>
        
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
        <?php echo( $pageName === "Home" ) ? "<link href=\"https://fonts.googleapis.com/css?family=Ubuntu+Mono\" rel=\"stylesheet\" type=\"text/css\">\n" : ""; ?>
		<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/personalstyle.css" rel="stylesheet">    <!--SASS compiles into this .css file-->
        <?php echo "<link href=\"images/{$glyphiconName}.ico\" rel=\"shortcut icon\" type=\"image/x-icon\">"; ?>
    
    </head>
    <body>
    
        <!--top navigation bar-->
        <div class="navbar font-ubuntu font-small">
           
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li<?php echo ( $pageName === "Home" ) ? " class=\"active\"" : ""; ?>>
                        <a href="index.php" title="Home"><span class="glyphicon glyphicon-home font-large"></span></a>
                    </li>
                    <li<?php echo ( $pageName === "Portfolio" ) ? " class=\"active\"" : ""; ?>>
                        <a href="portfolio.php" title="Portfolio"><span class="glyphicon glyphicon-folder-open font-large"></a>
                    </li>
                    <li<?php echo ( $pageName === "Contact Me" ) ? " class=\"active\"" : ""; ?>>
                        <a href="contact.php" title="Contact Me"><span class="glyphicon glyphicon-envelope font-large"></a>
                    </li>
                </ul>
            </div>
                
        </div>

        <!--header-->
        <div class="header-footer">
            <hr class="brown">
                <h1 class="font-ubuntu font-header brown">
                    <?php 
                        echo "<span class=\"glyphicon glyphicon-{$glyphiconName} brown\"></span>";
                        echo ( $pageName === "Portfolio" ) ? " {$pageName}" : "{$pageName}";    //this if is just for formatting since the folder in Portfolio will cover part of the 'P' without a space   
                    ?>
                </h1>
            <hr class="brown">
        </div>