<?php
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) )    //redirect if they are going to portfolio wil nothing in get, so it will sort by name of project by default
    {
        header( "Location: portfolio.php?name=fa-sort-asc");
    }

    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "./format_files/header.php" );
    require( "./server_functionality/portfolio-functions.php" );

    $portfolioData = new PortfolioSort();

    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li class=\"port-padding\"><a href=\"portfolio.php?name={$nextName}\">Name of Project <i class=\"fa {$name}\"></i></a></li>
        <li class=\"port-padding\"><a href=\"portfolio.php?time={$nextTime}\">Time Finished <i class=\"fa {$time}\"></i></a></li>
    </ul>";

    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
