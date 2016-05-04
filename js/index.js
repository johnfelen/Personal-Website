if( isFileInURL( "static-index.php" ) )   //for static-index.php, simplified, no animation, appending for when user is at static page
{
    $.ajax({
        url: "./server_functionality/pokemon-text.php",
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
            toggleVisibility( "#" + sessionStorage.getItem( "selected_name" ) );  //will put the name that they selected back for when the static page is loaded

            var frozenSpinner = textToBeDisplayed[ 9 ] + "<br>";
            $( "#static-continue" ).html( frozenSpinner );

            var brokenMessage = textToBeDisplayed[ 10 ] + "<br>";
            $( "#static-broken" ).html( brokenMessage );

            if( localStorage.getItem( "time_finished" ) )   //they reloaded the page before the countdown was done, go back to where they were( this fixes the bug that 15 minutes would show up and then change to the correct time )
            {
                timeFinishedSec = parseInt( localStorage.getItem( "time_finished" ) );
                diff = timeFinishedSec - getCurrTimeSec();
                $( "#time-left" ).html( formattedTimeLeft() );
            }
        }
    });
}

else   //functionality for the animated pokemon text
{
    var count = 0;
    var currentlyTyping = false;    //used to stop repeat clicking which would cause gibberish to type out

    $( "#main-container" ).click( function()
    {
        printNextLine();
    });

    $.ajax({    //use an ajax call to get the text that will be displayed, after we get that start the fade in and start displaying the text, NOTE: I took away the document.ready to speed up the start time of when the picture starts to fade in since the AJAX call already takes time and will finish after document is ready at normal speeds
        url: "./server_functionality/pokemon-text.php",
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
                    $( "#pokemon" ).append( "<br>" );
                    count++;
                    currentlyTyping = false;
                    return;
                }

                else if( ( chars[ currentCharIndex ] === "." || chars[ currentCharIndex ] === "!" ) && chars[ currentCharIndex + 1 ] === " " )  //this is just to be uniform so I can have double spaces at the end of a sentence since nbsp; will be printed out if I have it in the chars array
                {
                    $( "#pokemon" ).append( chars[ currentCharIndex ] + " &nbsp;" );
                    currentCharIndex += 2;
                }

                else
                {
                    $( "#pokemon" ).append( chars[ currentCharIndex ] );
                    currentCharIndex++;
                }

                setTimeout( printNextChar, 40 );
            }

            currentlyTyping = true;
            printNextChar();
        }

        else if( count === lines.length )   //print out the name chosing table
        {
            $( "#names" ).html( nameTable + "<br>" );

            $( "#choose-name tr" ).each( function() //allows the to choose the name a la pokemon sideways triangle buttons
            {
                $( this ).hover( function()
                {
                    toggleVisibility( $( this ).find( "i" ) );
                },

                function()
                {
                    toggleVisibility( $( this ).find( "i" ) );
                });

                $( this ).click( function()
                {
                    sessionStorage.setItem( "selected_name", $( this ).find( "i" ).attr( "id" ) );
                });
            });

            $( "#main-container" ).off( "click" );
            $( "#choose-name" ).click( function()
            {
                printNextLine();
            });
            count++;
        }

        else if( count === lines.length + 1 )    //print out spinner to simulate loading and stop the table from highlighting on hover
        {
            $( "tr" ).removeClass();
            $( "#continue" ).html( movingSpinner + "<br>" );
            $( "#choose-name tr" ).unbind( "mouseenter mouseleave" );   //saves the name that the client choose
            $( "#choose-name tr" ).off( "click" );
            $( "#main-container" ).click( function()
            {
                printNextLine();
                count++;    //count++ goes in here because for some reason printNextLine will be called again right away, this allows the user to see movingSpinner
            });
        }

         else if( count === lines.length + 2 )    //"freeze" the spinner and print out that the game broken, set session, and stop the hover effect on the table
        {
            $.ajax({
                url: "./server_functionality/pokemon-text.php",
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

            else if( count === lines.length + 1 )    //they now can "choose" their name so change "click to continue" to "choose your name", because of the below else if must have the s.style.visibility line
            {
                $( "#continue" ).html( "Choose Your Name<br>" );
                toggleVisibility( "blink" );
            }

            else if( count === lines.length + 2 )    //we are done with blinking, make the text visible so the "loading" simulation will show
            {
                $( "blink" ).css( "visibility", "visible" );
                return;
            }

            else if( count > 0 )    //the > 0 is to stop from having the short flash of click to continue when the page loads
            {
                toggleVisibility( "blink" );
            }
        }

        window.setTimeout( blink, 350 );
    }
}

function toggleVisibility( element ) //wrapper class for visibility, since jquery toggle is display not visibility
{
    if( $( element ).css( "visibility" ) === "visible" )
    {
        $( element ).css( "visibility", "hidden" );
    }

    else
    {
        $( element ).css( "visibility", "visible" );
    }
}

function countDown()    //will keep outputting how many minutes/seconds the user has left until the "game" will work again, so when zero seconds left redirect to index.php
{
    $.ajax({
        url: "./server_functionality/pokemon-text.php",
        type: "GET",
        data: { getTime : true },
        dataType: "text",
        success: function( stringRepTime )
        {
            if( typeof timeFinishedSec === "undefined" )   //this is a new countdown
            {
                timeFinishedSec = parseInt( stringRepTime ) + 900;
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

function formattedTimeLeft()    //update text with minutes and seconds to be gramatically correct and concise, removes localStorage and cookie when 15 minutes has been up
{
    if( diff <= 0 )
    {
        localStorage.removeItem( "time_finished" );
        sessionStorage.removeItem( "selected_name" )
        window.location.href = "./index.php";
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

$( window ).unload( function()  //set local storage(since if they restart the browser they it counts as fixing the "game") with the time that the index.php will reload
{
    if( typeof timeFinishedSec !== "undefined" )
    {
        localStorage.setItem( "time_finished", timeFinishedSec );
    }
});
