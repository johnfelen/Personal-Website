var nonAJAXLink = true;
var pageToNum = { "" : 0,   //both "" and index point to 0 because there is no subfolder on the home page for index and the id of the li tag is "index"
"index" : 0,
"portfolio" : 1,
"blog" : 2,
"contact" : 3 };

if( isFileInURL( "tour" ) ) //don't show start animations when he tour is shown
{
    removeStartAnimations();
}

else if( nonAJAXLink )   //the user got here by not clicking the ajax links so must show them the page parts comming together
{
    clearAJAXLinks();
    $( "#main-container" ).one( "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function()  //listener that runs only once when the starting animations finish, based off accepted answer here http://stackoverflow.com/questions/9255279/callback-when-css3-transition-finishes
    {
        togglePageTransitions( "pan-left-start", "pan-right-start", true );
        shadowNavbar();
        addAJAXLinks();
    });
}

$( "a" ).click( function( link )    //will not allow links to be clicked on the Tour
{
    if( isFileInURL( "tour" ) )
    {
        link.preventDefault();
    }
});

function addAJAXLinks()
{
    $( "#main-nav" ).find( "li" ).each( function()
    {
        var id = $( this ).attr( "id" );
        var currPageNum = pageToNum[ getPath() ];
        var nextPageNum = pageToNum[ id ];

        $( this ).click( function( event )
        {
            clearAJAXLinks();
            nonAJAXLink = false;
            if( nextPageNum !== currPageNum )   //allows the unload animations to run and if they hit the current page they are on, it does not change and the navbar and footer do not move
            {
                if( currPageNum === 0 && nextPageNum !== 0 ) //since the page does not reload anymore, must unload index( set a time for the countadown if it started )
                {
                    indexUnload();
                }

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

                togglePageTransitions( headerTransition, mainContainerTransition, false );

                $( "#main-container" ).one( "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function()
                {
                    togglePageTransitions( headerTransition, mainContainerTransition, false );
                    addAJAXLinks();
                });
            }

            else
            {
                setTimeout( function()  //allows multiple struggles to happen when they click the same link multiple times after the animation ends, using a timeout because it does not interfere with the other end of animation listeners
                {
                    $( "#header" ).removeClass( "struggle-left" );
                    $( "#main-container" ).removeClass( "struggle-right" );
                    addAJAXLinks();
                }, 1000 );

                $( "#header" ).addClass( "struggle-left" );
                $( "#main-container" ).addClass( "struggle-right" );
            }
        });
    });
}

function clearAJAXLinks()   //clears the AJAX links and prevents the links from being clicked, it helps fix the bugs where if someone was clicking two quickly after any of the navbar links were clicked and unintended transitions happened
{
    $( "#main-nav" ).find( "li" ).each( function()
    {
        $( this ).off( "click" );
    });

    $( "#main-nav" ).find( "li" ).each( function()
    {
        $( this ).click( function( event )
        {
            event.preventDefault();
        });
    });
}

function togglePageTransitions( headerTransition, mainContainerTransition, onLoad ) //header and container are panning( left or right ) to tell which way to go and the falling and climbing are constand between pages, onLoad is run when somebody gets to a page not using AJAX links, such as typing in the URL
{
    if( onLoad )
    {
        $( "#main-nav" ).removeClass( "falling-start" );
        $( "#footer" ).removeClass( "climbing-start" );
        $( "#header" ).removeClass( headerTransition );
        $( "#main-container" ).removeClass( mainContainerTransition );
    }

    else
    {
        $( "#main-nav" ).toggleClass( "falling" );
        $( "#footer" ).toggleClass( "climbing" );
        $( "#header" ).toggleClass( headerTransition );
        $( "#main-container" ).toggleClass( mainContainerTransition );
    }
}

function setNewData( pageName, fontAwesome, mainContainer, id ) //sets the new data on the page link that the user selected and updates the url
{
    if( id === "index" )
    {
        id = "./";  //gives empty url for home
    }

    history.pushState( null, null, id );
    callStartFunction( getPath() );

    $( "#page-name" ).html( pageName );
    $( "title" ).html( pageName );

    //updates favicons so the theme changes and links update the current favicon accordingly
    $( "#favicon" ).attr( "name", "favicon-" + fontAwesome + ".ico" );
    changeFavicon( $( "html" ).attr( "class" ), "favicon-" + fontAwesome + ".ico" );

    $( "#font-awesome" ).removeClass();
    $( "#font-awesome" ).addClass( "fa fa-" + fontAwesome + " fa-fw" );

    $( "#main-container" ).html( mainContainer );
}

function getPath()  //returns the path, "" if index
{
    return document.URL.split( "/" ).pop();
}

function isFileInURL( file )    //will figure out if file, ie "tour.php" is in the url, it is used in more than just tour.js
{
    return getPath().indexOf( file ) === 0;
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

                if( event.oldValue !== null && event.oldValue.indexOf( "top: " ) > -1 )   //just so there is not a print out of cannot read property 'split' of undefined
                {
                    oldVal = parseFloat( event.oldValue.split( "top: " )[ 1 ].split( "px;" )[ 0 ] );
                }

                if( event.newValue.indexOf( "top: " ) > -1 )
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
