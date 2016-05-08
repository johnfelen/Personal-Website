<?php
    function ob_html_minify( $buf )
    {
        return preg_replace( array( '/<!--(.*)-->/Uis', "/[[:blank:]]+/" ), array( '', ' ' ), str_replace( array( "\n", "\r", "\t" ), '', $buf ) );
    }
    ob_start( "ob_html_minify" );
    //this block of php code will minify the html output, it also relies on a line of php code at the end of the footer, it is based on https://coderwall.com/p/fatjmw/compressing-html-output-with-php
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">   <!-- this line will tell devices how to scale the webpage, based on the verified answer here http://stackoverflow.com/questions/19156510/responsive-website-zoomed-out-to-full-width-on-mobile -->
        <?php echo "<title>{$pageName}</title>"; ?>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="http://codegena.com/assets/css/image-preview-for-link.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.10.3/css/bootstrap-tour.min.css" rel="stylesheet">
        <link href="css/themes.min.css" rel="stylesheet">

        <?php echo "<link id=\"favicon\" name=\"favicon-{$fontAwesome}.ico\" href=\"\" rel=\"shortcut icon\" type=\"image/x-icon\">\n"; ?>
    </head>

    <body class="subtle-pattern">
        <!--top navigation bar-->
        <?php include( "./format_files/start-row-10.php" ); ?>
        <div class="navbar" id="main-nav">
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="home"<?php echo ( $pageName === "Home" ) ? " class=\"active\"" : ""; ?>>
                        <a href="index.php" title="Home"><i class="fa fa-home"></i></a>
                    </li>
                    <li id="portfolio"<?php echo ( $pageName === "Portfolio" ) ? " class=\"active\"" : ""; ?>>
                        <a href="portfolio.php" title="Portfolio"><i class="fa fa-folder-open"></i></a>
                    </li>
                    <li id="contact"<?php echo ( $pageName === "Contact Me" ) ? " class=\"active\"" : ""; ?>>
                        <a href="contact.php" title="Contact Me"><i class="fa fa-envelope"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php include( "./format_files/end-row-10.php" ); ?>

        <!--header-->
        <?php include( "./format_files/start-row-10.php" ); ?>
        <hr class="color-border">
            <h1 class="font-title font-header color">
                <div class="dropdown colored-link">
                    <a href="#" id="tour-theme-menu" class="dropdown-toggle" data-toggle="dropdown" title="Change the Website Theme"><i class="fa fa-<?php echo "{$fontAwesome}";?>"></i></a>
                    <ul class="dropdown-menu" id="theme-menu">
                        <li><a href="#" id="picnic-blanket">Picnic Blanket</a></li>
                        <li><a href="#" id="billards-table">Billards Table</a></li>
                        <li><a href="#" id="candy-cane">Candy Cane</a></li>
                        <li><a href="#" id="cartography">Cartography</a></li>
                        <li><a href="#" id="stardust">Stardust</a></li>
                    </ul>
                </div>
                <?php echo $pageName; ?>
            </h1>
        <hr class="color-border">
        <?php include( "./format_files/end-row-10.php" ); ?>

        <!--start the main container which is closed in footer.php-->
        <?php include( "./format_files/start-row-10.php" ); ?>
        <div class="container-main color-container" id="main-container">
