<?php
  /*
    Author: Akassh Shah
  */
	require("account.php");

	function errorReporting(){
		error_reporting(E_ALL);
		ini_set('display_errors' , 1);
		return;
	}

	function connectDB(&$db, &$flag_c){
		global $hostname, $username, $password, $project;
		$db=mysqli_connect($hostname, $username, $password, $project);
		if (mysqli_connect_errno()){
			$flag_c=TRUE;
		}
		return;
	}

	function closeDB(&$db){
		mysqli_close($db);
		return;
	}

	function ucidPass(&$db,$ucid,$password){
		$queryStatement="select * from cs490alpha where ucid='$ucid' and password='$password'";
		($t=mysqli_query($db,$queryStatement)) or die(mysqli_error($db));
		if(mysqli_num_rows($t)==0){
			return(FALSE);
		}
		return(TRUE);
	}
?>
