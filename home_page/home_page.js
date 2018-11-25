

$(document).ready(function () {

   $.get("../templates/header.txt", function(data) {
      $("#header").append(data);
   });

   $.ajax({
      type: "GET",
      url: "./site_data.json",
      dataType: "json",
      success: function (data, status) {
         var output = "<tr>";
         $.each(data.sites, function (i, item) {
            output += "<td><a href=\"" + item.url + "\">";
            output += "<h4>Name:</h4> " + item.name;
            output += "<br>";
            output += "<h5>Rating:</h5> " + item.rating;
            output += "<br>";
            output += "<img src=\"" + item.picture + "\"/>";
            output += "</a></td>";
            if(i % 3 == 2) {
               output += "</tr><tr>";
            }
         });
         output += "</tr>";
         $("#sites").append(output);
      }, error: function (msg) {
         alert("Something went wrong!\nError Message:\n\"" + msg + "\"");
      }
   });
});