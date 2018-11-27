


$(document).ready(function () {

   $("#tab_title").text($("title").text());

   $.get("/techdumphelper/templates/tab_bar.txt", function(data) {
      $("#tab_bar").append(data);
   });

   $.ajax({
      type: "GET",
      url: "/techdumphelper/resources/site_data.json",
      dataType: "json",
      success: function (data, status) {
         var navbar = $(".navbar");
         $.each(data.sites, function (i, item) {
            var output = "<a href=\"";
            output += item.url + "\">";
            output += item.name + "</a>";
            navbar.append(output);
         });
      }, error: function (msg) {
         alert("Something went wrong!\nError Message:\n\"" + msg + "\"");
      }
   });

});

function loadGuide() {
   var rem = $(".highlight");
   if (typeof rem !== "undefined") {
      rem.removeClass("highlight");
   }
   $("#guide_button").addClass("highlight");
   var name = $("title").text();
   $.ajax({
      type: "GET",
      url: "/techdumphelper/resources/site_guides/" + name + ".json",
      dataType: "json",
      success: function (data, status) {
         var output = "<ol>";
         $.each(data.steps, function (i, item) {
            output += "<li>";
            output += item;
            output += "<br><img src=\"/techdumphelper/resources/site_photos/" + name + "_" + i + ".jpg\">";
            output += "</li>";
         });
         output += "<li>";
         output += data.final_step;
         output += "<br><img src=\"/techdumphelper/resources/site_photos/" + name + "_fin" + ".jpg\">";
         output += "</li></ol>";
         $("#tab_content").html(output);
      }, error: function (msg) {
         alert("Something went wrong!\nError Message:\n\"" + msg + "\"");
      }
   });
}

function loadInventory() {
   var rem = $(".highlight")
   if (typeof rem !== "undefined") {
      rem.removeClass("highlight");
   }
   $("#inventory_button").addClass("highlight");
}

function loadTrends() {
   var rem = $(".highlight")
   if (typeof rem !== "undefined") {
      rem.removeClass("highlight");
   }
   $("#trends_button").addClass("highlight");
}