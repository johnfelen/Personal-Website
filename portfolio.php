<?php
    echo $_GET[ "name" ];
    echo $_GET[ "time" ];

    if( !isset( $_GET[ "name" ] ) && !isset( $_GET[ "time" ] ) )    //redirect if they are going to portfolio wil nothing in get, so it will sort by name of project by default
    {
        header( "Location: portfolio.php?name=fa-sort-asc");
    }
    
    function getNextHref( $currHref )
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
    
    function getNextQuery( $portfolioDB, $currSortChoice, $orderAttribute )
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
            return $currComparator;
        }
        
        else if( $sortType === "YEAR" && $currComparator !== date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
        {
            $currComparator = date( "Y", strtotime( $row[ "Month Finished" ] ) );
            echo "<p class=\"font-ubuntu-mono font-header font-center brown\">{$currComparator}</p>";
            return $currComparator;
        }
    }
    
    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "php_include_files/header.php" );
    
    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "portfolio" );
    
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }
        
    if( isset( $_GET[ "name" ] ) )  //sort by name and set the variables for later
    {
        $name =  $_GET[ "name" ];
        $result = getNextQuery( $portfolioDB, $name, "name" );
        $currComparator = "z";
        $sortType = "NAME";
    }
    
    else if( isset( $_GET[ "time" ] ) ) //sort by time and set the variables for later
    {
        $time = $_GET[ "time" ];
        $result = getNextQuery( $portfolioDB, $time, "time" );
        $currComparator = "0";
        $sortType = "YEAR";
    }
    
    $nextName = getNextHref( $name );
    $nextTime = getNextHref( $time );
        
    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li><a href=\"portfolio.php?name={$nextName}\">Name of Project <i class=\"fa {$name}\"></i></a></li>
        <li><a href=\"portfolio.php?time={$nextTime}\">Time Finished <i class=\"fa {$time}\"></i></a></li>
    </ul>";
    
    //formatting and printing out project names(that are linked) and printing their description

    echo "<hr class=\"brown\">";
    while( $row = $result->fetch_assoc() )
    {
        printNewSort( $currComparator, $sortType, $row );
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