<?php
    $pageName = "Contact Me";
    $fontAwesome = "envelope";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );
    require( "./server_functionality/contact-functions.php" );
?>

<p class="font-main font-small font-center color" >
    I was born at a young age of zero months in Pittsburgh, Pennsylvania.  &nbsp;I am now <?php echo ageInMonths( "1995-07-25", "EST" ) ?> months old.  &nbsp;In my trek for an education I went to the school district known as Mt. Lebanon.  &nbsp;As a young lad, I  enjoyed learning, thinking while walking aimlessly, challenging myself, and technology.  &nbsp;Growing up, I was always a chubby kid probably because when I was first introduced to the internet, I was hooked and a user for life.  &nbsp;Well, I have not lived all of my life yet so I can not be so sure.  &nbsp;Let's skip a couple chapters to when I lost a good fifty pounds the summer after junior year of high school.  &nbsp;Oddly enough, I did not decide to become a computer science major until I was about to start my senior year.  &nbsp;My family and friends in school would usually come to me with their technology woes.  &nbsp;Throughout high school I spent many hours helping others in the community.  &nbsp;I truly believe that giving is better than receiving, and have centered my, albeit short, career around helping others.  &nbsp;Plus, my love for learning, yes I was the kid that did not like it when school was cancelled, allowed me to get through college in three years and along the way become a Peer Tutor and Undergraduate Teaching Assistant.  &nbsp;I am interested in a plethora of computer science areas ranging from software engineering and web development to mobile applications and security.  &nbsp;I am planning to graduate from the University of Pittsburgh in Spring 2016 and am currently looking for a job post-graduation.
</p>

<p class="font-main font-small font-center color" >
    If you wish to contact me, you can send me a message through the form below or send an email to johnfelen@pitt.edu.
</p>

<!--Since I am using HTML5 I don't have to worry about using php to check if nothing has been imputed I am using pattern and required found at the accepted answer at http://stackoverflow.com/questions/10281962/is-there-a-minlength-validation-attribute-in-html5 -->
<form id="contact-me" data-toggle="validator">
    <br>
    <div class="form-group has-feedback row">
        <div class="col-xs-5">
            <textarea rows="1" class="form-control font-main font-small color color-border rounded-textarea-small subtle-pattern" id="name" placeholder="Your Name" minlength="1" maxlength="70" data-error="ERROR:  &nbsp;Enter 1 to 70 Characters!" required></textarea>
            <div class="help-block"></div>    <!-- this extra error block and the one for email is used to make the spacing consistant between the contact form textareas( specifically the message one compared to the name and email one) since the actual error printing is to the right for the name and email textareas-->
        </div>
        <div class="col-xs-7">
            <div class="center-textarea-error color-error font-main help-block with-errors"></div>
        </div>
    </div>

    <br>
    <div class="form-group row">
        <div class="col-xs-5">
            <textarea type="email" rows="1" class="form-control font-main font-small color color-border rounded-textarea-small subtle-pattern" id="email" placeholder="Your Email" minlength="1" maxlength="70" data-error="ERROR:  &nbsp;Enter 1 to 70 Characters!" required></textarea>
            <div class="help-block"></div>
        </div>
        <div class="col-xs-7">
            <div class="center-textarea-error color-error font-main help-block with-errors"></div>
        </div>
    </div>

    <br>
    <div class="form-group">
        <textarea rows="10" class="form-control font-main font-small color color-border rounded-textarea-large subtle-pattern" id="message" placeholder="Your Message" minlength="1" data-error="ERROR:  &nbsp;Enter at Least 1 Character!" required></textarea>
        <div class="center-textarea-error color-error font-main help-block with-errors">&nbsp;</div>  <!--the &nbsp; causes no moving of DOM elements when there is an error-->
    </div>

    <input class="btn btn-lg btn-primary btn-color color-border font-main pull-right" type="submit" value="Submit Message" title="Send Me The Message!"/>
</form>

<?php
    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
