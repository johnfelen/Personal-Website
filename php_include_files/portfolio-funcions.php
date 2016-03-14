<?php
    function getNextHref( $currHref )   //will figure out which attribute will be passed through $_GET[] for each sort button
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

    function queryProjects( $portfolioDB, $currSortChoice, $orderAttribute ) //query the order the projects will be displayed
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

    function printTierChange( $currComparator, $sortType, $row ) //checks if the next item would be in a different "tier" and prints it out if it is, such as when the year changes or the starting letter of the project changes print out the change
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
?>