if( document.URL.split("/").pop() === "index.php" )
{
    var count = 0;
    var currentlyTyping = false;    //used to stop repeat clicking which would cause gibberish to type out

    $( "#main-container" ).click( function()
    {
        printNextLine();
    });

    //use an ajax call to get the text that will be displayed, after we get that start the fade in and start displaying the text, NOTE: I took away the document.ready to speed up the start time of when the picture starts to fade in since the AJAX call already takes time and will finish after document is ready at normal speeds
    $.ajax({
        url: "./php_include_files/pokemon-text.php",
        type: "GET",
        data: { getText : true },
        dataType: "json",
        success: function( textToBeDisplayed )
        {
            lines = textToBeDisplayed.slice( 0, 7 );
            nameTable = textToBeDisplayed[ 7 ];
            movingSpinner = textToBeDisplayed[ 8 ];
            frozenSpinner = textToBeDisplayed[ 9 ];
            brokenMessage = textToBeDisplayed[ 10 ];

            $( "#picture-of-me" ).fadeTo( 3000, 1, function()
            {
                printNextLine();
                blink();
            });
        }
    });

    function printNextLine()    //animates the typing characters, based on the last response in http://stackoverflow.com/questions/23688149/simulate-the-look-of-typing-not-the-actual-keypresses-in-javascript
    {
        if( count < lines.length && !currentlyTyping )
        {
            var chars = lines[ count ].split( "" );

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
            $.ajax({
                url: "./php_include_files/pokemon-text.php",
                type: "POST",
                data: { setTime : true },
                success: function()
                {
                    countDown();
                    $( "#main-container" ).off( "click" );
                    $( "#continue" ).html( frozenSpinner + "<br>" );
                    $( "#broken" ).html( brokenMessage + "<br>" );
                }
            });
        }
    }

    function blink()    //based on second last response on http://stackoverflow.com/questions/18105152/alternative-for-blink since the actual <blink> tag is deprecated, I wonder why
    {
        var blinks = document.getElementsByTagName( "blink" );
        for ( var i = blinks.length - 1; i >= 0; i-- )
        {
            var s = blinks[ i ];

            if( currentlyTyping )
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
}

else if( document.URL.split( "/" ).pop() === "static-index.php" )   //for static-index.php, simplified, no animation, appending for when user is at static page
{
    $.ajax({
        url: "./php_include_files/pokemon-text.php",
        type: "GET",
        data: { getText : true },
        dataType: "json",
        success: function( textToBeDisplayed )
        {
            countDown();
            var lines = textToBeDisplayed.slice( 0, 7 ).join( "<br>" );
            $( "#static-pokemon" ).html( lines );

            var nameTable = textToBeDisplayed[ 7 ] + "<br>";
            $( "#static-names" ).html( nameTable );
            $( "tr" ).removeClass();

            var frozenSpinner = textToBeDisplayed[ 9 ] + "<br>";
            $( "#static-continue" ).html( frozenSpinner );

            var brokenMessage = textToBeDisplayed[ 10 ] + "<br>";
            $( "#static-broken" ).html( brokenMessage );

            if( typeof $.cookie( "timeFinished" ) !== "undefined" )   //they reloaded the page before the countdown was done, go back to where they were( this fixes the bug that 15 minutes would show up and then change to the correct time )
            {
                timeFinishedSec = $.cookie( "timeFinished" );
                diff = timeFinishedSec - getCurrTimeSec();
                $( "#time-left" ).html( formattedTimeLeft() );
            }
        }
    });
}

function countDown()    //will keep outputting how many minutes/seconds the user has left until the "game" will work again, so when zero seconds left redirect to index.php
{
    $.ajax({
        url: "./php_include_files/pokemon-text.php",
        type: "GET",
        data: { getTime : true },
        dataType: "text",
        success: function( stringRepTime )
        {
            if( typeof timeFinishedSec === "undefined" )   //this is a new countdown
            {
                timeFinishedSec = parseInt( stringRepTime ) + 120;
                diff = timeFinishedSec - getCurrTimeSec();
            }

            setInterval( function()
            {
                diff--;
                $( "#time-left" ).html( formattedTimeLeft() );
            },
            1000 );
        }
    });
}

function formattedTimeLeft()    //update text with minutes and seconds to be gramatically correct and concise
{
    if( diff <= 0 )
    {
        window.location = "index.php";
    }

    var pluralSec = ( ( diff % 60 ) === 1 ) ? "" : "s";
    var pluralMin = ( parseInt( diff / 60 ) === 1 ) ? "" : "s";

    if( diff < 60 )
    {
        return ( ( diff % 60 ) + " second" + pluralSec );
    }

    else if( ( diff % 60 ) === 0 )
    {
        return ( parseInt( diff / 60 ) + " minute" + pluralMin );
    }

    else
    {
        return ( parseInt( diff / 60 ) + " minute" + pluralMin + " and " + ( diff % 60 ) + " second" + pluralSec );
    }
}

function getCurrTimeSec()
{
    return parseInt( new Date().getTime() / 1000 );
}

$( window ).unload( function()  //set a cookie with the time that the index.php will reload
{
    $.cookie( "timeFinished", timeFinishedSec,
    {
        path: '/'
    });
});
