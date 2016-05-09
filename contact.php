<?php
    $pageName = "Contact Me";
    $fontAwesome = "envelope";
    include( "./format_files/header.php" );
    include( "./format_files/start-row-10.php" );
?>

<p class="font-main font-small font-center color" id="summary"></p>
<p class="font-main font-small font-center color">
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
            <div class="center-textarea-error color-accent font-main help-block with-errors"></div>
        </div>
    </div>

    <br>
    <div class="form-group row">
        <div class="col-xs-5">
            <textarea type="email" rows="1" class="form-control font-main font-small color color-border rounded-textarea-small subtle-pattern" id="email" placeholder="Your Email" minlength="1" maxlength="70" data-error="ERROR:  &nbsp;Enter 1 to 70 Characters!" required></textarea>
            <div class="help-block"></div>
        </div>
        <div class="col-xs-7">
            <div class="center-textarea-error color-accent font-main help-block with-errors"></div>
        </div>
    </div>

    <br>
    <div class="form-group">
        <textarea rows="10" class="form-control font-main font-small color color-border rounded-textarea-large subtle-pattern" id="message" placeholder="Your Message" minlength="1" data-error="ERROR:  &nbsp;Enter at Least 1 Character!" required></textarea>
        <div class="center-textarea-error color-accent font-main help-block with-errors">&nbsp;</div>  <!--the &nbsp; causes no moving of DOM elements when there is an error-->
    </div>

    <input class="btn btn-lg btn-primary btn-color color-border font-main pull-right" type="submit" value="Submit Message" title="Send Me The Message!"/>
</form>

<?php
    include( "./format_files/end-row-10.php" );
    include( "./format_files/footer.php" );
?>
