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
		<label><strong>Recipient's Name:</strong><?php echo $_COOKIE['Recipients_Name']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Account Number:</strong><?php echo $_COOKIE['Account_Number']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Recipient's Adress:</strong><?php echo $_COOKIE['Recipients_Adress']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>On:</strong><?php echo $_COOKIE['Destination']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Title:</strong><?php echo $_COOKIE['Title']; ?></label>
	</div>
	<div class="input-group">
	<label><strong>Type of transfer:</strong><?php echo $_COOKIE['Type_Of_Transfer']; ?></label>
	</div>
	<div class="input-group">
		<label><strong>Amount:</strong><?php echo $_COOKIE['Amount']; ?></label>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="confirm" id="confirmbutton">Confirm Data</button>
			<button type="submit" class="btn" name="reject" id="rejectbutton">Back to Edit</button>
	</div>
	</form>
</body>
</html>
