$(document).ready(function() {
	console.log("Here I am");

	// process the form
	$("#edit-choose").submit(function(event) {
		console.log("Submit");
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var fencerID = document.getElementById("idOption").name;
		console.log(fencerID);
		console.log("Test").delay(1000); 
		// process the form
		$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url         : 'libs/GetFencerData.php', // the url where we want to POST
			data        : fencerID, // The fencerID
			dataType    : 'json', // what type of data do we expect back from the server
			encode      : true,
			success		: function(data) {
               alert(data); // show response from the php script.
            }
		});
		//Stop any default reactions	
		event.preventDefault();
	});

});
