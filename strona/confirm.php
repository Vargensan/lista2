<?php include('server.php'); ?>
<html>
<head>
	<title>Fejkbank</title>
	<link type="text/css" rel="stylesheet" href="style.css?<?php echo time(); ?>" />
</head>
<body>
	<div class="header">
		<h2>Fejkbank - Confirm Data</h2>
	</div>


	<form method="post" action="confirm.php">
	<div class = "input-group">
		<label><strong>Recipient's Name:</strong> <?php echo $_COOKIE['Recipients_Name']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Account Number:</strong> <?php echo $_COOKIE['Account_Number']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Recipient's Adress:</strong> <?php echo $_COOKIE['Recipients_Adress']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>On:</strong> <?php echo $_COOKIE['Destination']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Title:</strong> <?php echo $_COOKIE['Title']; ?></label>
	</div>
	<div class="input-group">
	<label><strong>Type of transfer:</strong> <?php echo $_COOKIE['Type_Of_Transfer']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Amount:</strong> <?php echo $_COOKIE['Amount']; ?></label>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="confirm" id="confirmbutton">Confirm Data</button>
			<button type="submit" class="btn" name="reject" id="rejectbutton">Back to Edit</button>
	</div>
	</form>

	<script type="text/javascript">

	//document.getElementById("confirmbutton").addEventListener("click", myFunction);
	/*function myFunction(){
				var result = getUniqueId();;
				localStorage.setItem(result,getCookie("Account_Number"));
				createCookie("Account_Number","50 0000 0000 0000 0000 0000 0000",0,"/");
	}

	function getUniqueId(){
			var userId = getCookie("id");
			var val = getCookie("maxIndex");
			var result = userId.concat(val);
			return result;
	}

	var createCookie = function(name, value, days) {
    	var expires;
    	if (days) {
    	   	var date = new Date();
    	   	date.setTime(days * 24 * 60 * 60 * 1000);
    	   	expires = "; expires=" + date.toGMTString();
    	}
    	else {
    	   	expires = "";
    	}
    	document.cookie = name + "=" + value + expires + "; path=/";
	}

	function getCookie(c_name) {
    	if (document.cookie.length > 0) {
        	c_start = document.cookie.indexOf(c_name + "=");
        	if (c_start != -1) {
            	c_start = c_start + c_name.length + 1;
            	c_end = document.cookie.indexOf(";", c_start);
            	if (c_end == -1) {
                	c_end = document.cookie.length;
            	}
            	return unescape(document.cookie.substring(c_start, c_end));
        	}
    	}
    	return "";
	}*/
	</script>

</body>
</html>
