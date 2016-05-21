<?php
    //this file is just to make it easier for me to change the databse when I upload these files to my webhost, I will only have to replace this file rather than change multiple files, it also allows database use to be easily extensible for that reason
    $genericDB = new mysqli( "localhost", "root", "jfelen62", "personal_website" );
    if( $genericDB->connect_error )
    {
        die( "Error connecting to database." );
    }
?>
