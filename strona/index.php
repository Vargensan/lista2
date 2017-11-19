<?php
	include('server.php');
	if(!isset($_SESSION)){
		session_start();
	}

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Fakebank</title>
	<link type="text/css" rel="stylesheet" href="style.css?<?php echo time(); ?>" />
</head>
<body>
	<div class="header">
		<h2>Fejkbank - Just for You</h2>
	</div>

	<?php if (isset($_SESSION['success'])) : ?>
	<div class="content">
		<!-- notification message -->
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
	</div>
	<?php endif?>
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<form method="post" action="index.php">
						<div class = "input-group" id="allignToCenter">
							<label id="allignToCenter">Welcome <strong><?php echo $_SESSION['username']; ?></strong></label>
						</div>
						<div class = "input-group" id="allignToCenter">
							<label id="allignToCenter">Choose an action: </strong></label>
						</div>


					<div class="input-group">
							<button type="submit" class="btn" id="allignToCenter" name="checkLogHistory">Check Transfers</button>
					</div>

					<div class = "input-group">
						<button type="submit" class="btn" id="allignToCenter" name="transfer">Make a Transfer</button>
					</div>
					<div class = "input-group" id="allignToCenter">
						<button type="submit" class="btn" id="allignToCenter" name="log_out">Logout</button>
					</div>

				</form>

		<!--	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p> -->

		<?php endif ?>
	</div>

</body>
</html>
