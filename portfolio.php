<?php
    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) )    //redirect if they are going to portfolio wil nothing in get, so it will sort by name of project by default
    {
        header( "Location: portfolio.php?name=fa-sort-asc");
    }
    
    function getNextHref( $currHref )   //will figure out which get attribute will be passed on for each sort button
    {
        if( $currHref === "fa-sort" )
        {
            return "fa-sort-asc";
        }
        
        else if( $currHref === "fa-sort-asc" )
        {
            return "fa-sort-desc";
        }
        
        else
        {
            return "fa-sort-asc";
        }
    }
    
    function getQuery( $portfolioDB, $currSortChoice, $orderAttribute ) //get the query for how the projects will be displayed
    {
        if( $currSortChoice === "fa-sort-asc" )
        {
            $result = $portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `{$orderAttribute}` ASC" );
        }
        
        else if( $currSortChoice === "fa-sort-desc" )
        {
            $result = $portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `{$orderAttribute}` DESC" );
        }
        
        if( !$result )
        {
            die( "Error with query" );
        }
        
        else
        {
            return $result;
        }
    }
    
    function printNewSort( $currComparator, $sortType, $row ) //checks if the next item would be in a different "tier" and prints it out if it is, for example if the year changes print out the year change
    {
        if( $sortType === "NAME" && $currComparator !== $row[ "Name" ][ 0 ] )
        {
            $currComparator = $row[ "Name" ][ 0 ];
            echo "<p class=\"font-ubuntu-mono font-header font-center brown\">{$currComparator}</p>";
        }
        
        else if( $sortType === "YEAR" && $currComparator !== date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
        {
            $currComparator = date( "Y", strtotime( $row[ "Month Finished" ] ) );
            echo "<p class=\"font-ubuntu-mono font-header font-center brown\">{$currComparator}</p>";
        }
        
        return $currComparator;
    }
    
    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "php_include_files/header.php" );
    
    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "portfolio" );
    
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }
        
    /*For part two of the project I may add a sort type or two such as what the project was done for: school, myself, research etc and also languages used,
    if I do that I will probably refactor the portfolio to object oriented code since it will probably get more confusing then it is now, but it does work properly now */
    if( isset( $_GET[ "name" ] ) )  //sort by NAME and set the variables for sorting buttons
    {
        $name =  $_GET[ "name" ];
        $result = getQuery( $portfolioDB, $name, "Name" );
        $currComparator = "z";
        $sortType = "NAME";
        $nextName = getNextHref( $name );
        $time = "fa-sort";
        $nextTime = "fa-sort-asc";
    }
    
    else if( isset( $_GET[ "time" ] ) ) //sort by TIME and set the variables for sorting buttons
    {
        $time = $_GET[ "time" ];
        $result = getQuery( $portfolioDB, $time, "Month Finished" );
        $currComparator = "0";
        $sortType = "YEAR";
        $name = "fa-sort";
        $nextName = "fa-sort-asc";
        $nextTime = getNextHref( $time );
    }

    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li><a href=\"portfolio.php?name={$nextName}\">Name of Project <i class=\"fa {$name}\"></i></a></li>
        <li><a href=\"portfolio.php?time={$nextTime}\">Time Finished <i class=\"fa {$time}\"></i></a></li>
    </ul>";
    
    //print out each project and its description
    echo "<hr class=\"brown\">";
    while( $row = $result->fetch_assoc() )
    {
        $currComparator = printNewSort( $currComparator, $sortType, $row );
        echo "
        <hr class=\"brown\">
        <div class=\"row vertical-center\">	
            <div class=\"col-xs-3\">
                <p class=\"font-ubuntu font-large font-center colored-link\">
                    <a href=\"{$row[ 'Link' ]}\" title=\"{$row[ 'Link' ]}\" target=\"_blank\">{$row[ 'Name' ]}</a>
                </p>
            </div>
            
            <div class=\"col-xs-9\">
                <p class=\"font-vollkorn font-center font-small brown\">{$row[ 'Description' ]}</p>
            </div>
        </div>
        <hr class=\"brown\">";
    }
    echo "<hr class=\"brown\">";
    
    mysqli_close( $portfolioDB );
    include( "php_include_files/footer.php" );
?>