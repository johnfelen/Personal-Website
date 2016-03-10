<?php
    $pageName = "Home";
    $glyphiconName = "home";
    include( "include_files/header.php" );
    include( "include_files/start-row-10.php" );
?>
    
<!--Pokemon reference for a little humour-->
<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <img src="../images/me.jpg" class="picture" alt="Picture of Me" width="100%">
            <blink>
            <p class="font-ubuntu-mono font-medium font-center brown">
                Click to Continue
            </p>
            </blink>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center brown" id="pokemon">

</p>

<!--based on second last response on http://stackoverflow.com/questions/18105152/alternative-for-blink since the actual <blink> tag is deprecated-->
<script type="text/javascript">
    function blink() {
    var blinks = document.getElementsByTagName('blink');
    for (var i = blinks.length - 1; i >= 0; i--) {
    var s = blinks[i];
    s.style.visibility = (s.style.visibility === 'visible') ? 'hidden' : 'visible';
    }
    window.setTimeout(blink, 350);
    }
    if (document.addEventListener) document.addEventListener("DOMContentLoaded", blink, false);
    else if (window.addEventListener) window.addEventListener("load", blink, false);
    else if (window.attachEvent) window.attachEvent("onload", blink);
    else window.onload = blink;
</script>
    
<?php
    include( "include_files/end-row-10.php" );
    include( "include_files/footer.php" );
?>