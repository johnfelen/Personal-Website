<?php
    $pageName = "Portfolio";
    $glyphiconName = "folder-open";
    include( "include_files/header.php" );
    
    $portfolioDB = new mysqli( "localhost", "root", "jfelen62", "portfolio" );
    
    if( $portfolioDB->connect_error )
    {
        die( "Error connecting to database" );
    }
    
    $result = $portfolioDB->query( "SELECT `Name`,`Link`,`Description`FROM `project descriptions` ORDER BY 'Month Finished' ASC" );
    
    if( !$result )
    {
        die( "Error with query" );
    }
    
    while( $row = $result->fetch_assoc() )
    {
        echo $row[ "Name" ] . "<br>";
    }
    
    mysqli_close( $portfolioDB );
?>

<hr class="brown">
<div class="row vertical-center">	
    <div class="col-xs-3">
        <p class="font-ubuntu font-large font-center colored-link">
            <a href="https://github.com/johnfelen/Secure-File-Sharing" title="Secure File Sharing" target="_blank">Secure File Sharing</a>
        </p>
    </div>
    
    <div class="col-xs-9">
        <p class="font-vollkorn font-center font-medium brown">
            This project was for my Applied Cryptography class.  &nbsp;
            Two other students and I worked on it together.  &nbsp;
            The point of the project was to protect from given threats, and at the end think of our own threats and protect against them.  &nbsp;
            A simple example is that we would use RSA signatures so that a user could not modify or forge their Token(data structure that holds user information and rights).  &nbsp;
            The three write ups under "docs" on GitHub have a much more in-depth analysis and explanation on what we implemented and why we implemented it. &nbsp;
            The instructions on how to run and compile the project are also under "docs".  
        </p>
    </div>
</div>
<hr class="brown">

<?php
    include( "include_files/footer.php" );
?>