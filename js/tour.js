var tour = new Tour({
    steps: [
    {
        element: "#main-nav",
        title: "Main Navbar",
        content: "Page Links to Home, Portfolio, and Contact Me.",
        placement: "bottom"
    },
    {
        element: "#tour-theme-menu",
        title: "Theme Menu",
        content: "On any page, hover over the icon here to dipslay the theme menu for the entire website.",
        placement: "right"
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
        content: "If you want to go thorugh the tour again, click me.",
        placement: "top"
    }],
    backdrop: true
});

$( "#start-tour" ).click( function()
{
    tour.restart();
});

tour.init();
tour.start();
