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

    $( "textarea" ).not( "[type=submit]" ).jqBootstrapValidation({  //add the jqBootstrap functionality to the form
        preventSubmit: true,
        submitSuccess: function( $form, event )
        {
            $( "#name" ).val( "" );
            $( "#email" ).val( "" );
            $( "#message" ).val( "Your message has successfully been sent!" );
            event.preventDefault();
        },
        filter: function()
        {
            return $( this ).is( ":visible" );
        }
    });
}
