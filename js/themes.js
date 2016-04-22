var themes = [ "picnic", "billards-table", "pink-rice", "old-map", "stardust" ];

if( typeof $.cookie( "theme" ) === "undefined" )
{
    createCookie( themes[ 0 ] );
}

var currentTheme = getCurrentTheme();
setTheme( currentTheme, true );
changeActive( currentTheme, true );
addListeners();

function addListeners() //adds hover( preview new theme ) and click( cookie-setting and set theme theme )
{
    $( "#theme-menu" ).children( "li" ).each( function( i )
    {
        var selectedTheme = themes[ i ];

        $( "#" + selectedTheme ).hover( function()
        {
            setTheme( currentTheme, false );
            setTheme( selectedTheme, true );
        },

        function()
        {
            setTheme( selectedTheme, false );
            setTheme( currentTheme, true );
        });

        $( "#" + selectedTheme ).click( function()
        {
            setTheme( currentTheme, false );
            changeActive( currentTheme, false );

            createCookie( selectedTheme );
            currentTheme = getCurrentTheme();

            setTheme( selectedTheme, true );
            changeActive( selectedTheme, true );
        });
    });
}

function changeActive( theme, adding )  //change active of dropdown menu
{
    if( adding )
    {
        $( $( "#" + theme ).parent() ).addClass( "active" );
    }

    else
    {
        $( $( "#" + theme ).parent() ).removeClass( "active" );
    }
}

function getCurrentTheme()  //parses theme from cookie
{
    return $.cookie( "theme" );
}

function setTheme( theme, adding ) //change current theme on page
{
    if( adding )
    {
        $( "html" ).addClass( theme );
    }

    else
    {
        $( "html" ).removeClass( theme );
    }
}

function createCookie( theme )  //wrapper for cookie
{
    $.cookie( "theme", theme,
    {
        expires: 7,
        path: '/'
    });
}
