$(document).ready(function(){
	$.ajax({
		type: "GET",
		url: "../resources/site_guides/" + name + ".json",
		dataType: "json",
		success: function (data, status) {
			var output = "<ol>";
			$.each(data.steps, function (i, item) {
				output += "<li>";
				output += item;
				output += "<br><img src=\"../resources/site_photos/" + name + "_" + i + ".jpg\">";
				output += "</li>";
			});
			output += "<li>";
			output += data.final_step;
			output += "<br><img src=\"../resources/site_photos/" + name + "_fin" + ".jpg\">";
			output += "</li></ol>";
			$("#content").html(output);
		}, error: function (msg) {
			alert("Something went wrong!\nError Message:\n\"" + msg + "\"");
		}
	});
});