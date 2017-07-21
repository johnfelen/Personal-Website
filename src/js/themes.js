//used so that the full animations will be played with the dropdown
var endTime = 0;
var dropdownStopped = true;

if( !isFileInURL( "tour" ) )  //does not allow navbar animation for tour
{
    dropdownHover();
}

if( localStorage.getItem( "current_theme" ) === null )  //default theme
{
    localStorage.setItem( "current_theme", "picnic-blanket-i" );
}

var currentTheme = localStorage.getItem( "current_theme" );
setTheme( currentTheme, true );
changeActive( currentTheme, true );
addListeners();

setTimeout( function()
{
    setNavAnimation( true );
}, 1000 );    //must add a delay so that there is not a sideeffect animation when the page loads

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
        changeFavicon( theme, $( "#favicon" ).attr( "name" ) );
    }

    else
    {
        $( "html" ).removeClass( theme );
    }
}

$( ".dropdown, .dropdown-menu" ).click( function( dropdown )   //this prevents the dropdown menu from opening and closing on click or closing when something is slected, based on http://stackoverflow.com/questions/11617048/stop-just-one-dropdown-toggle-from-closing-on-click
{
    dropdown.stopPropagation();
});

function dropdownHover()    //this allows me to add specific animations to how the dropdown menu appears on the screen
{
    $( "#dropdown" ).hover( function()
    {
        if( !$( "#dropdown" ).hasClass( "open" ) )  //does not allow the dropdown-out animation be cut earlier and does not allow it to be accidentally hidden
        {
            dropdownWrapper( true, "dropdown-in", "mouseenter" );
        }
    },
    function()
    {
        if( $( "#dropdown" ).hasClass( "open" ) )  //same idea as above but with dropdown-in animation
        {
            dropdownWrapper( false, "dropdown-out", "mouseleave" );
        }
    });
}

function dropdownWrapper( hoverOn, dropdownClass, mouseMovement )   //wrapper for what goes inside each of the ifs in the hover on and hover off for the dropdown menu, hoverOn is true when the function is for hoverOn, dropdownClass is the animation class to be added and mouseMovement is the unbound movement
{
    if( dropdownStopped )
    {
        hoverAnimation( hoverOn, dropdownClass, mouseMovement );
    }

    else
    {
        $( "#theme-menu" ).one( "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function()
        {
            hoverAnimation( hoverOn, dropdownClass, mouseMovement );
        });
    }
    dropdownStopped = false;
}

function hoverAnimation( hoverOn, dropdownClass, mouseMovement )    //the variables are just passed in from dropdownWrapper and the ifs are just the small differences between the hover on and hover off animation
{
    if( hoverOn )
    {
        $( "#dropdown" ).addClass( "open" );
        setNavAnimation( false );
    }
    $( "#theme-menu" ).addClass( dropdownClass );

    setTimeout( function()
    {
        $( "#theme-menu" ).removeClass( dropdownClass );
        dropdownStopped = true;
        $( this ).unbind( mouseMovement );
        if( !hoverOn )
        {
            $( "#dropdown" ).removeClass( "open" );
            setNavAnimation( true );
            dropdownHover();
        }
    }, 1000 );
}

function setNavAnimation( adding )  //add or remove the navbar animation, it is used to turn off navbar element animations when the dropdown menu is open to fix the bug of the navbar links having a visible transition to the new theme color rather than a immidiate change
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
