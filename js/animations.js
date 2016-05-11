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
        var currPageNum = pageToNum[ document.URL.split( "/" ).pop() ];
        var nextPageNum = pageToNum[ id ];

        $( this ).click( function()
        {
            if( nextPageNum !== currPageNum )   //allows the unload animations to run and if they hit the current page they are on, it does not change and the navbar and footer do not move
            {
                setTimeout( function()
                {
                    window.location.href = "./" + id + ".php";
                }, 1000 );

                $( "#main-nav" ).addClass( "fall-out" );
                $( "#footer" ).addClass( "climb-down" );
            }

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
