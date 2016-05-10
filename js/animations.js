setTimeout( function()
{
    $( "#header" ).removeClass( "pan-on" );
    $( "#main-nav" ).removeClass( "fall-in" );
    $( "#main-container" ).removeClass( "pan-on" );
    $( "#footer" ).removeClass( "climb-up" );
}, 6000 );

$( window ).bind( "beforeunload", function()
{
    $( "#header" ).addClass( "pan-off" );
    $( "#main-nav" ).addClass( "fall-out" );
    $( "#main-container" ).addClass( "pan-off" );
    $( "#footer" ).addClass( "climb-down" );
});
