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
                $( "#pokemon" ).html( $( "#pokemon" ).html() + "<br>" );
                count++;
                currentlyTyping = false;
                return;
            }

            else if( ( chars[ currentCharIndex ] === "." || chars[ currentCharIndex ] === "!" ) && chars[ currentCharIndex + 1 ] === " " )  //this is just to be uniform so I can have double spaces at the end of a sentence since nbsp; will be printed out if I have it in the chars array
            {
                $( "#pokemon" ).html( $( "#pokemon" ).html() + chars[ currentCharIndex ] + " &nbsp;" );
                currentCharIndex += 2;
            }

            else
            {
                $( "#pokemon" ).html( $( "#pokemon" ).html() + chars[ currentCharIndex ] );
                currentCharIndex++;
            }

            setTimeout( printNextChar, 40 );
        }

        currentlyTyping = true;
        printNextChar();
    }

    else if( count == lines.length )   //print out the name chosing table
    {
        $( "#names" ).html( nameTable + "<br>" );
        $( "#main-container" ).off( "click" );
        $( "#choose-name" ).click( function()
        {
            printNextLine();
        });
        count++;
    }

    else if( count == lines.length + 1 )    //print out spinner to simulate loading and stop the table from highlighting on hover
    {
        $( "tr" ).removeClass();
        $( "#continue" ).html( movingSpinner + "<br>" );
        $( "#choose-name" ).off( "click" );
        $( "#main-container" ).click( function()
        {
            printNextLine();
            count++;    //count++ goes in here because for some reason printNextLine will be called again right away, this allows the user to see movingSpinner
        });
    }

     else if( count == lines.length + 2 )    //"freeze" the spinner and print out that the game broken, set session, and stop the hover effect on the table
    {
        $( "#main-container" ).off( "click" );
        $( "#continue" ).html( frozenSpinner + "<br>" );
        $( "#broken" ).html( brokenMessage + "<br>" );

        $.ajax({
            url: "./php_include_files/pokemon-text.php",
            type: "POST",
            data: { setTime : true }
        });
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
            $( "blink" ).css( "visibility", "hidden" );
        }

        else if( count == lines.length + 1 )    //they now can "choose" their name so change "click to continue" to "choose your name", because of the below else if must have the s.style.visibility line
        {
            $( "#continue" ).html( "Choose Your Name<br>" );
            toggleVisibility();
        }

        else if( count == lines.length + 2 )    //we are done with blinking, make the text visible so the "loading" simulation will show
        {
            $( "blink" ).css( "visibility", "visible" );
            return;
        }

        else if( count > 0 )    //the > 0 is to stop from having the short flash of click to continue when the page loads
        {
            toggleVisibility();
        }
    }

    window.setTimeout( blink, 350 );
}

function toggleVisibility() //wrapper class for visibility, since jquery toggle is display not visibility
{
    if( $( "blink" ).css( "visibility" ) == "visible" )
    {
        $( "blink" ).css( "visibility", "hidden" );
    }

    else
    {
        $( "blink" ).css( "visibility", "visible" );
    }
}

function parseIntoVars( array )
{
    lines = array.slice( 0, 7 );
    nameTable = array[ 7 ];
    movingSpinner = array[ 8 ];
    frozenSpinner = array[ 9 ];
    brokenMessage = array[ 10 ];
}

//use an ajax call to get the text that will be displayed, after we get that start the fade in and start displaying the text, NOTE: I took away the document.ready to speed up the start time of when the picture starts to fade in since the AJAX call already takes time and will finish after document is ready at normal speeds
$.ajax({
    url: "./php_include_files/pokemon-text.php",
    type: "GET",
    data: { getText : true },
    dataType: "json",
    success: function( textToBeDisplayed )
    {
        parseIntoVars( textToBeDisplayed );
        $( "#picture-of-me" ).fadeTo( 3000, 1, function()
        {
            printNextLine();
            blink();
        });
    }
});

$( "#main-container" ).click( function()
{
    printNextLine();
});
