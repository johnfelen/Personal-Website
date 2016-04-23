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

    $nameVals = $portfolioData->getSortButtonVals( "name" );
    $timeVals = $portfolioData->getSortButtonVals( "time" );

    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li class=\"port-padding\"><a href=\"portfolio.php?name={$nameVals[ 1 ]}\">Name of Project <i class=\"fa {$nameVals[ 0 ]}\"></i></a></li>
        <li class=\"port-padding\"><a href=\"portfolio.php?time={$timeVals[ 1 ]}\">Time Finished <i class=\"fa {$timeVals[ 0 ]}\"></i></a></li>
    </ul>";

    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
