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

    echo $portfolioData->getSortButtonVals();
    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
