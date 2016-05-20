<?php
    $pageName = "Contact Me";
    $fontAwesome = "envelope";

    include( "./server_functionality/page-data-start.php" );
?>

<p class="font-main font-small font-center color" id="summary"></p>
<p class="font-main font-small font-center color">
    If you wish to contact me, you can send me a message through the form below or send an email to johnfelen@pitt.edu.
</p>

<!--Since I am using HTML5 I don't have to worry about using php to check if nothing has been imputed I am using pattern and required found at the accepted answer at http://stackoverflow.com/questions/10281962/is-there-a-minlength-validation-attribute-in-html5 -->
<form id="contact-me" data-toggle="validator">
    <br>
    <div class="control-group row">
        <div class="col-xs-5">
            <textarea rows="1" class="font-main font-small color color-border rounded-textarea-small subtle-pattern" id="name" placeholder="Your Name" data-validation-required-message="This field is required!" maxlength="70" data-validation-maxlength-message="This field can only have 70 characters!" aria-invalid="false"></textarea>
        </div>
        <div class="col-xs-7">
            <div class="help-block"></div>
        </div>
    </div>

    <br>
    <div class="control-group row">
        <div class="col-xs-5">
            <textarea type="email" rows="1" class="font-main font-small color color-border rounded-textarea-small subtle-pattern" id="email" placeholder="Your Email" data-validation-required-message="This field is required!" maxlength="70" data-validation-maxlength-message="This field can only have 70 characters!" data-validation-email-message="That is not a valid email address!" data-validation-ajax-ajax="./server_functionality/contact-functions.php" data-validation-ajax-message="The email address is already in the database!" aria-invalid="false"></textarea>
        </div>
        <div class="col-xs-7">
            <div class="help-block"></div>
        </div>
    </div>

    <br>
    <div class="control-group">
        <textarea rows="10" class="font-main font-small color color-border rounded-textarea-large subtle-pattern" id="message" placeholder="Your Message" data-validation-required-message="This field is required!" aria-invalid="false"></textarea>
        <div class="help-block">&nbsp;</div>  <!--the &nbsp; causes no moving of DOM elements when there is an error-->
    </div>

    <input class="btn btn-lg btn-primary btn-color color-border font-main pull-right" type="submit" value="Submit Message" title="Send Me The Message!"/>
</form>

<?php
    include( "./server_functionality/page-data-end.php" );
?>
