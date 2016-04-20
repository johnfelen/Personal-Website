var themes = [ "old-map", "billards-table", "pink-rice", "picnic", "stardust" ];


    document.cookie = createGlobalCookie( "theme", themes[ 0 ], 7 );

console.log( document.cookie );
var currentTheme = getCurrentTheme();
setTheme( currentTheme, true );
changeActive( currentTheme, true );
addListeners();

function addListeners() //adds hover(temporary theme change) and click(cookie-setting and permanent(until cookie expires or new selected) theme change)
{
    $( "#theme-menu" ).children( "li" ).each( function( i )
    {
        var selectedTheme = themes[ i ];
        $( "#" + selectedTheme ).hover( function()
        {
            setTheme( selectedTheme, true );
        },

        function()
        {
            setTheme( selectedTheme, false );
        });

        $( "#" + selectedTheme ).click( function()
        {
            setTheme( currentTheme, false );
            changeActive( currentTheme, false );

            document.cookie = createGlobalCookie( "theme", selectedTheme, 7 );
            currentTheme = getCurrentTheme();
            changeActive( selectedTheme, true );
            setTheme( selectedTheme, true );
        });
    });
}

function changeActive( theme, adding )  //change active of dropdown menu
{
    if( adding )
    {
        //$( $( "#" + theme ).parent() ).addClass( "active" );
    }

    else
    {
        //$( $( "#" + theme ).parent() ).removeClass( "active" );
    }
}

function getCurrentTheme()  //parses theme from cookie
{
    var keyVal = document.cookie.split( ";" )[ 0 ];
    return keyVal.split( "=" )[ 1 ];
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

function createGlobalCookie( key, value, days )  //sets a cookie for a number var number of days and is access from the whole website, it is based on the answer here http://stackoverflow.com/questions/6561687/how-can-i-set-a-cookie-to-expire-after-x-days-with-this-code-i-have
{
    var keyValuePair = key + "=" + value + ";";
    var expires;

    if( days )
    {
        var date = new Date()
        date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
        expires = "expires=" + date.toGMTString() + ";";
    }

    else
    {
        expires = "";
    }

    return keyValuePair + expires + "path=/";
}
