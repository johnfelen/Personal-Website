var themes = [ "old-map", "billards-table", "pink-rice", "picnic", "stardust" ];

if( !document.cookie )  //set default theme as old-map and it lasts for 7 days long
{
    document.cookie = createGlobalCookie( "theme", themes[ 0 ], 7 );
}

var currentTheme = getCurrentTheme();
changeActive( true, currentTheme );
addListeners();

function addListeners() //adds hover(temporary theme change) and click(cookie-setting and permanent(until cookie expires or new selected) theme change
{
    $( "#theme-menu" ).children( "li" ).each( function( i )
    {
        var selectedTheme = themes[ i ];
        $( "#" + selectedTheme ).hover( function()
        {
            setTheme( selectedTheme );
        },

        function()
        {
            setTheme( currentTheme );
        });

        $( "#" + selectedTheme ).click( function()
        {
            setTheme( selectedTheme );
            changeActive( false, currentTheme );

            document.cookie = createGlobalCookie( "theme", selectedTheme, 7 );
            currentTheme = getCurrentTheme();
            changeActive( true, selectedTheme );
        });
    });
}

function changeActive( adding, theme )
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
    return document.cookie.split( "=" )[ 1 ];
}

function setTheme() //change the body tag to update css
{

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
