//both "" and index point to 0 because there is no subfolder on the home page for index and the id of the li tag is "index"
var pageToNum = { "" : 0,
"index" : 0,
"portfolio" : 1,
"blog" : 2,
"contact" : 3 };

setTimeout( function()
{
    $( "#header" ).removeClass( "pan-on" );
    $( "#main-nav" ).removeClass( "fall-in" );
    $( "#main-container" ).removeClass( "pan-on" );
    $( "#footer" ).removeClass( "climb-up" );
}, 600 );

$( "#main-nav" ).find( "li" ).each( function()
{
    var id = $( this ).attr( "id" );
    var currPageNum = pageToNum[ document.URL.split( "/" ).pop() ];
    var nextPageNum = pageToNum[ id ];

    $( this ).click( function()
    {
        if( nextPageNum !== currPageNum )
        {
            setTimeout( function()
            {
                window.location.href = "./" + id + ".php";
            }, 600 );

            $( "#main-nav" ).addClass( "fall-out" );
            $( "#footer" ).addClass( "climb-down" );
        }

        if( nextPageNum > currPageNum )
        {
            $( "#header" ).addClass( "pan-to-right" );
            $( "#main-container" ).addClass( "pan-to-right" );
        }

        else if( nextPageNum < currPageNum )
        {
            $( "#header" ).addClass( "pan-to-left" );
            $( "#main-container" ).addClass( "pan-to-left" );
        }

        else
        {
            setTimeout( function()  //allows multiple struggles to happen when they click the same link multiple times
            {
                $( "#header" ).removeClass( "struggle-left" );
                $( "#main-container" ).removeClass( "struggle-left" );;
            }, 600 );

            $( "#header" ).addClass( "struggle-left" );
            $( "#main-container" ).addClass( "struggle-left" );
        }
    });
});
