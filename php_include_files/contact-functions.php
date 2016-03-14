<?php
    //this function is also from http://www.w3schools.com/php/php_form_url_email.asp
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>