if( localStorage.getItem( "current_theme" ) === null )
{
    localStorage.setItem( "current_theme", "picnic-blanket" );
}

var currentTheme = localStorage.getItem( "current_theme" );
setTheme( currentTheme, true );
changeActive( currentTheme, true );
addListeners();

function addListeners() //adds hover( preview new theme ) and click( localStorage-setting and set theme theme )
{
    $( "#theme-menu" ).children( "li" ).each( function()
    {
        var selectedTheme = $( this ).children().attr( "id" );

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

            setTheme( selectedTheme, true );
            changeActive( selectedTheme, true );

            localStorage.setItem( "current_theme", selectedTheme );
            currentTheme = selectedTheme;
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

function setTheme( theme, adding ) //change current theme on page
{
    if( adding )
    {
        $( "html" ).addClass( theme );
        $( "#favicon" ).attr( "href", "./images/" + theme.replace( "-", "_" ) + "/" + $( "#favicon" ).attr( "name" ) );
    }

    else
    {
        $( "html" ).removeClass( theme );
    }
}
