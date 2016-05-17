if( localStorage.getItem( "current_theme" ) === null )
{
    localStorage.setItem( "current_theme", "picnic-blanket" );
}

var currentTheme = localStorage.getItem( "current_theme" );
setTheme( currentTheme, true );
changeActive( currentTheme, true );
addListeners();

setTimeout( function()
{
    setNavAnimation( true );
}, 600 );    //must add a delay so that there is not a sideeffect animation when the page loads

function addListeners() //adds hover( preview new theme ) and click( localStorage-setting and set theme theme )
{
    $( "#theme-menu" ).children( "li" ).each( function()
    {
        var selectedTheme = $( this ).children().attr( "id" );

        $( "#" + selectedTheme ).hover( function()
        {
            setNavAnimation( false );   //calling this function here and in the out function fixeds the bug with the icon color on the animating when the theme color is changed
            setTheme( currentTheme, false );
            setTheme( selectedTheme, true );
        },
        function()
        {
            setTheme( selectedTheme, false );
            setTheme( currentTheme, true );
            setNavAnimation( true );
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
        changeFavicon( theme, $( "#favicon" ).attr( "name" ) );

        //copys the current theme favicon for the PDF to the root so it shows when you click my resume
        $.ajax({
            url: "./server_functionality/change-base-favicon.php",
            type: "POST",
            data: { faviconPath : faviconFilePath( theme, "favicon-file-text.ico" ) }
        });
    }

    else
    {
        $( "html" ).removeClass( theme );
    }
}

function setNavAnimation( adding )  //add or remove the navbar animation
{
    $( "#main-nav" ).find( "li" ).each( function()
    {
        if( adding )
        {
            $( this ).addClass( "navbar-animation" );
        }

        else
        {
            $( this ).removeClass( "navbar-animation" );
        }
    });
}

$( ".dropdown, .dropdown-menu" ).click( function( dropdown )   //this prevents the dropdown menu from opening and closing on click or closing when something is slected, based on http://stackoverflow.com/questions/11617048/stop-just-one-dropdown-toggle-from-closing-on-click
{
    dropdown.stopPropagation();
});

//this allows me to add specific animations to how the dropdown menu appears on the screen, based off http://bootsnipp.com/snippets/nPlX7
$( ".dropdown" ).hover( function()
{
    $( ".dropdown" ).toggleClass( "open" );
    $( "#theme-menu" ).addClass( "dropdown-in" );
    setTimeout( function()
    {
        $( "#theme-menu" ).removeClass( "dropdown-in" );
    }, 1000 );
},
function()
{
    $( "#theme-menu" ).addClass( "dropdown-out" );
    setTimeout( function()
    {
        $( "#theme-menu" ).removeClass( "dropdown-out" );
        $( ".dropdown" ).toggleClass( "open" );    //doesn't hide the navbar until the animation is over
    }, 1000 );
});
