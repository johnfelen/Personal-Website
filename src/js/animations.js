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
    }, 1000 );

    $( "#main-nav" ).find( "li" ).each( function()
    {
        var id = $( this ).attr( "id" );
        var currPageNum = pageToNum[ getPath() ];
        var nextPageNum = pageToNum[ id ];

        console.log( "next " + nextPageNum );

        $( this ).click( function( event )
        {
            event.preventDefault();
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
                        var requestTime = new Date().getTime() - startTime; //gets the ajax request time to make the data not load for atleast 1 second so that the new webapge is not shown to the user until the new data has been loaded, based on http://stackoverflow.com/questions/3498503/find-out-how-long-an-ajax-request-took-to-complete

                        setTimeout( function()
                        {
                            $( "#page-name" ).html( pageData.pageName );

                            $( "#font-awesome" ).removeClass();
                            $( "#font-awesome" ).addClass( "fa fa-" + pageData.fontAwesome + " fa-fw" );

                            $( "#main-container" ).html( pageData.mainContainer );

                            history.pushState( null, null, id );
                            callStartFunction( getPath() );

                            headerTransition = sessionStorage.getItem( "header" );
                            mainContainerTransition = sessionStorage.getItem( "main_container" );
                            $( "#header" ).addClass( headerTransition );
                            $( "#main-container" ).addClass( mainContainerTransition );

                            setTimeout( function()
                            {
                                removeStartAnimations();
                                $( ".navbar-fixed-top" ).autoHidingNavbar();
                            }, 1000 );

                            currPageNum = pageToNum[ getPath() ];

                        }, 1000 - requestTime );


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

                        $( "#main-nav" ).addClass( "fall-out" );
                        $( "#footer" ).addClass( "climb-down" );
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
        });
    });
}

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

function isFileInURL( file )   //will figure out if file, ie "tour.php" is in the url, it is used in more than just tour.js
{
    return getPath().indexOf( file ) === 0;
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
