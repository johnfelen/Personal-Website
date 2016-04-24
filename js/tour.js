var tour = new Tour({
    steps: [
    {
        element: "#home",
        title: "Home Page",
        content: "Content of my step",
        placement: "bottom"
    },
    {
        element: "#portfolio",
        title: "Portfolio Page",
        content: "Content of my step",
        placement: "bottom"
    },
    {
        element: "#contact",
        title: "Contact Page",
        content: "Content of my step",
        placement: "bottom"
    },
    {
        element: "#tour-theme-menu",
        title: "Theme Menu",
        content: "Content of my step",
        placement: "right",
        // onShow: function( tour )
        // {
        //     console.log( 'askdjfjasldkfjlaksd' );
        // }
    },
    {
        element: "#footer-links",
        title: "Footer Links",
        content: "Content of my step",
        placement: "top",
    }],
    backdrop: true,
    template: "<div class=\"popover tour\">" +
    "<div class=\"arrow\"></div>" +
    "<h3 class=\"popover-title\"></h3>" +
    "<div class=\"popover-content\"></div>" +
    "<div class=\"popover-navigation\">" +
        "<button class=\"btn btn-default\" data-role=\"prev\">« Prev</button>" +
        "<span data-role=\"separator\">|</span>" +
        "<button class=\"btn btn-default\" data-role=\"next\">Next »</button>" +
    "</div>" +
    "<button class=\"btn btn-default\" data-role=\"end\">End tour</button>" +
    "</nav>" +
  "</div>"
});

tour.init( true );
tour.start( true );
