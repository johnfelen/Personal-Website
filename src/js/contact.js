if( isFileInURL( "contact" ) )
{
    displayContact();
}

function displayContact()
{
    //this ajax call will get the summary of my profile from LinkedIn, must use jsonp because it is cross domain
    $.ajax({
        url: "https://api.linkedin.com//v1/people/~:(summary)",
        type: "GET",
        dataType: "jsonp",
        data: { "oauth2_access_token" : "AQXo0vRiE2VcPnruyXY_H2GzGvuoLhwTqwxuUjqvUXnebpNIS7FyrMgIrFd5kGfQfST-fMBeEM39_3AT7oebkMLk3xStUjg7p0gmA6-RrIcvPZejRsqA9RqJDwnDK7lCguw4s6aiMENI2Sbr0illan-H7y1w0sHyfvUUIic1u1X07YW8_DM", "format" : "jsonp" },
        success: function( linkedInSummary )
        {
            var summary = linkedInSummary.summary;
            summary = summary.split( ".  " ).join( ".  &nbsp;" );   //this just formats so that double spacing between sentences appears, it is based on https://gist.github.com/CrowderSoup/9095873
            $( "#summary" ).html( summary );
        }
    });

    $( "textarea" ).keyup( function()   //this method listens to keyups and wil keep the submit message button disabled until there are no errors and all textareas are completed, based on http://stackoverflow.com/questions/5614399/disabling-submit-button-until-all-fields-have-values
    {
        setTimeout( function()  //this timeout of 1ms is because if there is no timeout, when there is an error, it will come up as undefined and then it will be print out "alert" on the next keyup
        {
            var empty = false;
            $( "textarea" ).each( function()
            {
                if( $( this ).val() === "" || $( "#contact-me" ).find( "ul" ).attr( "role" ) === "alert" )  //the right is what is what checks for errors, ul with "alert" roles are put into the .help-block divs
                {
                    empty = true;
                }
            });

            if( empty )
            {
                $( "#submit-message" ).attr( "disabled", "disabled" );
            }

            else
            {
                $( "#submit-message" ).removeAttr( "disabled" );
            }
        }, 1 );
    });

    $( "textarea" ).not( "[type=submit]" ).jqBootstrapValidation({  //add the jqBootstrap functionality to the form and submitSuccess enters the information into the database
        preventSubmit: true,
        submitSuccess: function( $form, event )
        {
            $.ajax({
                url: "./server_functionality/contact-functions.php",
                type: "POST",
                dataType: "text",
                data: { name : $( "#name" ).val(), email : $( "#email" ).val(), message : $( "#message" ).val() },
                success: function( databaseResponse )
                {
                    if( databaseResponse === "Success" )
                    {
                        $( "#name" ).val( "" );
                        $( "#email" ).val( "" );
                        $( "#message" ).val( "" );
                        $( "#after-submit" ).html( "Your message has successfully been sent!" );
                        $( "#submit-message" ).attr( "disabled", "disabled" );
                    }

                    else
                    {
                        $( "#after-submit" ).html( "Error with query!" );
                    }
                }
            });

            event.preventDefault();
        },
        filter: function()
        {
            return $( this ).is( ":visible" );
        }
    });
}
