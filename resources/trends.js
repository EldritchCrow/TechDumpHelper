
$(document).ready(function () {
   getTrends(30, "#30days");
   getTrends(90, "#90days");
   getTrends(365000, "#allTime");
});

function getTrends(days_diff, identifier) {
   var responseData;
   $.ajax({
      type: 'GET',
      url: '../inventory/get_trends.php',
      data: {
         'td': name,
         'days_diff': days_diff
      },
      dataType: 'json',
      success: function (response) {
         var output = "";
         $.each(response, function(i, item) {
            if(i == 3) {
               return;
            }
            output += "<tr><td>" + item.Name + "</td><td>" + item.quantity + "</td></tr>";
         });
         $(identifier).append(output);
      }, error: function (xhr, status, msg) {
         alert('Error: Failed to load trends data.\nStatus: ' + status + '\nError Message: ' + msg);
         console.error('Failed to load trends data.\nStatus: ' + status + '\nError Message: ' + msg);
         console.error(status + ': ' + msg);
      }
   });
   return responseData;
}