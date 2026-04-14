// Lab 8 - JSON & AJAX
// Fetches projects.json and dynamically builds the project cards using jQuery

$(document).ready(function () {

  // Fetch the JSON file using the fetch() API
  fetch("projects.json")
    .then(function (response) {
      // Check that the response was successful
      if (!response.ok) {
        throw new Error("Network response was not ok: " + response.status);
      }
      return response.json();
    })
    .then(function (data) {
      // Build a card for each project in the JSON array
      var projects = data.projects;
      var $grid = $("#projects-grid");

      projects.forEach(function (project) {
        // Create the anchor card element
        var $card = $("<a>")
          .addClass("project-card-link")
          .attr("href", project.link);

        // Thumbnail div
        var $thumb = $("<div>")
          .addClass("project-thumb " + project.thumb)
          .attr("aria-label", project.title + " preview");

        // Body div with title and description
        var $body = $("<div>").addClass("project-body");
        var $title = $("<h3>").text(project.title);
        var $desc = $("<p>").text(project.description);

        // Assemble the card
        $body.append($title).append($desc);
        $card.append($thumb).append($body);

        // Add hidden initially so we can fadeIn each card
        $card.hide();
        $grid.append($card);
      });

      // Fade in all cards sequentially for a nice entrance effect
      $("#projects-grid .project-card-link").each(function (i) {
        $(this).delay(i * 120).fadeIn(400);
      });

      // Add jQueryUI tooltip on each card showing the project title on hover
      $("#projects-grid .project-card-link").tooltip({
        items: "[href]",
        content: function () {
          return $(this).find("h3").text();
        },
        position: { my: "left top", at: "left bottom+6" }
      });
    })
    .catch(function (error) {
      // If the fetch fails, show an error message in the grid container
      console.error("Failed to load projects.json:", error);
      $("#projects-grid").html(
        "<p style='color:#e57373;'>Could not load projects. Please try again later.</p>"
      );
    });

  // jQueryUI accordion for a "About This Page" info panel
  $("#info-accordion").accordion({
    collapsible: true,
    active: false,
    animate: 300,
    heightStyle: "content"
  });

});
