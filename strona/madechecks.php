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

	<form action="madechecks.php"	method="post">

	<?php if(strcmp($_COOKIE['ok'],"1") == 0){ ?>
	<?php include('errors.php'); ?>
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
		<label>Done: <?php echo $_COOKIE['Status']; ?></label>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="next">Get Next</button>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="previous">Get Previous</button>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="getback">Back</button>
	</div>
<?php }else{?>

	<div class="input-group">
		<label><strong>Error:</strong> <?php echo $_COOKIE['Error']; ?></label>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="next">Get Next</button>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="previous">Get Previous</button>
	</div>
	<div class="input-group">
			<button type="submit" class="btn" name="getback">Back</button>
	</div>
<?php }?>
	</form>
</body>
</html>
