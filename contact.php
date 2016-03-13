<?php
    $pageName = "Contact Me";
    $glyphiconName = "envelope";
    include( "php_include_files/header.php" );
    include( "php_include_files/start-row-10.php" );
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
<br>
<form action="contact.php" method="post">
    <!--For some reason some styles have to be done inline with a text area(atleast the ones that I have inline, when I try them in an external style sheet they are not applied
    Also the rounded corners for the text area are based the accepted answer from http://stackoverflow.com/questions/26272350/rounded-corners-to-a-textarea-->
    <div class="row">
        <div class="col-xs-5">
            <textarea rows="1" class="font-vollkorn font-small brown bg-map" placeholder="Your Name" name="name" 
            style="width:100%; resize:none; border-radius:10px; box-shadow: 0 0 0 3px; border: 3px solid transparent;"></textarea>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-5">
            <textarea rows="1" class="font-vollkorn font-small brown bg-map" placeholder="Your Email" name="email" 
            style="width:100%; resize:none; border-radius:10px; box-shadow: 0 0 0 3px; border: 3px solid transparent;"></textarea>
        </div>    
    </div>

    <br>
    <textarea rows="10" class="font-vollkorn font-small brown bg-map" placeholder="Your Message" name="message" 
    style="width:100%; resize:vertical; border-radius:10px; box-shadow: 0 0 0 3px; border: 3px solid transparent;"></textarea>

    <br><br>
    <div class="row">
        <div class="col-xs-9"></div>
        <div class="col-xs-3">
            <input class="btn btn-lg btn-primary btn-block btn-brown" type="submit" value="Submit Message" title="Send Me The Message!"/>
        </div>
    </div>
</form>

<?php
    include( "php_include_files/end-row-10.php" );
    include( "php_include_files/footer.php" );
?>