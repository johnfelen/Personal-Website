    <!--close of the main container-->
    </div>
    <?php include( "php_include_files/end-row-10.php" ); ?>

    <!--start of the actual footer part-->
    <?php include( "php_include_files/start-row-10.php" ); ?>
    <hr class="brown">
    <div class="font-vollkorn font-small">
        <p class="footer-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;John Felen's Personal Website</p>
        <p class="footer-right colored-link">
        <!--the résumé is under php_include_files because I did not see a point to make another folder for files when there is only going to be one external file, so I just put it with the php include files-->
            <a href="other_files/JohnFelenRésumé.pdf" title="Download my R&eacute;sum&eacute;" target="_blank"><i class="fa fa-file-text fa-2x"></i></a>
            &nbsp;&nbsp;&nbsp;
            <a href="https://github.com/johnfelen" title="Check out my Github" target="_blank"><i class="fa fa-github fa-2x"></i></a>
            &nbsp;&nbsp;&nbsp;
            <a href="https://www.linkedin.com/in/johnfelen" title="Connect with Me" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
        <hr class="brown"><hr class="brown"><hr class="brown"><hr class="brown">  <!--this somehow fixes the way too much space between three <br>s and one <hr>, margins/padding did not fix the error but 4x <hr> works-->
        <!--the vetrical center class gives too much space so I have a top padding for the left text-->
    </div>
    <?php include( "php_include_files/end-row-10.php" ); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php echo "<script src=\"js/{$glyphiconName}.js\"></script>" ?>
    <script src="js/themes.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
