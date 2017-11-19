<?php
	if(!isset($_SESSION)){
		session_start();
	}

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array();
	setcookie("success","",0,"/");

	if(!isset($_COOKIE['actualIndex'])) {
		setcookie("actualIndex","0",0,"/");
		$_COOKIE['actualIndex'] = "0";
	}
//	$_COOKIE['actualIndex'] = 0;

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'Bank_Validation');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO Users (User_name, User_email, User_password)
					  VALUES('$username', '$email', '$password')";
			$isgood = mysqli_query($db, $query);
			if($isgood == TRUE){
				$_SESSION['username'] = $username;
				setcookie("success","You are now logged in",0,"/");
				header('location: index.php');
			}else{
				setcookie("success","Something went wrong",0,"/");

				header('location: index.php?logout=1');
			}
		}

	}

	// ...

	/*
	*----------------------------------------------------
	*	ENTERY FOR LOGIN USER - CONNECTION TO DATABASE MYSQL
	*----------------------------------------------------
	*/
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM Users WHERE User_name='$username' AND User_password='$password'";
			$results = mysqli_query($db, $query);



			if (mysqli_num_rows($results) == 1) {

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";

				$idquery = "SELECT User_id FROM Users WHERE User_name='$username' AND User_password='$password'";
				$result2 = mysqli_query($db, $idquery);

				$result3 = $result2 -> fetch_assoc();

				$userId = $result3['User_id'];
				setcookie("id",(string)$userId,0,"/");

				$indexUser = $_COOKIE['id'];
				$getNextDataquery = "SELECT MAX(User_Num_Check) AS num FROM Przelewy WHERE id = '$userId'";
				
				$wentgood = mysqli_query($db, $getNextDataquery);
				if (mysqli_num_rows($wentgood) == 1) {
					$result3 = $wentgood -> fetch_assoc();
					$maxIndex = intval($result3['num']);
					if($maxIndex == 0){
						$beforeIndex = 0;
						setcookie("maxIndex",(string)$beforeIndex,0,"/");
						setcookie("beforeIndex",(string)$beforeIndex,0,"/");
					}else{
						$maxIndex = $maxIndex+1;
						$beforeIndex = $maxIndex-1;
						setcookie("maxIndex",(string)$maxIndex,0,"/");
						setcookie("beforeIndex",(string)$beforeIndex,0,"/");
					}
				}else{
					setcookie("maxIndex","0",0,"/");
				}

				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	/*
	*----------------------------------------------------
	*LOG OUT THE USER
	*----------------------------------------------------
	*/
	if(isset($_POST['log_out'])) {
		header("location: index.php?logout='1'");
	}

	/*
	*----------------------------------------------------
	*		CHECK OUT IF DATA INPUT IN FIELDS IS VALID
	*----------------------------------------------------
	*/
	if(isset($_POST['transfer'])) {
		$id = intval($_COOKIE['id']);
		header('location: formularz.php');
	}
	if(isset($_POST['send'])) {
		$id = intval($_COOKIE['id']);
		setcookie("Destination",$_POST['Destination'],0,"/");
		setcookie("Recipients_Name",$_POST['Recipients_Name'],0,"/");
		setcookie("Account_Number",$_POST['Account_Number'],0,"/");
		setcookie("Recipients_Adress",$_POST['Recipients_Adress'],0,"/");
		setcookie("Title",$_POST['Title'],0,"/");
		setcookie("Type_Of_Transfer",$_POST['Type_Of_Transfer'],0,"/");
		setcookie("Amount",$_POST['Amount'],0,"/");
		$accountnumber =$_POST['Account_Number'];
		header('location: confirm.php');
	}

	/*
	*----------------------------------------------------
	*					CONFIRMATION OF VALID DATA ENTRY
	*----------------------------------------------------
	*/
	if(isset($_POST['confirm'])) {
		$id = intval($_COOKIE['id']);
		$destination = mysqli_real_escape_string($db, $_COOKIE['Destination']);
		$Recipients_Name = mysqli_real_escape_string($db, $_COOKIE['Recipients_Name']);
		$Account_Number = $_COOKIE['Account_Number'];
		$Recipients_Adress = mysqli_real_escape_string($db, $_COOKIE['Recipients_Adress']);
		$Title = mysqli_real_escape_string($db, $_COOKIE['Title']);
		$Type_Of_Transfer = mysqli_real_escape_string($db, $_COOKIE['Type_Of_Transfer']);
		$Amount = $_COOKIE['Amount'];

		$query = "INSERT INTO Przelewy (id, Destination, Recipients_Name,Account_Number,Recipients_Adress,Title,Type_Of_Transfer,Amount)
					VALUES('$id','$destination','$Recipients_Name','$Account_Number','$Recipients_Adress','$Title','$Type_Of_Transfer','$Amount')";
		$wentgood = mysqli_query($db, $query);
		unsetSendData();
		if($wentgood == TRUE){
			setcookie("success","Transfer made succesfully",0,"/");
		}else{
			setcookie("success","Transfer made unsuccesfully",0,"/");
		}

		//maxIndex($db);
		//setIndex($db);
		$valuebefore = (int)$_COOKIE['maxIndex'];
		setcookie("beforeIndex",(string)$valuebefore,0,"/");
		$valuebefore = $valuebefore + 1;
		setcookie("maxIndex",(string)$valuebefore,0,"/");
		setcookie("nextIndex",(string)$valuebefore,0,"/");

		$indexUser = (int)$_COOKIE['id'];
		$maxID = (int)$_COOKIE['maxIndex'];
		$maxafterinsert = $valuebefore - 1;
		$query = "SELECT Destination,Recipients_Name,Account_Number,Recipients_Adress,Title,Type_Of_Transfer,Amount FROM Przelewy WHERE id = '$indexUser' AND User_Num_Check = '$maxafterinsert'";

		$dataquery = mysqli_query($db, $query);
		if(mysqli_num_rows($dataquery)>0){
			$serverdata = mysqli_fetch_assoc($dataquery);
	  		setcookie("Destination",(string)$serverdata['Destination'],0,"/");
			setcookie("Recipients_Name",(string)$serverdata['Recipients_Name'],0,"/");
			setcookie("Account_Number",(string)$serverdata['Account_Number'],0,"/");
			setcookie("Recipients_Adress",(string)$serverdata['Recipients_Adress'],0,"/");
			setcookie("Title",(string)$serverdata['Title'],0,"/");
			setcookie("Type_Of_Transfer",(string)$serverdata['Type_Of_Transfer'],0,"/");
			setcookie("Amount",(string)$serverdata['Amount'],0,"/");
			header('location: dokonany.php');
		}else{
			header('location: index.php');
			
		}
	}
	/*
	*----------------------------------------------------
	*					REJECTING DATA VALIDATION
	*----------------------------------------------------
	*/
	if(isset($_POST['reject'])) {
			unsetSendData();
			header('location: index.php');
	}
	/*
	*----------------------------------------------------
	*					GETTING NEXT TRANSFER
	*----------------------------------------------------
	*/
	if(isset($_POST['next'])) {
		$indexUser = intval($_COOKIE['id']);
		$actInd = intval($_COOKIE['actualIndex']);
		if((strcmp($_COOKIE['ok'],"1") == 0)){
			$actInd = $actInd + 1;
		}
		$getNextDataquery = "SELECT * FROM Przelewy WHERE id = $indexUser AND User_Num_Check = $actInd";
		setcookie("actualIndex",(string)$actInd,0,"/");

		$result = mysqli_query($db, $getNextDataquery);

		if(mysqli_num_rows($result)>0){
			$resultdata = mysqli_fetch_assoc($result);
			setcookie("ok","1",0,"/");
			setcookie("Destination",$resultdata['Destination'],0,"/");
			setcookie("Recipients_Name",$resultdata['Recipients_Name'],0,"/");
			setcookie("Account_Number",$resultdata['Account_Number'],0,"/");
			setcookie("Recipients_Adress",$resultdata['Recipients_Adress'],0,"/");
			setcookie("Title",$resultdata['Title'],0,"/");
			setcookie("Type_Of_Transfer",$resultdata['Type_Of_Transfer'],0,"/");
			setcookie("Amount",$resultdata['Amount'],0,"/");
			setcookie("Error","",0,"/");
		}else{
			setcookie("ok","0",0,"/");
			$actInd = $actInd - 1;
			setcookie("actualIndex",(string)$actInd,0,"/");
			setcookie("Error","No more transfers detected!",0,"/");
		}
		header('location: madechecks.php');
	}
	/*
	*----------------------------------------------------
	*							GETING PREVIOUS TRANSFER
	*----------------------------------------------------
	*/
	if(isset($_POST['previous'])) {
		$indexUser = intval($_COOKIE['id']);
		$actInd = intval($_COOKIE['actualIndex']);
		if((strcmp($_COOKIE['ok'],"1") == 0)){
			$actInd = $actInd - 1;
		}
		$getNextDataquery = "SELECT * FROM Przelewy WHERE id = '$indexUser' AND User_Num_Check = '$actInd'";
		setcookie("actualIndex",(string)$actInd,0,"/");
		$result = mysqli_query($db, $getNextDataquery);

		if(mysqli_num_rows($result)>0){
			$resultdata = mysqli_fetch_assoc($result);
			setcookie("ok","1",0,"/");
			setcookie("Destination",$resultdata['Destination'],0,"/");
			setcookie("Recipients_Name",$resultdata['Recipients_Name'],0,"/");
			setcookie("Account_Number",$resultdata['Account_Number'],0,"/");
			setcookie("Recipients_Adress",$resultdata['Recipients_Adress'],0,"/");
			setcookie("Title",$resultdata['Title'],0,"/");
			setcookie("Type_Of_Transfer",$resultdata['Type_Of_Transfer'],0,"/");
			setcookie("Amount",$resultdata['Amount'],0,"/");
			setcookie("Error","",0,"/");
		}else{
			setcookie("ok","0",0,"/");
			$actInd = $actInd + 1;
			setcookie("actualIndex",(string)$actInd,0,"/");
			setcookie("Error","No more transfers detected!",0,"/");
		}

		header('location: madechecks.php');

	}
	/*
	*----------------------------------------------------
	*							GET BACK TO MAIN MENU
	*----------------------------------------------------
	*/
	if(isset($_POST['getback'])) {
			unsetSendData();
			header('location: index.php');
	}

	/*
	*----------------------------------------------------
	*						CHECK HISTORY OF MADE TRANSFERS
	*----------------------------------------------------
	*/
	if(isset($_POST['checkLogHistory'])) {
		unsetSendData();
		$indexUser = intval($_COOKIE['id']);
		//echo $indexUser;
		setcookie("actualIndex","0",0,"/");
		$actInd = intval($_COOKIE['actualIndex']);

		$getNextDataquery = "SELECT * FROM Przelewy WHERE id = '$indexUser' AND User_Num_Check = '$actInd'";

		$result = mysqli_query($db, $getNextDataquery);

		if(mysqli_num_rows($result)>0){
			$resultdata = mysqli_fetch_assoc($result);
			setcookie("ok","1",0,"/");
			setcookie("Destination",$resultdata['Destination'],0,"/");
			setcookie("Recipients_Name",$resultdata['Recipients_Name'],0,"/");
			setcookie("Account_Number",$resultdata['Account_Number'],0,"/");
			setcookie("Recipients_Adress",$resultdata['Recipients_Adress'],0,"/");
			setcookie("Title",$resultdata['Title'],0,"/");
			setcookie("Type_Of_Transfer",$resultdata['Type_Of_Transfer'],0,"/");
			setcookie("Amount",$resultdata['Amount'],0,"/");
			setcookie("Error","",time());
		}else{
			setcookie("ok","0",0,"/");
			if(strcmp($_COOKIE['actualIndex'], "0") == 0){
				setcookie("Error","You didint make any transfer!",0,"/");
			}else{
				setcookie("Error","No more transfers detected!",0,"/");
			}
		}

		header('location: madechecks.php');

	}


	/*
	*----------------------------------------------------
	*						CLEARING SECTION DATA
	*----------------------------------------------------
	*/
	if(isset($_POST['okej'])) {
			unsetSendData();
			header('location: index.php');
	}

	function unsetSendData(){
		setcookie("Destination","",time());
		setcookie("Account_Number","",time());
		setcookie("Recipients_Adress","",time());
		setcookie("Title","",time());
		setcookie("Type_Of_Transfer","",time());
		setcookie("Amount","",time());
		setcookie("Error","",time());
		setcookie("ok","0",0,"/");
	}
	function processData(){

	}
	/*
	*----------------------------------------------------
	*					FORMAT ACCOUNT NUMBER
	*----------------------------------------------------
	*/
	function formatAccountNumber($accountNumber){
		$parts = array(0=>2,2=>4,6=>4,10=>4,14=>4,18=>4,22=>4);
		foreach($parts as $key => $val){
			$newNumber .= substr($accountNumber, $key, $val).' ';
		}
		return trim($newNumber);
	}

	function setIndex($db){
		$indexUser = $_COOKIE['id'];
		$getNextDataquery = "SELECT MAX(User_Num_Check) AS num FROM Przelewy WHERE id = '$indexUser'";
		$wentgood = mysqli_query($db, $getNextDataquery);
		if (mysqli_num_rows($wentgood) == 1) {
			$result3 = $wentgood -> fetch_assoc();
			$nextIndex = (int)$result3['num'] + 1;
			setcookie("nextIndex",(string)$nextIndex,0,"/");
		}else{
			setcookie("nextIndex","0",0,"/");
		}
	}

	function maxIndex($db){
		$indexUser = $_COOKIE['id'];
		$getNextDataquery = "SELECT MAX(User_Num_Check) AS num FROM Przelewy WHERE id = '$indexUser'";
		$wentgood = mysqli_query($db, $getNextDataquery);
		if (mysqli_num_rows($wentgood) == 1) {
			$result3 = $wentgood -> fetch_assoc();
			$nextIndex = (int)$result3['num'];
			setcookie("maxIndex",(string)$nextIndex,0,"/");
		}else{
			setcookie("maxIndex","0",0,"/");
		}
	}

?>
