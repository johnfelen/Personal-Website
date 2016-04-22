$( "#contact-me" ).submit( function( form )
{
    form.preventDefault();
    $.ajax({
        url: "./php_include_files/insert-message.php",
        type: "POST",
        dataType: "json",
        data: { messageInfo : getMessageInfo() },
        success: function( databaseResponse )
        {
            console.log( databaseResponse[ "name" ] );
            console.log( databaseResponse[ "email" ] );
            console.log( databaseResponse[ "error" ] );
            if( typeof databaseResponse[ "error" ] !== "undefined" )
            {
                $( "#name" ).val( databaseResponse[ "name" ] );
                $( "#email" ).val( databaseResponse[ "email" ] );
                $( "#message" ).val( databaseResponse[ "error" ] );
            }

            else
            {
                console.log( "Your message has successfully been sent" );
                //TODO: send me an email
            }
        },
        error: function( name )
        {
            console.log( name.responseText );
        }
    });
});

function getMessageInfo()
{
    var formInput =
    {
        "name" : $( "#name" ).val(),
        "email" : $( "#email" ).val(),
        "message" : $( "#message" ).val()
    };

    return JSON.stringify( formInput );
}
