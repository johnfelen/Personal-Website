<?php
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) )    //redirect if they are going to portfolio wil nothing in get, so it will sort by name of project by default
    {
        header( "Location: portfolio.php?name=fa-sort-asc");
    }

    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "php_include_files/header.php" );
    require( "php_include_files/portfolio-functions.php" );

    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "personal website" );
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }

    /*For part two of the project I may add a sort type or two such as what the project was done for: school, myself, research etc and also languages used,
    if I do that I will probably refactor the portfolio to object oriented code since it will probably get more confusing then it is now, but it does work properly now */
    if( isset( $_GET[ "name" ] ) )  //sort by NAME and set the variables for sorting buttons
    {
        $name =  $_GET[ "name" ];
        $result = queryProjects( $portfolioDB, $name, "Name" );
        $currComparator = "z";
        $sortType = "NAME";
        $nextName = getNextHref( $name );
        $time = "fa-sort";
        $nextTime = "fa-sort-asc";
    }

    else if( isset( $_GET[ "time" ] ) ) //sort by TIME and set the variables for sorting buttons
    {
        $time = $_GET[ "time" ];
        $result = queryProjects( $portfolioDB, $time, "Month Finished" );
        $currComparator = "0";
        $sortType = "YEAR";
        $name = "fa-sort";
        $nextName = "fa-sort-asc";
        $nextTime = getNextHref( $time );
    }

    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li class=\"port-padding\"><a href=\"portfolio.php?name={$nextName}\">Name of Project <i class=\"fa {$name}\"></i></a></li>
        <li class=\"port-padding\"><a href=\"portfolio.php?time={$nextTime}\">Time Finished <i class=\"fa {$time}\"></i></a></li>
    </ul>";

    //print out each project and its description
    echo "<hr class=\"color-border\">";
    while( $row = $result->fetch_assoc() )
    {
        $currComparator = printTierChange( $currComparator, $sortType, $row );
        echo "
        <hr class=\"color-border\">
        <div class=\"row vertical-center\">
            <div class=\"col-xs-3\">
                <p class=\"font-title font-large font-center colored-link rotate\">
                    <a href=\"{$row[ "Link" ]}\" title=\"{$row[ "Link" ]}\" target=\"_blank\">{$row[ "Name" ]}</a>
                </p>
            </div>

            <div class=\"col-xs-9\">
                <p class=\"font-main font-center font-small color\">{$row[ "Description" ]}</p>
            </div>
        </div>
        <hr class=\"color-border\">";
    }
    echo "<hr class=\"color-border\">";

    mysqli_close( $portfolioDB );
    include( "php_include_files/footer.php" );
?>
