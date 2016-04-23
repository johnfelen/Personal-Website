<?php
    session_start();
    //saves the previously chosen sort in a session variable so when the user comes back to the Portfolio page it shows that previously chosen sort
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) && !isset( $_GET[ "lang" ] ) )
    {
        if( !isset( $_SESSION[ "currPortfolioSort" ] ) )
        {
            $_SESSION[ "currPortfolioSort" ] = "name=fa-sort-asc";
        }
        header( "Location: portfolio.php?{$_SESSION[ "currPortfolioSort" ]}");
    }

    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "./format_files/header.php" );
    require( "./server_functionality/portfolio-functions.php" );

    if( isset( $_GET[ "name" ] ) )
    {
        $_SESSION[ "currPortfolioSort" ] = "name={$_GET[ "name" ]}";
        $portfolioData = new PortfolioSort( "NAME", $_GET[ "name" ] );
    }

    else if( isset( $_GET[ "time" ] ) )
    {
        $_SESSION[ "currPortfolioSort" ] = "time={$_GET[ "time" ]}";
        $portfolioData = new PortfolioSort( "TIME", $_GET[ "time" ] );
    }

    else if( isset( $_GET[ "lang" ] ) )
    {
        $_SESSION[ "currPortfolioSort" ] = "lang={$_GET[ "lang" ]}";
        $portfolioData = new PortfolioSort( "LANG", $_GET[ "lang" ] );
    }

    echo $portfolioData->getSortButtonVals();
    echo $portfolioData->getSortedProjects();

    include( "./format_files/footer.php" );
?>
