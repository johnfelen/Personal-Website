        <!--close of the main container-->
        </div>
        <?php include( "./format_files/end-row-10.php" ); ?>

        <!--start of the actual footer part-->
        <div id="footer" class="climb-up">
            <?php include( "./format_files/start-row-10.php" ); ?>
            <hr class="color-border">
                <div class="row vertical-center font-main">
                    <div class="col-xs-4 font-left font-footer">
                        <span class="colored-link" id="left-footer-links">
                            <a href="javascript:;" class="footer-margin-left" title="Start Website Tour" id="start-tour"><i class="fa fa-map-signs fa-fw fa-lg fa-3d-icon"></i></a>
                            <a href="mailto:johnfelen@pitt.edu" class="footer-margin-left" title="Email Me at johnfelen@pitt.edu"><i class="fa fa-at fa-fw fa-lg fa-3d-icon"></i></a>
                            <a href="other_files/JohnFelenRésumé.pdf" class="footer-margin-left footer-margin-right" title="Download My R&eacute;sum&eacute;" target="_blank"><i class="fa fa-file-text fa-fw fa-lg fa-3d-icon"></i></a>
                        </span>
                    </div>
                    <!-- the spans for the left and right footer for the highlight to look even with the tour blackdrop -->
                    <div class="col-xs-4 color font-center font-small" id="author" title="Yes, I Am Using My Initials">Designed and Written by J.T. Felen</div>
                    <div class="col-xs-4 font-right font-footer">
                        <span class="colored-link" id="right-footer-links">
                            <a href="https://github.com/johnfelen" class="footer-margin-left footer-margin-right" title="Check out My Github" target="_blank"><i class="fa fa-github fa-fw fa-lg fa-3d-icon"></i></a>
                            <a href="https://www.facebook.com/john.felen" class="footer-margin-right" title="Add Me on Facebook" target="_blank"><i class="fa fa-facebook fa-fw fa-lg fa-3d-icon"></i></a>
                            <a href="https://www.linkedin.com/in/johnfelen" class="footer-margin-right" title="Connect with Me on LinkedIn" target="_blank"><i class="fa fa-linkedin fa-fw fa-lg fa-3d-icon"></i></a>
                        </span>
                    </div>
                </div>
            <hr class="color-border">
            <?php include( "./format_files/end-row-10.php" ); ?>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="http://codegena.com/assets/js/image-preview-for-link.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.10.3/js/bootstrap-tour.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.autohidingnavbar/1.0.5/jquery.bootstrap-autohidingnavbar.min.js"></script>
        <!-- build:js inline ../../dist/js/personal-website.min.js-->
        <script src="./js/animations.js"></script>
        <script src="./js/themes.js"></script>
        <script src="./js/tour.js"></script>
        <script src="./js/index.js"></script>
        <script src="./js/portfolio.js"></script>
        <script src="./js/contact.js"></script>
        <script src="./js/google-analytics.js"></script>
        <!-- /build -->
    </body>
</html>

<?php
    ob_end_flush();
?>
