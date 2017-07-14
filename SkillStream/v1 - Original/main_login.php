<?php
Session_Start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS.css">
		
		<title>SkillStream Online</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<LINK REL="SHORTCUT ICON" HREF="http://skillstreamonline.jensenlowe.co.uk/Favicon.ico">
	</head>
	
	<body>
		<div id="wrapper">
			<nav>
				<a id="BtnNav" href="#"><h1><strong>Skill</strong>Stream Online</h1></a>
			</nav>
			
			<div id="Title">
				<h2 style="margin-right:10px; line-height:37px;">Login to SkillStream Online</h2>
			</div>
							
			<div id="Main" class="LogMain">
			
				<article id="Left">
					<h2>Members Login</h2>
					
					<form name="Log" id="Log" method="POST" action="">
						Email: <input name="LogEmail" type="email" class="Text" id="LogEmail" placeholder="Email">
						
						<br />
						
						Password: <input name="LogPass" type="password" class="Text" id="LogPass" placeholder="Password">
						
						<br />
						
						<input type="Submit" name="Login" id="Btn" Value="Login">
					</form>
				</article>
				
				<?php
					if (isset($_POST["LogEmail"])&&isset($_POST["LogPass"])){
						$Email = $_POST["LogEmail"];
						$Password = md5($_POST["LogPass"]);
						Include "Scripts/connect_to_mysql.php";
						$sql = mysql_query("INSERT INTO Users (date) VALUES (CURRENT_TIMESTAMP)");
						$sql = mysql_query("SELECT id FROM Users WHERE Email = '$Email' AND Pass = '$Password' LIMIT 1");
						$existCount = mysql_num_rows($sql);
						if ($existCount ==1){
							While($row = mysql_fetch_array($sql)){
							$id = $row["id"];
							}
							$_SESSION["LoggedID"] = $id;
							$_SESSION["LoggedEmail"] = $Email;
							$_SESSION["LoggedPass"] = $Password;
							header("location: index.php");
						}else{
							echo "<div id='FailedLog'><h4>Login</h4>Your Email or Password was incorrect, please check your details are correct.<a id='CloseOver' onclick=HideElem('FailedLog');></a></div>";
						}
					}
					
					if (isset($_POST["myemailreg"])&&isset($_POST["mypasswordreg"])&&isset($_POST["mypasswordConfreg"])){
						$Email = $_POST["myemailreg"];
						$Password = md5($_POST["mypasswordreg"]);
						$First = $_POST["myfirstnamereg"];
						$Last = $_POST["mysurnamereg"];
						$URL = $First"_"$Last".php";
						Include "Scripts/connect_to_mysql.php";
						$sql = mysql_query('INSERT into Users (AccURL, Email, First, Surname, Pass, Last_Logged) VALUES ("'.$URL.'", "'.$Email.'", "'.$First.'", "'.$Last.'", "'.$Password.'", CURRENT_TIMESTAMP)');
						echo "<div id='RegSuccess'><h4>Registration Succeeded</h4>You may now Login to your account<a id='CloseOver' onclick=HideElem('RegSuccess');></a></div>";
					}
				?>
				
				<article id="Right">
					<h2>Register</h2>
					
					<form name="reg" id="reg" method="POST" action="">
						Email: <input name="myemailreg" type="email" class="Text" id="myemailreg" placeholder="Email" 
						maxlength="100">
						
						<br />
						
						Password: <input name="mypasswordreg" type="password" class="Text" id="mypasswordreg" maxlength="32"
						placeholder="Password">
						
						<br />
						
						Confirm Password: <input name="mypasswordConfreg" type="password" class="Text"
						id="mypasswordConfreg" placeholder="Confirm Password">
						
						<br />
						
						First Name: <input name="myfirstnamereg" type="text" class="Text" id="myfirstnamereg" maxlength="100"
						placeholder="First Name">
						
						<br />
						
						Surname: <input name="mysurnamereg" type="text" class="Text" id="mysurnamereg" maxlength="100"
						placeholder="Surname">
						
						<br />
						
						<input type="Submit" name="Submit" id="Btn" Value="Register">
					</form>
				</article>
				
				<div id="RegSuccess" style="Display:none;">
					<strong>Registration was successful</strong>
				</div>
			</div>
		</div>
		
		<div id="Bottom">
			<p>Copyright 2012 &#169 All Rights Reserved. Valid(HTML/CSS/Javascript)</p>
		</div>
	</body>
</html>