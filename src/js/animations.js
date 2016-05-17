if( isFileInURL( "tour" ) ) //don't show start animations when he tour is shown
{
    removeStartAnimations();
}

else
{
    var pageToNum = { "" : 0,   //both "" and index point to 0 because there is no subfolder on the home page for index and the id of the li tag is "index"
    "index" : 0,
    "portfolio" : 1,
    "blog" : 2,
    "contact" : 3 };

    if( $( "#animations" ).length === 0 )   //checks if an id exists, if the id exists this is not the page that the user first loaded on and they got here from an AJAX link, based on the accepted answer here http://stackoverflow.com/questions/3373763/jquery-how-to-find-if-div-with-specific-id-exists
    {
    }

    shadowNavbar();
    $( "#main-nav" ).find( "li" ).each( function()
    {
        var id = $( this ).attr( "id" );
        var currPageNum = pageToNum[ getPath() ];
        var nextPageNum = pageToNum[ id ];

        $( this ).click( function( event )
        {
            event.preventDefault();
            if( currPageNum === 0 && nextPageNum !== 0 ) //since the page does not reload anymore, must clear global variables for index.php
            {
                indexUnload();
            }

            if( nextPageNum !== currPageNum )   //allows the unload animations to run and if they hit the current page they are on, it does not change and the navbar and footer do not move
            {
                var startTime = new Date().getTime();
                $.ajax({
                    url: "./" + id + ".php",
                    type: "GET",
                    data: { AJAX : true },
                    dataType: "json",
                    success: function( pageData )
                    {
                        requestTime = new Date().getTime() - startTime; //gets the ajax request time to make the data not load for atleast 1 second so that the new webapge is not shown to the user until the new data has been loaded
                        setTimeout( function()
                        {
                            setNewData( pageData.pageName, pageData.fontAwesome, pageData.mainContainer, id );
                        }, 1000 - requestTime );
                    }
                });

                var headerTransition = "";
                var mainContainerTransition = "";

                if( nextPageNum > currPageNum )
                {
                    headerTransition = "pan-right";
                    mainContainerTransition = "pan-left";
                }

                else
                {
                    headerTransition = "pan-left";
                    mainContainerTransition = "pan-right";
                }

                togglePageTransitions( headerTransition, mainContainerTransition );
                $( "#main-container" ).one( "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function()
                {
                    togglePageTransitions( headerTransition, mainContainerTransition );
                });
            }

            else
            {
                setTimeout( function()  //allows multiple struggles to happen when they click the same link multiple times
                {
                    $( "#header" ).removeClass( "struggle-left" );
                    $( "#main-container" ).removeClass( "struggle-right" );
                }, 1000 );

                $( "#header" ).addClass( "struggle-left" );
                $( "#main-container" ).addClass( "struggle-right" );
            }
        });
    });
}

$( "a" ).click( function( link )    //will not allow links to be clicked on the Tour
{
    if( isFileInURL( "tour" ) )
    {
        link.preventDefault();
    }
});

function togglePageTransitions( headerTransition, mainContainerTransition ) //header and container are panning( left or right ) to tell which way to go and the falling and climbing are constand between pages
{
    $( "#header" ).toggleClass( headerTransition );
    $( "#main-container" ).toggleClass( mainContainerTransition );
    $( "#main-nav" ).toggleClass( "falling" );
    $( "#footer" ).toggleClass( "climbing" );
}

function setNewData( pageName, fontAwesome, mainContainer, id ) //sets the new data on the page link that the user selected and updates the url
{
    $( "#page-name" ).html( pageName );
    $( "title" ).html( pageName );

    //updates favicons so the theme changes and links update the current favicon accordingly
    $( "#favicon" ).attr( "name", "favicon-" + fontAwesome + ".ico" );
    changeFavicon( $( "html" ).attr( "class" ), "favicon-" + fontAwesome + ".ico" );

    $( "#font-awesome" ).removeClass();
    $( "#font-awesome" ).addClass( "fa fa-" + fontAwesome + " fa-fw" );

    $( "#main-container" ).html( mainContainer );

    if( id === "index" )
    {
        id = "./";  //gives empty url for home
    }
    history.pushState( null, null, id );
    $( "#main-nav" ).find( "li" ).each( function()
    {
        $( this ).off( "click" );
    });

    reloadJS( "./js/animations.js" );
    callStartFunction( getPath() );
}

function getPath()  //returns the path, "" if index
{
    return document.URL.split( "/" ).pop();
}

function isFileInURL( file )    //will figure out if file, ie "tour.php" is in the url, it is used in more than just tour.js
{
    return getPath().indexOf( file ) === 0;
}

function getNextTransition( currTransition, start ) //will give the next transition that
{
    if( start )
    {
        return currTransition.split("").join("");
    }
}

function toggleVisibility( element ) //uses an immediate fadeTo toggle if an object is shown( opacity is used instead of visibility since it is sort of glichy )
{
    if( $( element ).css( "opacity" ) == 1 )    //no typecheck, it is technically a string check
    {
        $( element ).fadeTo( 0, 0 );
    }

    else
    {
        $( element ).fadeTo( 0, 1 );
    }
}

function toggleMainParts()  //wrapper class for the visibility toggles that happen when a link is clicked
{
    toggleVisibility( "#main-nav" );
    toggleVisibility( "#header" );
    toggleVisibility( "#main-container" );
    toggleVisibility( "#footer" );
}

function reloadJS( source )    //reloads the javascript file, specifically will be used with animations.js, based on the second answer http://stackoverflow.com/questions/9642205/how-to-force-a-script-reload-and-re-execute
{
    $( "script[ src=\"" + source + "\" ]" ).remove();
    $( "<script>" ).attr( "src", source ).attr( "id", "animations" ).appendTo( "head" );
}

function callStartFunction( pageName )
{
    switch( pageName )
    {
        case "index":
        case "":
            displayIndex();
            break;
        case "portfolio":
            displayPortfolio();
            break;
        case "blog":
            //displayBlog();
            break;
        case "contact":
            displayContact();
            break;
        default:
            break;
    }
}

function shadowNavbar() //using the attrchange plugin to add a shadow( depending if the navbar is hidden or not) and a css3 shadow transition to the navbar being hidden or shown, based off of second answer here http://stackoverflow.com/questions/1397251/event-detect-when-css-property-changed-using-jquery
{
    $( ".navbar-fixed-top" ).autoHidingNavbar();
    var started = false;
    $( "#main-nav" ).attrchange(
    {
        trackValues: true,
        callback: function( event )
        {
            if( event.attributeName === "style" && event.newValue.search( /inline/i ) === -1 )
            {
                var oldVal = 0;
                var newVal = 0;
                //console.log( event.oldValue.indexOf( "top: " ) );
                if( event.oldValue.indexOf( "top: " ) > -1 )   //just so there is not a print out of cannot read property 'split' of undefined
                {
                    oldVal = parseFloat( event.oldValue.split( "top: " )[ 1 ].split( "px;" )[ 0 ] );
                }

                if( event.newValue.indexOf( "top: " ) > -1 )    //DITTO of above
                {
                    newVal = parseFloat( event.newValue.split( "top: " )[ 1 ].split( "px;" )[ 0 ] );
                }

                if( newVal < oldVal && !started )   //hides the navbr
                {
                    setTimeout( function()
                    {
                        $( "#main-nav" ).addClass( "shadow-hidden" );
                        $( "#main-nav" ).removeClass( "shadow-start" );
                        started = true;
                    }, 200 );
                    $( "#main-nav" ).addClass( "shadow-start" );
                    $( "#main-nav" ).removeClass( "shadow-shown" );
                }

                else if( started )  //shows the navbar
                {
                    setTimeout( function()
                    {
                        $( "#main-nav" ).addClass( "shadow-shown" );
                        $( "#main-nav" ).removeClass( "shadow-end" );
                        started = false;
                    }, 200 );
                    $( "#main-nav" ).addClass( "shadow-end" );
                    $( "#main-nav" ).removeClass( "shadow-hidden" );
                }
            }
        }
    });
}

function changeFavicon( theme, faviconName )
{
    $( "#favicon" ).attr( "href", faviconFilePath( theme, faviconName ) );
}

function faviconFilePath( theme, faviconName ) //returns the file path to the favicon
{
    return "./images/" + theme.split( "-" ).join( "_" ) + "/" + faviconName;
}
