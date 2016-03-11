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
            <img src="../images/me.jpg" class="picture" alt="Picture of Me" width="100%"/>
            <blink class="invisible">
                <p class="font-ubuntu-mono font-medium font-center brown">
                    Click to Continue
                </p>
            </blink>
        </div>
    <div class="col-xs-3"></div>
</div>

<p class="font-ubuntu-mono font-medium font-center brown" id="pokemon"></p>
<p class="font-center" id="spinner"></p>

<div class="row">
    <div class="col-xs-3"></div>
        <div class="col-xs-6 container-main">
<table class="font-ubuntu-mono font-large brown font-center" style="margin: 0px auto;">				
				<tr><td>NEW NAME</td></tr>
				<tr><td>RED</td></tr>
                <tr><td>ASH</td></tr>
                <tr><td>JACK</td></tr>
                </table>
                </center>
                        </div>
    <div class="col-xs-3"></div>
</div>

<!--based on second last response on http://stackoverflow.com/questions/18105152/alternative-for-blink since the actual <blink> tag is deprecated, I wonder why
NOTE: I also tried to move the javascript into the home.js file but it did not work and kept saying that blink() was not defined, since it was not an error I decided to work on other parts of the project with my time-->
<script type="text/javascript">
    function blink() 
    {
        var blinks = document.getElementsByTagName( "blink" );
        for ( var i = blinks.length - 1; i >= 0; i-- ) 
        {
            var s = blinks[ i ];
            
            if( currentlyTyping )   //this will make the keep continue stop blinking while typing out lines
            {   
                s.style.visibility = "hidden";
            }
            
            else if( count == lines.length )
            {
                s.text = "Choose Your Name"
            }
            
            else if( count == lines.length + 1 )    //we are done with printing out so we can stop blinking( previously "click to continue" but now "chose your name" )
            {
                s.style.visibility = "visible";
                return;
            }
            
            else if( count > 0 )    //the > 0 is to stop from having the short flash of click to continue when the page loads
            {
                s.style.visibility = ( s.style.visibility === "visible" ) ? "hidden" : "visible";
            }           
        }
        
        window.setTimeout(blink, 350);
    }

    if ( document.addEventListener ) 
    {
        document.addEventListener( "DOMContentLoaded", blink, false );
    }
    
    else if ( window.addEventListener ) 
    {
        window.addEventListener( "load", blink, false );
    }
    
    else if ( window.attachEvent ) 
    {
        window.attachEvent( "onload", blink );
    }
    
    else 
    {
        window.onload = blink;
    }
</script>
    
<?php
    include( "include_files/end-row-10.php" );
    include( "include_files/footer.php" );
?>