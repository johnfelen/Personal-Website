<?php
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
    }
    
    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "php_include_files/header.php" );
    
    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "portfolio" );
    
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }
    
    if( isset( $_GET[ "name" ] ) && $_GET[ "name" ] !== "SORT" )
    {
        $result = $portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `Name` {$_GET[ 'name' ]}" );
    }
    
    else if( isset( $_GET[ "time" ] ) && $_GET[ "time" ] !== "SORT" )
    {
        $result = $portfolioDB->query( "SELECT * FROM `project descriptions` ORDER BY `Month Finished` {$_GET[ 'time' ]}" );
    }
    
    else    //default start
    {
        $result = "HELLO";
        $name = "fa-sort";
        $time = "fa-sort";
    }
    
    if( !$result )
    {
        die( "Error with query" );
    }
    
    $nextName = getNextHref( $name );
    $nextTime = getNextHref( $name );
        
    //print out sorting buttons
    echo "
    <ul class=\"nav nav-pills nav-justified\">
        <li><a href=\"portfolio.php?name={$nextName}\">Name of Project <i class=\"fa {$name}\"></i></a></li>
        <li><a href=\"portfolio.php?time={$nextTime}\">Name of Project <i class=\"fa {$time}\"></i></a></li>
    </ul>";
    
    //<!--fa-sort-desc   fa-sort-asc-->

    //formatting and printing out project names(that are linked) and printing their description
    $currYear = "0";
    echo "<hr class=\"brown\">";
    while( $row = $result->fetch_assoc() )
    {
        if( $currYear != date( "Y", strtotime( $row[ "Month Finished" ] ) ) )
        {
            $currYear = date( "Y", strtotime( $row[ "Month Finished" ] ) );
            echo "<p class=\"font-ubuntu-mono font-header font-center brown\">{$currYear}</p>";
        }
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