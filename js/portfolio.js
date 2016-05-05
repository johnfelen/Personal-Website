if( isFileInURL( "portfolio" ) )
{
    if( sessionStorage.getItem( "current_sort" ) === null )
    {
        sessionStorage.setItem( "current_sort", "lang=fa-sort-asc" );
    }

    var getPair = sessionStorage.getItem( "current_sort" ).split( "=" );

    //to use a variable-variable pair relationship to be sent in AJAX, you must use key value pairs, based on second answer http://stackoverflow.com/questions/11687217/variable-data-in-ajax-call-jquery
    var currentSort = {};
    currentSort[ getPair[ 0 ] ] = getPair[ 1 ];

    $.ajax({
        url: "./server_functionality/portfolio-functions.php",
        type: "GET",
        data: currentSort,
        dataType: "json",
        success: function( outputData )
        {
            $( "#main-container" ).html( outputData[ 0 ] + outputData[ 1 ] );

            //based on the blog http://codegena.com/image-link-preview-on-hover/
            $( "p" ).children( "a" ).each( function()
            {
                var currId = "#" + $( this ).attr( "id" );

                if( currId !== "#undefined" )
                {
                    $( currId ).miniPreview( { prefetch: "parenthover" } );
                }
            });
        }
    });
}
