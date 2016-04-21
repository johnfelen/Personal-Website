$.ajax({
    url: "./php_include_files/pokemon-text.php",
    type: "GET",
    data: { getText : true },
    dataType: "json",
    success: function( textToBeDisplayed )
    {
        appendToPage( textToBeDisplayed );
    }
});

function appendToPage( array )  //simplified appending with no animation for when user is at static page
{
    var lines = array.slice( 0, 7 ).join( "<br>" );
    $( "#static-pokemon" ).html( lines );

    var nameTable = array[ 7 ] + "<br>";
    $( "#static-names" ).html( nameTable );
    $( "tr" ).removeClass();

    var frozenSpinner = array[ 9 ] + "<br>";
    $( "#static-continue" ).html( frozenSpinner );

    var brokenMessage = array[ 10 ] + "<br>";
    $( "#static-broken" ).html( brokenMessage );

}
