/* Lab 8 JavaScript File
   reads projects.json and builds the projects page */

// wait for DOM to load before running
$(document).ready(function () {

   // use fetch to grab the json file
   fetch("projects.json")
      .then(function (response) {
         return response.json();
      })
      .then(function (data) {
         var projects = data.projects;

         // loop through each project and make a card for it
         for (var i = 0; i < projects.length; i++) {
            var project = projects[i];

            // build the card elements
            var card = $("<a>").addClass("project-card-link").attr("href", project.link);
            var thumb = $("<div>").addClass("project-thumb " + project.thumb);
            var body = $("<div>").addClass("project-body");
            var title = $("<h3>").text(project.title);
            var desc = $("<p>").text(project.description);

            // put it all together
            body.append(title);
            body.append(desc);
            card.append(thumb);
            card.append(body);

            // hide it first so fadeIn works
            card.hide();
            $("#projects-grid").append(card);
         }

         // fade in the cards after they are added
         $("#projects-grid .project-card-link").fadeIn(600);

         // jQueryUI accordion for the info section
         $("#info-accordion").accordion({
            collapsible: true,
            active: false
         });
      })
      .catch(function (error) {
         // show error if the json didnt load
         console.log("error loading json: " + error);
         $("#projects-grid").html("<p>Could not load projects.</p>");
      });

});
