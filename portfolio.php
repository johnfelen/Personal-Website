<?php
    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "include_files/header.php" );
    
    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "portfolio" );
    
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }
    
    $result = $portfolioDB->query( "SELECT `Name`,`Link`,`Description` FROM `project descriptions` ORDER BY `Month Finished` ASC" );
    
    if( !$result )
    {
        die( "Error with query" );
    }
    
    //formatting and printing out project names(that are linked) and printing their description
    echo "<hr class=\"brown\">";
    while( $row = $result->fetch_assoc() )
    {
        echo"
        <hr class=\"brown\">
        <div class=\"row vertical-center\">	
            <div class=\"col-xs-3\">
                <p class=\"font-ubuntu font-large font-center colored-link\">
                    <a href=\"{$row[ 'Link' ]}\" title=\"{$row[ 'Link' ]}\" target=\"_blank\">{$row[ 'Name' ]}</a>
                </p>
            </div>
            
            <div class=\"col-xs-9\">
                <p class=\"font-vollkorn font-center font-medium brown\">{$row[ 'Description' ]}</p>
            </div>
        </div>
        <hr class=\"brown\">";
    }
    echo "<hr class=\"brown\">";
    
    mysqli_close( $portfolioDB );
    include( "include_files/footer.php" );
?>