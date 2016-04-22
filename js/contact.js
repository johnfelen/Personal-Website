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
            if( typeof databaseResponse[ "error" ] !== "undefined" )
            {
                $( "#name" ).val( databaseResponse[ "name" ] );
                $( "#email" ).val( databaseResponse[ "email" ] );
                $( "#message" ).val( databaseResponse[ "message" ] );
            }

            else
            {
                $( "#message" ).val( "Your message has successfully been sent." );
            }
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

//http://www.websitecodetutorials.com/code/jquery-plugins/jquery-validation.php
//http://www.jqueryscript.net/form/Powerful-jQuery-Form-Validation-Plugin-Validation-Engine.html
//https://github.com/posabsolute/jQuery-Validation-Engine
//http://www.jsdelivr.com/projects/jquery.validationengine
