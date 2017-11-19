<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Fakebank</title>
	<link type="text/css" rel="stylesheet" href="style.css?<?php echo time(); ?>" />
</head>
<body>
	<div class="header">
		<h2>Fejkbank - History of Fake Transfers</h2>
	</div>

	<form action="madechecks.php" method="post">
	<div class = "input-group">
		<label>Recipient's Name: <?php echo $_COOKIE['Recipients_Name']; ?></label>
	</div>
	<div class="input-group">
		<label id="editthis">Account Number: <?php echo $_COOKIE['Account_Number']; ?></label>
	</div>
	<div class="input-group">
		<label>Recipient's Adress: <?php echo $_COOKIE['Recipients_Adress']; ?></label>
	</div>
	<div class="input-group">
		<label>On: <?php echo $_COOKIE['Destination']; ?></label>
	</div>
	<div class="input-group">
		<label>Title: <?php echo $_COOKIE['Title']; ?></label>
	</div>
	<div class="input-group">
	<label>Type of transfer: <?php echo $_COOKIE['Type_Of_Transfer']; ?></label>
	</div>
	<div class="input-group">
		<label>Amount: <?php echo $_COOKIE['Amount']; ?></label>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="okej">Ok</button>
	</div>

	</form>

	<script type="text/javascript">
/*
		function myFunction(){
				var unique = getUniqueId();
				var fakenumber = localStorage.getItem(unique);
				if(fakenumber !== null){
					//createCookie("Account_Number",fakenumber,0,"/");
					setnewValue(fakenumber);
				}
		}

		function setnewValue(fakenumber){
				var result = "Account Number: ";
				result = result.concat(fakenumber);
				result = result.split('+').join(' ');
				document.getElementById("editthis").textContent = result;
				document.getElementById("editthis").contentWindow.location.reload();
		}

		function getUniqueId(){
				var userId = getCookie("id");
				var val = getCookie("beforeIndex");
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
	}
	window.onload = myFunction; */
	</script>

</body>
</html>
