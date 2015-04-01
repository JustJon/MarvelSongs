<?php 
/**********************************************************************************

index.php
Index page for displaying search form and output
Copyright Jonathan Lazar 2015

**********************************************************************************/
?>
<?php require_once 'includes/header.php'; ?>
<html>
<head>
	<title>Marvel Music Player</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script> 

	<script> 
        // wait for the DOM to be loaded 
	$(document).ready(function() { 
    		// bind form using ajaxForm 
    		$('#myForm').ajaxForm({ 
        		// target identifies the element(s) to update with the server response 
        		target: '#player', 
 	
        		// success identifies the function to invoke when the server response 
        		// has been received; here we apply a fade-in effect to the new content 
        		success: function() { 
            		$('#player').fadeIn('slow'); 
	
        	} 
    		}); 
	});
    	</script> 
</head>
<body>
	<div id="searchbox">
		<form method="post" id="myForm" action="getmusic.php">
      		<div class="input">
        		<input type="text" class="button" id="name" name="name" placeholder="Enter A Marvel Character Here">
        		<input type="submit" class="button" id="submit" value="SEARCH">
      		</div>
    		</form>
	</div>
	<div id="player"></div>
</body>
</html>
