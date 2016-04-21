var lines = [ "Hello there! Welcome to the world of Earth!",
"My name is John Felen! People call me John!",
"This world is inhabited by creatures called humans!",
"For some people, humans are pets. Other use them for fights.",
"Myself...",
"I study humans as profession.",
"First, what is your name?" ];
var nameTable = "\
<div class=\"col-xs-3\"></div>\
    <div class=\"col-xs-6 container-main\">\
        <table class=\"font-ubuntu-mono font-header color color-border font-center fill-n-center\" id=\"choose-name\">\
            <tr class=\"accent-hover\"><td>NEW NAME</td></tr>\
            <tr class=\"accent-hover\"><td>RED</td></tr>\
            <tr class=\"accent-hover\"><td>ASH</td></tr>\
            <tr class=\"accent-hover\"><td>JACK</td></tr>\
        </table>\
    </div>\
<div class=\"col-xs-3\"></div>";
var movingSpinner = "<i class=\"fa fa-spinner fa-pulse fa-3x color\"></i>";
var frozenSpinner = "<i class=\"fa fa-spinner fa-3x color\"></i>"
var brokenMessage = "It looks like the game froze. &nbsp;\
Maybe try to blow into the cartridge and try again in 15 minutes. &nbsp;\
While you are here, feel free to explore my personal website. ";

var count = 0;
var currentlyTyping = false;    //used to stop repeat clicking which would cause gibberish to type out

function printNextLine()
{
    if( count < lines.length && !currentlyTyping )
    {
        var chars = lines[ count ].split( "" );
        /*The below function is based on the last response in http://stackoverflow.com/questions/23688149/simulate-the-look-of-typing-not-the-actual-keypresses-in-javascript
        I tried other ways by myself first and then stubbled upon setTimeout, however I did not know you had to use recursion until I read the above response*/
        var currentCharIndex = 0;
        function printNextChar()
        {
            if( currentCharIndex == chars.length )  //base case
            {
                document.getElementById( "pokemon" ).innerHTML =  document.getElementById( "pokemon" ).innerHTML + "<br>";
                count++;
                currentlyTyping = false;
                return;
            }

            document.getElementById( "pokemon" ).innerHTML =  document.getElementById( "pokemon" ).innerHTML + chars[ currentCharIndex ];
            currentCharIndex++;
            setTimeout( printNextChar, 40 );
        }

        currentlyTyping = true;
        printNextChar();
    }

    else if( count == lines.length )   //print out the name chosing table
    {
        document.getElementById( "names" ).innerHTML =  nameTable + "<br>";
        count++;
    }

    else if( count == lines.length + 1 )    //print out spinner to simulate loading and stop the table from highlighting on hover
    {
        $("tr").removeClass();
        document.getElementById( "continue" ).innerHTML =  movingSpinner + "<br>";
        count++;
    }

     else if( count == lines.length + 2 )    //"freeze" the spinner and print out that the game broken, set session, and stop the hover effect on the table
    {
        document.getElementById( "continue" ).innerHTML =  frozenSpinner + "<br>";
        document.getElementById( "broken" ).innerHTML =  brokenMessage + "<br>";
        count++;

        //TODO: AJAX Call here to set the session variable to load static-index.php
    }
}

//based on second last response on http://stackoverflow.com/questions/18105152/alternative-for-blink since the actual <blink> tag is deprecated, I wonder why
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

        else if( count == lines.length + 1 )    //they now can "choose" their name so change "click to continue" to "choose your name", because of the below else if must have the s.style.visibility line
        {
            document.getElementById( "continue" ).innerHTML =  "Choose Your Name<br>";
            s.style.visibility = ( s.style.visibility === "visible" ) ? "hidden" : "visible";
            $( "#main-container" ).off( "click" );
            $( "#choose-name" ).click( function()
            {
                printNextLine();
            });
        }

        else if( count == lines.length + 2 )    //we are done with blinking, make the text visible so the "loading" simulation will show
        {
            $( "#choose-name" ).on( "click" );
            $( "#main-container" ).on( "click" );
            s.style.visibility = "visible";
            return;
        }

        else if( count > 0 )    //the > 0 is to stop from having the short flash of click to continue when the page loads
        {
            s.style.visibility = ( s.style.visibility === "visible" ) ? "hidden" : "visible";
        }
    }

    window.setTimeout( blink, 350 );
}

//these for are from the stack overflow, it works so I'm not going to change it
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

$( document ).ready( function()
{
    printNextLine();
});

$( "#main-container" ).click( function()
{
    printNextLine();
});
