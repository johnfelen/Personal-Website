<?php
    include( "./database-setup.php" );
    $contactDB = $genericDB;

    if( isset( $_REQUEST[ "value" ] ) ) //jqBootstrapValidator will use this code to check if the email has already been entered into the database
    {
        $email = $_REQUEST[ "value" ];
        unset( $_REQUEST[ "value" ] );

        $email = mysqli_real_escape_string( $contactDB, testInput( $email ) );
        $checkPK = $contactDB->query( "SELECT * FROM  `messages`  WHERE `Email` = '{$email}'" );

        echo json_encode([
            "value" => $email,
            "valid" => mysqli_num_rows( $checkPK ) === 0,
            "message" => "That email address is already in the database!"
        ]);
    }

    else if( isset( $_POST[ "name" ] ) && isset( $_POST[ "email" ] ) && isset( $_POST[ "message" ] ) )  //enter the information into the database and send me an email with the information
    {
        $name = $_POST[ "name" ];
        $email = $_POST[ "email" ];
        $message = $_POST[ "message" ];

        unset( $_POST[ "name" ] );
        unset( $_POST[ "email" ] );
        unset( $_POST[ "message" ] );

        $nameDB = mysqli_real_escape_string( $contactDB, testInput( $name ) );
        $emailDB = mysqli_real_escape_string( $contactDB, testInput( $email ) );
        $messageDB = mysqli_real_escape_string( $contactDB, testInput( $message ) );

        $result = $contactDB->query( "INSERT INTO `messages` (`Name`, `Email`, `Message`) VALUES( '{$nameDB}', '{$emailDB}', '{$messageDB}' );" );
        if( !$result )
        {
            echo "Error with query.";
        }

        else
        {
            $message = wordwrap( $message, 70 );
            mail( "johnfelen@pitt.edu", "Message from {$name}, {$email}", $message, "From: {$email}" ); //use the uneditted name, email, and message to send me the email so it has better readability
            echo "Success";
        }
    }

    mysqli_close( $contactDB );

    function testInput( $data )        //this function is also from http://www.w3schools.com/php/php_form_url_email.asp
    {
        $data = trim( $data );
        $data = stripslashes( $data );
        $data = htmlspecialchars( $data );
        return $data;
    }
?>
