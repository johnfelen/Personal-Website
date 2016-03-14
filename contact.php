<?php
    $pageName = "Contact Me";
    $glyphiconName = "envelope";
    include( "php_include_files/header.php" );
    include( "php_include_files/start-row-10.php" );

    $contactDB = new mysqli( "localhost", "root", "jfelen62", "personal website" );
    if( $contactDB->connect_error )
    {
        $errorWithQuery = $contactDB->connect_error;    //used to print out later so they cannot submit anything, I want the page to load but not allow them to keep submitting if there is an error
    }
    else if( isset( $_POST[ "name" ] ) && isset( $_POST[ "name" ] ) && isset( $_POST[ "name" ] ) )  //technically I only have to check for one since I'm using pattern and required for the inputs, but this will check if they entered anything into the text areas
    {
        //name and email validity test is based on http://www.w3schools.com/php/php_form_url_email.asp
        $name = test_input( $_POST[ "name" ] );
        if( !preg_match( "/^[a-zA-Z ]*$/", $name ) ) 
        {
            $nameError = "Only letters and white space allowed."; 
        }
        
        else
        {
            $name = mysqli_real_escape_string( $contactDB, $_POST[ "name" ] );
        }
        
        $email = test_input( $_POST[ "email" ] );
        if( !filter_var( $email, FILTER_VALIDATE_EMAIL) ) 
        {
            $emailError = "Invalid email format."; 
        }
        
        else
        {
            $email = mysqli_real_escape_string( $contactDB, $_POST[ "email" ] );
            
            //check if the email has already been in the database        
            $checkPK = $contactDB->query( "SELECT * FROM  `messages`  WHERE `Email` = '{$email}'" );
            if( mysqli_num_rows( $checkPK ) > 0 )
            {
                $emailError = "Email is already in database.";
            }
        }
        
        $message = mysqli_real_escape_string( $contactDB, $_POST[ "message" ] );

        if( !isset( $nameError ) && !isset( $emailError ) ) //only insert into the query if there are no name or email errors
        {
            $result = $contactDB->query( "INSERT INTO `messages` (`Name`, `Email`, `Message`) VALUES( '{$name}', '{$email}', '{$message}' );" );
            
            if( !$result )
            {
                $queryError = "Error with query.";
            }
        
        }
    }
    
    mysqli_close( $contactDB );
?>

<p class="font-vollkorn font-small font-center brown" >
    I was born at a young age of zero months in Pittsburgh, Pennsylvania. &nbsp;
    I am now 247 months old. &nbsp;
    In my trek for an education I went to the school district known as Mt. Lebanon. &nbsp;
    As a young lad, I  enjoyed learning, thinking while walking aimlessly, challenging myself, and technology. &nbsp;
    Growing up, I was always a chubby kid probably because when I was first introduced to the internet, I was hooked and a user for life. &nbsp;
    Well, I have not lived all of my life yet so I can not be so sure. &nbsp;
    Let's skip a couple chapters to when I lost a good fifty pounds the summer after junior year of high school. &nbsp; 
    Oddly enough, I did not decide to become a computer science major until I was about to start my senior year. &nbsp;
    My family and friends in school would usually come to me with their technology woes. &nbsp;
    Throughout high school I spent many hours helping others in the community. &nbsp;
    I truly believe that giving is better than receiving, and have centered my, albeit short, career around helping others. &nbsp;
    Plus, my love for learning, yes I was the kid that did not like it when school was cancelled, allowed me to get through college in three years and along the way become a Peer Tutor and Undergraduate Teaching Assistant. &nbsp;
    I am interested in a plethora of computer science areas ranging from software engineering and web development to mobile applications and security. &nbsp;
    I am planning to graduate from the University of Pittsburgh in Spring 2016 and am currently looking for a job post-graduation.
</p>

<p class="font-vollkorn font-small font-center brown" >
    If you wish to contact me, you can send me a message through the form below or send an email to johnfelen@pitt.edu.  &nbsp;
    A link to my r&eacute;sum&eacute; is in the footer along with links to my GitHub and LinkedIn.
</p>

<!--form for their message-->
<!--Since I am using HTML5 I don't have to worry about using php to check if nothing has been imputed I am using pattern and required found at the accepted answer at http://stackoverflow.com/questions/10281962/is-there-a-minlength-validation-attribute-in-html5 -->
<br>
<form action="contact.php" method="post">
    <div class="row">
        <div class="col-xs-5">
            <textarea rows="1" class="font-vollkorn font-small brown rounded-textarea bg-map" placeholder="Your Name" name="name" pattern=".{1,70}" required title="1 to 70 Characters" style="resize:none;"></textarea>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-5">
            <textarea rows="1" class="font-vollkorn font-small brown rounded-textarea bg-map" placeholder="Your Email" name="email" pattern=".{1,70}" required title="1 to 70 Characters" style="resize:none;"></textarea>
        </div>    
    </div>

    <br>
    <textarea rows="10" class="font-vollkorn font-small brown rounded-textarea bg-map" placeholder="Your Message" name="message" pattern=".{1}" required title="At Least 1 Character" style="resize:vertical;"></textarea>

    <br><br>
    <input class="btn btn-lg btn-primary btn-brown font-vollkorn font-small pull-right"
    <?php echo ( isset( $queryError ) ) ? "value=\"Error with DB\" title=\"{$queryError}\"": "type=\"submit\" value=\"Submit Message\" title=\"Send Me The Message!\""; ?>
    />
</form>

<?php
    include( "php_include_files/end-row-10.php" );
    include( "php_include_files/footer.php" );
?>