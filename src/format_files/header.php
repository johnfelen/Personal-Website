<?php
    //this block of php code will minify the html output, it also relies on a line of php code at the end of the footer, it is based on https://coderwall.com/p/fatjmw/compressing-html-output-with-php
    function ob_html_minify( $buff )
    {
        return preg_replace( array( "/<!--(.*)-->/Uis", "/[[:blank:]]+/" ), array( "", " " ), str_replace( array( "\n", "\r", "\t" ), "", $buff ) );
    }
    ob_start( "ob_html_minify" );
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- NOTE: I commented this line out because I think the website is very usuable on mobile with it looking full screen and when it sizes to mobile there are some formatting glitches <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> this line will tell devices how to scale the webpage, based on the verified answer here http://stackoverflow.com/questions/19156510/responsive-website-zoomed-out-to-full-width-on-mobile -->
        <?php echo "<title>{$pageName}</title>"; ?>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <!--<link href="http://codegena.com/assets/css/image-preview-for-link.css" rel="stylesheet">-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.10.3/css/bootstrap-tour.min.css" rel="stylesheet">
        <?php include( "./format_files/fonts.php" ) ?>
        <link href="./css/themes.min.css" rel="stylesheet">

        <?php echo "<link id=\"favicon\" name=\"favicon-{$fontAwesome}.ico\" href=\"\" rel=\"shortcut icon\" type=\"image/x-icon\">\n"; ?>
    </head>

    <body class="subtle-pattern <?php echo ( $pageName !== "Tour" ) ? "fixed-navbar-padding": ""; ?>">
        <?php include_once( "./analyticstracking.php" ); ?>
        <!--top navigation bar-->
        <div class="navbar <?php echo ( $pageName !== "Tour" ) ? "navbar-fixed-top": ""; ?> auto-show-navbar shadow-shown" id="main-nav">
            <div class="navbar-collapse">
                <ul class="nav navbar-nav navbar-links">
                    <li id="index">
                        <a href="./index.php" title="Home"><i class="fa fa-home fa-fw navbar-colors"></i></a>
                    </li>
                    <li id="portfolio">
                        <a href="./portfolio.php" title="Portfolio"><i class="fa fa-code fa-fw navbar-colors"></i></a>
                    </li>
                    <li id="blog">
                        <a href="./blog.php" title="Blog"><i class="fa fa-pencil fa-fw navbar-colors"></i></a>
                    </li>
                    <li id="contact">
                        <a href="./contact.php" title="Contact Me"><i class="fa fa-envelope fa-fw navbar-colors"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <!--header-->
        <div id="header">
            <?php include( "./format_files/start-row-10.php" ); ?>
            <hr class="header-footer">
            <h1 class="font-title font-header color">
                <div class="dropdown colored-link">
                    <a href="javascript:;" id="tour-theme-menu" class="dropdown-toggle" <?php echo ( $pageName !== "Tour" ) ? "data-toggle=\"dropdown\"" : ""; ?> title="Change the Website Theme"><i id="font-awesome" class="fa fa-<?php echo "{$fontAwesome}";?> fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-animate" id="theme-menu">
                        <li><a href="javascript:;" id="picnic-blanket">Picnic Blanket</a></li>
                        <li><a href="javascript:;" id="sunrise">Sunrise</a></li>
                        <li><a href="javascript:;" id="billards-table">Billards Table</a></li>
                        <li><a href="javascript:;" id="candy-cane">Candy Cane</a></li>
                        <li><a href="javascript:;" id="cartography">Cartography</a></li>
                        <li><a href="javascript:;" id="grandmas-house">Grandma's House</a></li>
                        <li><a href="javascript:;" id="golf-argyle">Golf Argyle</a></li>
                        <li><a href="javascript:;" id="wheat-field">Wheat Field</a></li>
                        <li><a href="javascript:;" id="stardust">Stardust</a></li>
                        <li><a href="javascript:;" id="chinese-new-year">Chinese New Year</a></li>
                    </ul>
                </div><span id="page-name" class="header-footer"><?php echo $pageName; //it is one the same line as the closing div to remove the space between the font-awesome icon and the page name?></span>
            </h1>
            <hr class="header-footer">
            <?php include( "./format_files/end-row-10.php" ); ?>
        </div>

        <!--start the main container which is closed in footer.php-->
        <?php include( "./format_files/start-row-10.php" ); ?>
        <div class="container-main color-container" id="main-container">
