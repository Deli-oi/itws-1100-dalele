// Quiz 2
// Put your javascript here in a document.ready function

alert("The page is about to load.");

// after loading
$(document).ready(function() {

    document.title = "ITWS 1100 - Quiz 2";

    $("[id='Go button']").on("click", function() {
        if (document.title === "ITWS 1100 - Quiz 2") {
            document.title = "Elijah Dalelio \u2013 Quiz 2";
        } else {
            document.title = "ITWS 1100 - Quiz 2";
        }
    });

    $(".last-name").on("mouseenter", function() {
        $(this).addClass("makeItPurple");
    }).on("mouseleave", function() {
        $(this).removeClass("makeItPurple");
    });

});
