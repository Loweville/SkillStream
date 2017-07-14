<?php 
	if (isset($_POST["RegEmail"])&&isset($_POST["RegFName"])&&isset($_POST["RegPass"])&&isset($_POST["RegConfPass"])&&isset($_POST["RegSurname"])) {
		$Email = preg_replace("#[^A-Za-z0-9]#", "", $_POST["RegEmail"]);
		$Password = preg_replace("#[^A-Za-z0-9]#", "", $_POST["RegPass"]);
		$First = preg_replace("#[^A-Za-z0-9]#", "", $_POST["RegFName"]);
		$Last = preg_replace("#[^A-Za-z0-9]#", "", $_POST["RegSurname"]);
		$Confirm = preg_replace("#[^A-Za-z0-9]#", "", $_POST["RegConfPass"]);
		Include "Scripts/connect_to_mysql.php";
		$sql = mysql_query("SELECT id FROM Users WHERE Email = '$Email' AND Pass = '$Password' LIMIT 1");
		$existCount = mysql_num_rows($sql);
		if ($existCount ==1){
			echo "<div id='FailedReg'><h4>Registration</h4>Your details have matched to an active account, please change Details.<a id='CloseOver' onclick=HideElem('FailedReg');></a></div>";
		} else{
			if (isset($Password == $Confirm)){
				$sql = "INSERT INTO `jensenlowe_co_uk_Job_Inventors`.`Users` ( `Email`, `First`, `Surname`, `Pass`, `Last_Logged`) VALUES ('$Email', '$First', '$Last', MD5(\'$Password\'), CURDATE());";
				$result=mysql_query($sql)
				echo "success!"
				header("location: index.php");
			} else
				echo "<div id='FailedReg'><h4>Registration</h4>Your Passwords are different, to ensure account security, please input the same password into both <strong>Password</strong> and <strong>Confirm Password</strong>.<a id='CloseOver' onclick=HideElem('FailedReg');></a></div>";
		}
	}
?>