if( isFileInURL( "portfolio" ) )
{
    displayPortfolio();
}

function displayPortfolio()
{
    if( sessionStorage.getItem( "current_sort" ) === null )
    {
        sessionStorage.setItem( "current_sort", "lang=fa-sort-asc" );
    }
    getProjects();
}

function getProjects()  //display the projects and the current sorting buttons on protfolio.php
{
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

            $( "#sort-buttons li a" ).each( function()    //add the custom click listeners to sort the buttons without reloading the page
            {
                $( this ).click( function( link )
                {
                    link.preventDefault(); //removes the # from the url, probably could be done by taking it out of the href for the buttons in protfolio-functions.php
                    sessionStorage.setItem( "current_sort", $( this ).attr( "id" ) );
                    displayPortfolio();
                });
            });
        }
    });
}
