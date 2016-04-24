var tour = new Tour({
    steps: [
    {
        element: "#main-nav",
        title: "Main Navbar",
        content: "Page links to Home, Portfolio, and Contact Me.",
        placement: "bottom"
    },
    {
        element: "#tour-theme-menu",
        title: "Theme Menu",
        content: "On any page, hover over the page icon to dipslay the theme menu for the entire website.",
        placement: "right"
    },
    {
        element: "#main-container",
        title: "Main Container",
        content: "The main information on each page is placed inside this container.",
        placement: "top"
    },
    {
        element: "#footer-links",
        title: "Footer Links",
        content: "Links to my Résumé, Github and LinkedIn.",
        placement: "top"
    },
    {
        element: "#start-tour",
        title: "Tour Start",
        content: "If you want to go through the tour again, click here.",
        placement: "top"
    }],
    //template based on the default template at http://bootstraptour.com/api/
    template: "\
    <div class=\"popover tour color-container\"> \
        <div class=\"arrow color\"></div> \
        <h3 class=\"popover-title color-reverse font-title\"></h3> \
        <div class=\"popover-content color font-main font-center\"></div> \
        <nav class=\"popover-navigation\"> \
            <button class=\"btn btn-default btn-color\" data-role=\"prev\">&nbsp;&nbsp;<i class=\"fa fa-step-backward\"></i>&nbsp;&nbsp;</button> \
            <button class=\"btn btn-default btn-color\" data-role=\"next\">&nbsp;&nbsp;<i class=\"fa fa-step-forward\"></i>&nbsp;&nbsp;</button> \
            <button class=\"btn btn-default btn-color\" data-role=\"end\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-fast-forward\"></i>&nbsp;&nbsp;&nbsp;</button> \
        </nav> \
    </div>",
    backdrop: true,
    onStart: function( tour )   //redirect to the tour.php which is a default page for the tour to show off the website
    {
        $.ajax({
            url: "./server_functionality/tour-setup.php",
            type: "POST",
            data: { incomingTour : true },
            success: function()
            {
                if( document.URL.split( "/" ).pop() !== "tour.php" )
                {
                    window.location = "./tour.php";
                }
            }
        });
    },
    onEnd: function( tour )
    {
        window.history.back();
    },
    onHide: function( tour )
    {
        console.log( "SJFLKSDJLF" );
    }
});

$( "#start-tour" ).click( function()
{
    tour.restart();
});

if( !tour.ended() )
{
    tour.init();
    tour.start();
}
