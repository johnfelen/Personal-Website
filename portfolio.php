<?php
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) && !isset( $_GET[ "lang" ] ) )    //redirect if they are going to portfolio wil nothing in get, so it will sort by name of project by default
    {
        header( "Location: portfolio.php?name=fa-sort-asc");
    }

    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "./format_files/header.php" );
    require( "./server_functionality/portfolio-functions.php" );

    if( isset( $_GET[ "name" ] ) )  //sort by NAME and set the variables for sorting buttons
    {
        $portfolioData = new PortfolioSort( "NAME", $_GET[ "name" ] );
    }

    else if( isset( $_GET[ "time" ] ) ) //sort by TIME and set the variables for sorting buttons
    {
        $portfolioData = new PortfolioSort( "TIME", $_GET[ "time" ] );
    }

    else if( isset( $_GET[ "lang" ] ) )
    {
        $portfolioData = new PortfolioSort( "LANG", $_GET[ "lang" ] );
    }

    $nameVals = $portfolioData->getSortButtonVals( "NAME" );
    $langVals = $portfolioData->getSortButtonVals( "LANG" );
    $timeVals = $portfolioData->getSortButtonVals( "TIME" );

    //print out sorting buttons with updated sort buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li class=\"port-padding\"><a href=\"portfolio.php?name={$nameVals[ 1 ]}\">Name of Project <i class=\"fa {$nameVals[ 0 ]}\"></i></a></i>
        <li class=\"port-padding\"><a href=\"portfolio.php?lang={$langVals[ 1 ]}\">Programming Languages <i class=\"fa {$langVals[ 0 ]}\"></i></a></li>
        <li class=\"port-padding\"><a href=\"portfolio.php?time={$timeVals[ 1 ]}\">Time Finished <i class=\"fa {$timeVals[ 0 ]}\"></i></a></li>
    </ul>";

    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
