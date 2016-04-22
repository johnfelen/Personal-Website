<?php
    require( "./contact-functions.php" );
    $submittedMessage = json_decode( $_POST[ "messageInfo" ], true );
    $name = $submittedMessage[ "name" ];
    $email = $submittedMessage[ "email" ];
    $message = $submittedMessage[ "message" ];

    $contactDB = new mysqli( "localhost", "root", "jfelen62", "personal website" );
    if( $contactDB->connect_error )
    {
        $response[ "error" ] = $contactDB->connect_error;    //used to print out later so they cannot submit anything, I want the page to load but not allow them to keep submitting if there is an error
    }

    //name and email validity test is based on http://www.w3schools.com/php/php_form_url_email.asp
    $name = test_input( $name );
    if( !preg_match( "/^[a-zA-Z ]*$/", $name ) )
    {
        $name = "Only letters and white space allowed.";
    }

    else
    {
        $name = mysqli_real_escape_string( $contactDB, $name );
    }

    $email = test_input( $email );
    if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    {
        $email = "Invalid email format.";
    }

    else
    {
        $email = mysqli_real_escape_string( $contactDB, $email );

        //check if the email has already been in the database
        $checkPK = $contactDB->query( "SELECT * FROM  `messages`  WHERE `Email` = '{$email}'" );
        if( mysqli_num_rows( $checkPK ) > 0 )
        {
            $email = "Email is already in database.";
        }
    }

    //only insert into the query if there are no name or email errors I am using $name/$email instead of specific error variables so if there is an error in on input the other inputs that are correct do not POST deleted and the code has less control statements in the text areas
    $message = mysqli_real_escape_string( $contactDB, $message );
    if( $name !== "Only letters and white space allowed." && $email !== "Invalid email format." && $email !== "Email is already in database." )
    {
        $result = $contactDB->query( "INSERT INTO `messages` (`Name`, `Email`, `Message`) VALUES( '{$name}', '{$email}', '{$message}' );" );

        if( !$result )
        {
            $message = "Error with query.";
        }
    }

    else
    {
        $response[ "error" ] = true;
    }

    //FAILED ATTEMPT TO SEND EMAIL, DOES NOT WORK CURRENTLY
    // if( !isset( $response[ "error" ] ) )    //no errors in their input so send me an email saying that there someone sent me a message
    // {
    //     $message = wordwrap( $message, 70 );
    //     mail( "johnfelen@pitt.edu", "Message from {$name}, {$email}", $message, "From: {$email}" );
    // }

    $response[ "name" ] = $name;
    $response[ "email" ] = $email;
    $response[ "message" ] = $message;

    mysqli_close( $contactDB );
    echo json_encode( $response );
?>
