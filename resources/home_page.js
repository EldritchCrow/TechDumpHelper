

$(document).ready(function () {

   $.get("./templates/header.txt", function(data) {
      $("#header").append(data);
   });

   $.ajax({
      type: "GET",
      url: "./resources/site_data.json",
      dataType: "json",
      success: function (data, status) {
         var output = "<tr>";
         $.each(data.sites, function (i, item) {
            output += "<td><a href=\"" + item.url + "\">";
            output += "<h4>" + item.name + "</h4>";
            output += "<br>";
            output += "<img src=\"" + item.picture + "\"/>";
            output += "</a></td>";
            if(i % 3 == 2) {
               output += "</tr><tr>";
            }
         });
         output += "</tr>";
         $("#sites").append(output);
      }, error: function (xhr, status, msg) {
         alert("Something went wrong!\nStatus: " + status + "\nError Message: \"" + msg + "\"");
      }
   });
});