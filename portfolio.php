<?php
    session_start();
    //saves the previously chosen sort in a session variable so when the user comes back to the Portfolio page it shows that previously chosen sort
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "lang" ] ) && !isset( $_GET[ "time" ] ) )
    {
        header( "Location: portfolio.php?lang=fa-sort-asc" );
    }

    $pageName = "Portfolio";
    $fontAwesome = "folder-open";
    include( "./format_files/header.php" );
    require( "./server_functionality/portfolio-functions.php" );

    if( isset( $_GET[ "name" ] ) )
    {
        $portfolioData = new PortfolioSort( "NAME", $_GET[ "name" ] );
    }

    else if( isset( $_GET[ "lang" ] ) )
    {
        $portfolioData = new PortfolioSort( "LANG", $_GET[ "lang" ] );
    }

    else if( isset( $_GET[ "time" ] ) )
    {
        $portfolioData = new PortfolioSort( "TIME", $_GET[ "time" ] );
    }

    echo $portfolioData->getSortButtonVals();
    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
