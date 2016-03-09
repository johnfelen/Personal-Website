<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <?php
                echo "<title>{$pageName}</title>";    
            ?>
        
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/personalstyle.css" rel="stylesheet">    <!--SASS compiles into this .css file-->
        
        <?php
            echo "<link href=\"images/{$glyphiconName}.ico\" rel=\"shortcut icon\" type=\"image/x-icon\">";
        ?>
    
    </head>
    <body>
    
        <!--top navigation bar-->
        <div class="navbar">
           
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php echo ( $pageName === "Home" ) ? "class=\"active\"" : ""; ?>>
                        <a href="index.php">Home</a>
                    </li>
                    <li <?php echo ( $pageName === "Portfolio" ) ? "class=\"active\"" : ""; ?>>
                        <a href="portfolio.php">Portfolio</a>
                    </li>
                    <li <?php echo ( $pageName === "Contact Me" ) ? "class=\"active\"" : ""; ?>>
                        <a href="contact.php">Contact Me</a>
                    </li>
                </ul>
            </div>
                
        </div>

        <!--header-->
        <div class="header-footer">
            <hr class="brown">
                <?php 
                    echo "<h1><span class=\"glyphicon glyphicon-{$glyphiconName} brown\"/>{$pageName}</h1>";      
                ?>
            <hr class="brown">
        </div>