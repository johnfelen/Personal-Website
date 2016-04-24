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
    //template based on http://knackforge.com/blog/sivaji/how-change-twitter-bootstraps-tour-template
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
    backdrop: true
});

$( "#start-tour" ).click( function()
{
    tour.restart();
});

tour.init();
tour.start();
