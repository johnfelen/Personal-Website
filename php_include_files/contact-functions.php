<?php
    function test_input( $data )        //this function is also from http://www.w3schools.com/php/php_form_url_email.asp
    {
        $data = trim( $data );
        $data = stripslashes( $data );
        $data = htmlspecialchars( $data );
        return $data;
    }

    function ageInMonths( $birthdateString, $timeZone )    //this function takes a( for this website my ) birthdate as a string and the timezone to calculate how many months old the person is
    {
        date_default_timezone_set( $timeZone );
        $today = new DateTime( "now" );
        $birthdate = new DateTime( $birthdateString );

        $diff = date_diff( $birthdate, $today );
        return ( $diff->format( "%y" ) * 12 ) + $diff->format( "%m" );
    }
?>
