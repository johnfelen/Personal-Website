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

$( "#contact-me" ).submit( function( form )
{
    form.preventDefault();
    $.ajax({
        url: "./server_functionality/contact-functions.php",
        type: "POST",
        dataType: "json",
        data: { messageInfo : getMessageInfo() },
        success: function( databaseResponse )
        {
            if( typeof databaseResponse.error !== "undefined" )
            {
                $( "#name" ).val( databaseResponse.name );
                $( "#email" ).val( databaseResponse.email );
                $( "#message" ).val( databaseResponse.message );
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

$( "#contact-me" ).validator({
    feedbackIcons: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
    fields: {
    		name: {
    			validators: {
    				notEmpty: {
    					message: "You're required to fill in a first name!"
    						  }, // notEmpty
    				regexp: {
    					regexp: /^[A-Za-z\s.'-]+$/,
    					message: "Alphabetical characters, hyphens and spaces"
    				}
    						} // validators
    				  }
                  }
});
