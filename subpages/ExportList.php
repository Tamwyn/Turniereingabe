<form id="export-form" action="libs/GenerateCSV.php" method="post" accept-charset="utf-8">
<input type="submit" name="export" id="export" value="Turnierliste herunterladen">

<!-- Die Bearbeitung dieses Formulars findet in libs/GenerateCSV.php statt -->

<script type="text/javascript">
	var frm = $('#export-form');
	//Fange den Submit des Formulars auf
	frm.submit(function(ev) {
		// Generiere die Ajax Verbindung zum Server
		$.ajax({
			type 		: 'POST', 
			url 		: 'libs/GenerateCSV.php', 
			data 		: 'export', //Die POST Variable
			success		: function (data) {
				alert('success'); // Es scheint funktioniert zu haben --> Leite zum Download weiter
			}
		});
		
		// Verhindere, dass die Seite neu laedt
		ev.preventDefault();
	});
</script>