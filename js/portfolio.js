//based on the blog http://codegena.com/image-link-preview-on-hover/
$( "p" ).children( "a" ).each( function()
{
    var currId = "#" + $( this ).attr( "id" );


    if( currId !== "#undefined" )
    {
        $( currId ).miniPreview( { prefetch: "pageload" } );
    }
});
