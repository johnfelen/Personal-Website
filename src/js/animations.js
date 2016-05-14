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

    if( sessionStorage.getItem( "header" ) === null && sessionStorage.getItem( "main_container" ) === null )
    {
        sessionStorage.setItem( "header", "pan-from-right" );
        sessionStorage.setItem( "main_container", "pan-from-left" );
    }

    var headerTransition = sessionStorage.getItem( "header" );
    var mainContainerTransition = sessionStorage.getItem( "main_container" );
    $( "#header" ).addClass( headerTransition );
    $( "#main-container" ).addClass( mainContainerTransition );

    setTimeout( function()
    {
        removeStartAnimations();
        $( ".navbar-fixed-top" ).autoHidingNavbar();
        shadowNavbar();
    }, 1000 );

    $( "#main-nav" ).find( "li" ).each( function()
    {
        var id = $( this ).attr( "id" );
        var currPageNum = pageToNum[ getPath() ];
        var nextPageNum = pageToNum[ id ];

        $( this ).click( function( event )
        {
            event.preventDefault();
            if( nextPageNum !== currPageNum )   //allows the unload animations to run and if they hit the current page they are on, it does not change and the navbar and footer do not move
            {
                // setTimeout( function()
                // {
                //     window.location.href = "./" + id + ".php";
                // }, 1000 );

                if( nextPageNum > currPageNum )
                {
                    $( "#header" ).addClass( "pan-to-right" );
                    $( "#main-container" ).addClass( "pan-to-left" );
                    sessionStorage.setItem( "header", "pan-from-right" );
                    sessionStorage.setItem( "main_container", "pan-from-left" );
                }

                else if( nextPageNum < currPageNum )
                {
                    $( "#header" ).addClass( "pan-to-left" );
                    $( "#main-container" ).addClass( "pan-to-right" );
                    sessionStorage.setItem( "header", "pan-from-left" );
                    sessionStorage.setItem( "main_container", "pan-from-right" );
                }

                var startTime = new Date().getTime();

                $.ajax({
                    url: "./" + id + ".php",
                    type: "GET",
                    data: { AJAX : true },
                    dataType: "json",
                    success: function( pageData )
                    {
                        var requestTime = new Date().getTime() - startTime; //gets the ajax request time to make the data not load for atleast 1 second so that the new webapge is not shown to the user until the new data has been loaded
                        setTimeout( function()
                        {
                            $( "#page-name" ).html( pageData.pageName );
                            $( "title" ).html( pageData.pageName );

                            $( "#font-awesome" ).removeClass();
                            $( "#font-awesome" ).addClass( "fa fa-" + pageData.fontAwesome + " fa-fw" );

                            $( "#main-container" ).html( pageData.mainContainer );

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
                        }, 1000 - requestTime );
                    }
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

            $( "#main-nav" ).addClass( "fall-out" );
            $( "#footer" ).addClass( "climb-down" );
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

function removeStartAnimations()
{
    $( "#header" ).removeClass( headerTransition );
    $( "#main-container" ).removeClass( mainContainerTransition );
    $( "#main-nav" ).removeClass( "fall-in" );
    $( "#footer" ).removeClass( "climb-up" );
}

function getPath()  //returns the path, "" if index
{
    return document.URL.split( "/" ).pop();
}

function isFileInURL( file )    //will figure out if file, ie "tour.php" is in the url, it is used in more than just tour.js
{
    return getPath().indexOf( file ) === 0;
}

function reloadJS( src )    //reloads the javascript file, specifically will be used with animations.js, based on the second answer http://stackoverflow.com/questions/9642205/how-to-force-a-script-reload-and-re-execute
{
    $( "script[ src=\"" + src + "\" ]" ).remove();
    $( "<script>" ).attr( "src", src ).appendTo( "head" );
}

function callStartFunction( pageName )
{
    switch( pageName )
    {
        case "index":
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
    var started = false;
    $( "#main-nav" ).attrchange(
    {
        trackValues: true,
        callback: function( event )
        {
            if( event.attributeName === "style" && event.newValue.search( /inline/i ) === -1 )
            {
                var oldVal = 0;
                if( event.oldValue !== null )   //just so it doesn't print out cannot split a null value
                {
                    oldVal = parseFloat( event.oldValue.split( "top: " )[ 1 ].split( "px;" )[ 0 ] );
                }
                var newVal = parseFloat( event.newValue.split( "top: " )[ 1 ].split( "px;" )[ 0 ] );

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
