<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            <?php
                echo htmlspecialchars( $pageTitle );    //replace the title with the $pageTitle variable that is set in the individual php files
            ?>
        </title>
        
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:bold" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/personalstyle.css" rel="stylesheet">
        <link href="images/home.ico" rel="shortcut icon" type="image/x-icon">
    
    </head>
    <body>
    
        <div class="navbar">
   
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                    <li><a href="contact.php">Contact Me</a></li>
                </ul>
            </div>
                
        </div>

        <div class="header_footer">
            <hr><h1><span class="glyphicon glyphicon-home icon"></span>Home</h1><hr>
        </div>