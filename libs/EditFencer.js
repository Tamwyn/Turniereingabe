$(document).ready(function() {

	// process the form
	$('edit-choose').submit(function(event) {

		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var fencerID = document.getElementByID("idLabel").name;
		console.log(fencerID); 
		// process the form
		$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url         : 'libs/GetFencerData.php', // the url where we want to POST
			data        : fencerID, // The fencerID
			dataType    : 'json', // what type of data do we expect back from the server
			encode      : true
		})
			// using the done promise callback
			.done(function(data) {

				// log data to the console so we can see
				console.log(data);

	if ( ! data.success) {
			
			// handle errors for name
		if (data.errors) {
		
		} 
	}

	else {
		//Importiere ein modifiziertes "AddFencer" Formular mit den Werten
		

		
		}

	});

		//Stop any default reactions	
		event.preventDefault();
	});

});