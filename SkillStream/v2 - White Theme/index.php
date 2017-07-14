<?php 
	Session_Start();
	if(!empty($_POST)){
	  header("location: index.php\n");
	}
	if ($_SESSION["LoggedID"] != ""){
			$LoggedID = $_SESSION["LoggedID"];
			$LoggedEmail = $_SESSION["LoggedEmail"];
			$LoggedPass = $_SESSION["LoggedPass"];
			include "Scripts/connect_to_mysql.php";
			$sql = mysql_query("SELECT * FROM Users WHERE Email = '$LoggedEmail' AND Pass = '$LoggedPass' LIMIT 1");
			$existCount = mysql_num_rows($sql);
			if ($existCount > 0){
				While($row = mysql_fetch_array($sql)){
					$LoggedPic = $row['Pic'];
					$LoggedFirst = $row['First'];
					$LoggedLast = $row['Surname'];
					$LoggedDate = $row['Last_Logged'];
					$LoggedInfo = $row['About'];
					$LoggedBirth = $row['Birthday'];
					$LoggedMob = $row['Mobile'];
					$LoggedPhone = $row['Phone'];
					$Gend = "";
					if ($row['Gender'] == "0"){
						$LoggedGend = "Male";
						$Gend[1] = "selected='selected'";
					} else{
						$LoggedGend = "Female";
						$Gend[0] = "selected='selected'";
					}
				}
			}
			$Logset = "";
			$Logstate = "<a id='Logset' onclick='ShowSet();'><img src='css-img/BtnDown.png'></a> Welcome $LoggedFirst.";
	} else {
		$LoggedPic = "css-img/Account.png";
		$Logset = '<div class="Elem" id="WinLogin"><h2 id="Title">Login</h2><div id="Fill"><form id="Login" method="POST" action=""><h3>Login</h3>Email: <input id="LogEmail" name="LogEmail" type="email" style="width:300px;" class="email" placeholder="Email"><br />Password: <input id="LogPass" name="LogPass" type="Password" style="width:274px;" class="text" placeholder="Password"><br /><input type="Submit" name="LogSubmit" id="Btn" Value="Login"></form><form id="Reg" method="POST" action="Scripts/Register.php"><h3>Register</h3>Email: <input id="RegEmail" name="RegEmail" type="email" style="width:228px;" class="email" placeholder="Email"><br /><br /><strong>Password: </strong><input id="RegPass" name="RegPass" style="width:228px;" type="Password" class="text" placeholder="Password"><br />Confirm Password: <input id="RegConfPass" name="RegConfPass" style="width:228px;" type="Password" class="text" placeholder="Confirm Password"><br /><br /><strong>Name:</strong>&nbsp&nbsp&nbspFirst: <input id="RegFName" name="RegFName" type="text" style="width:228px;" class="FName" placeholder="First Name"><br />Last: <input id="RegSurname" name="RegSurname" type="text" style="width:228px;" class="Surname" placeholder="Surname"><br /><br /><input type="Submit" name="RegSubmit" id="Btn" Value="Register"></form></div></div>';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			
		<link rel="stylesheet" type="text/css" href="style.css">
		
		<LINK REL="SHORTCUT ICON" HREF="Favicon.ico">
		
		<title>SkillStream Online</title>
		
		<script type="Text/Javascript">
			function ShowOther(id){
				document.getElementById(id).style.display = 'block';
			}
			function ShowSet(){
				document.getElementById('SetMenu').style.display = 'block';
				document.getElementById("Logset").setAttribute("class", "Clicked");
			}
			function HideSet(){
				document.getElementById('SetMenu').style.display = 'none';
				document.getElementById("Logset").setAttribute("class", "");
			}
			function HideElem(id){
				document.getElementById(id).style.display = 'none';
			}
			function HideAllElem() {
				document.getElementById('WinProjects').style.display = 'none';
				document.getElementById('WinPeople').style.display = 'none';
				document.getElementById('WinSettings').style.display = 'none';
				document.getElementById('WinAccount').style.display = 'none';
			}
			function Search(id){
				document.getElementById('CloseSearch').style.display = 'block';
			}
			function Clear(id){
				document.getElementById(id).value = "";
				document.getElementById('CloseSearch').style.display = 'none';
			}
			function ShowDesc(id){
				document.getElementById('ViewMate1').style.display = "block";
				Window.PrjID = id;
			}
		</script>
	</head>
	<body>
		<div id="head">
			<h1><strong>Skill</strong>Stream Online</h1>
			<p><i><?php echo"$Logstate";?></i> <strong>Pre-Alpha</strong></p>
		</div>
		
		<div id="Menu">
			<div id="SetMenu">
				<ul>
					<li class="Item" onclick="HideSet();">Cancel</li>
					<li class="MenuDivider"></li>
					<li class="Item" onclick="HideAllElem(); ShowOther('WinSettings'); HideSet();">Settings</li>
					<li class="Item" onclick="Logout();" onclick="HideSet();">Log Out</li>
					<li class="MenuDivider"></li>
					<li class="Item" onclick="ShowOther('SecHelp'); HideSet();">Help</li>
					<i id="Grey"><strong>Skill</strong>Stream &copy; <?php echo date('Y');?></i>
				</ul>
			</div>
		</div>
		
		<div id="Sections">
			<div id="SecHelp">
				<div id="SearchELEM">
					<a id="CloseOver" onclick="HideElem('SecHelp');"></a>
					<h4>How can I help?</h4>
					<div id="Inplace">
						<img src="css-img/Search.png">
						<input id="InHelp" onchange="Search('InHelp');">
						<a id="CloseSearch" style="display:none;" onclick="Clear('InHelp');"></a>
					</div>
				</div>
				<ul id="SrchArea">
					<div id="Topics">
						<li class="Topic">Topic</li>
						<li class="Topic">Topic</li>
						<li class="Topic">Topic</li>
						<li class="Topic">Topic</li>
						<li class="Topic">Topic</li>
					</div>
					<i style="padding-left:10px;">Anything Missing?</i> <a href="#">Get in Touch</a>
				</ul>
			</div>
		</div>
		
		<div id="HomeWrapp">
			<ul id="Content">
				<li id="BtnAccount">
					<a onclick="HideAllElem(); ShowOther('WinAccount');">
						<?php echo "<img id='Show' alt='Account' title='Account' src='$LoggedPic'>";?>
					</a>
				</li>
				
				<li class='Norm' id="BtnProjects">
					<a onclick="HideAllElem(); ShowOther('WinProjects');">
						<img id="Show" alt="Projects" title="Projects" src="css-img/Projects.png">
					</a>
				</li>
				
				<li class='Norm' id="BtnPeople">
					<a onclick="HideAllElem(); ShowOther('WinPeople');">
						<img id="Show" alt="People" title="People" src="css-img/People.png">
					</a>
				</li>
				
				<li class='Norm' id="BtnSetttings">
					<a onclick="HideAllElem(); ShowOther('WinSettings');">
						<img id="Show" alt="Settings" title="Settings" src="css-img/Settings.png">
					</a>
				</li>
			</ul>
		</div>
		
		<?php
			if (isset($_POST["LogEmail"])&&isset($_POST["LogPass"])){
				$Email = $_POST["LogEmail"];
				$Password = $_POST["LogPass"];
				Include "Scripts/connect_to_mysql.php";
				$sql = mysql_query("INSERT INTO `jensenlowe_co_uk_Job_Inventors`.`Users` (`date`) VALUES (CURRENT_TIMESTAMP)");
				$sql = mysql_query("SELECT id FROM Users WHERE Email = '$Email' AND Pass = '$Password' LIMIT 1");
				$existCount = mysql_num_rows($sql);
				if ($existCount ==1){
					While($row = mysql_fetch_array($sql)){
					$id = $row["id"];
				}
					$_SESSION["LoggedID"] = $id;
					$_SESSION["LoggedEmail"] = $Email;
					$_SESSION["LoggedPass"] = $Password;
					echo "<div id='Success'><h4>Login</h4>Your Email or Password was incorrect, please check your details are correct.<a id='CloseOver' onclick=HideElem('FailedReg');></a></div>";
				}else{
					echo "<div id='FailedReg'><h4>Login</h4>Your Email or Password was incorrect, please check your details are correct.<a id='CloseOver' onclick=HideElem('FailedReg');></a></div>";
				}
			}
			
			echo "$Logset";
			
			include "Scripts/connect_to_mysql.php";
			if (isset ($_POST["EdSent"])){
				$id = $_SESSION["LoggedID"];
				$Email = mysql_real_escape_string($_POST["EdMail"]);
				$First = mysql_real_escape_string($_POST["EdFst"]);
				$Surname = mysql_real_escape_string($_POST["EdSur"]);
				$About = mysql_real_escape_string($_POST["EdAbt"]);
				$Gend = mysql_real_escape_string($_POST["EdGnd"]);
				$Mobile = mysql_real_escape_string($_POST["EdMob"]);
				$Phone = mysql_real_escape_string($_POST["EdPhone"]);
				$Birth = mysql_real_escape_string($_POST["EdBir"]);
				$sql = mysql_query("SELECT id FROM message WHERE UsrNme='$Title' LIMIT 1");
				$Match = mysql_num_rows($sql);
				if ($Match > 0){
					$sql = mysql_query("UPDATE  Users SET Email =  '$Email', Gender =  '$Gend', Mobile =  '$Mobile', Phone =  '$Phone', Birthday =  '$Birth', First =  '$First', Surname =  '$Surname', About =  '$About', Last_Logged' = CURRENT_TIMESTAMP WHERE  Users.id = '$id';") or die(mysql_error());
				}
				$Con = include "Scripts/connect_to_mysql.php";
				
				mysql_close($Con);
			}
		?>
		
		<div class="Elem" id="WinAccount" style="display:none;">
			<a id="CloseOver" onclick="HideAllElem();"></a>
			<h2 id="Title">Account</h2>
			<div id="Fill">
				<a id="Btn" onclick="ShowOther('EdAcc'); HideElem('Info');"><img src="css-img/BtnPencil.png"> Edit</a>
				<div id="Info">
					<div style="float:left; Width:45%;">
						<p><strong>About You:</strong></p><div id="Extend" Class="InArea"><p><?php echo nl2br("$LoggedInfo");?></p></div>
					</div>
					
					<div style="float:right; Width:45%;">
						<p><strong>Name: </strong><?php echo "$LoggedFirst $LoggedLast";?></p>
						<p><strong>Birthday: </strong><?php echo "$LoggedBirth";?></p>
						<p><strong>Gender: </strong><?php echo "$LoggedGend";?></p>
						<br /><br />
						<h3>Contact Details</h3>
						<p><strong>Mobile: </strong><?php echo "$LoggedMob";?></p>
						<p><strong>Phone: </strong><?php echo "$LoggedPhone";?></p>
						<p><strong>Email: </strong><?php echo "$LoggedEmail";?></p>
					</div>
				</div>
				
				<form id="EdAcc" name="EdAcc" action="" method="POST">
					<img src="css-img/Arrow.png" style="position:absolute; top:-8px; left:10px;">
					<div style="float:left; Width:45%;">
						<p><strong>Name: </strong><input autocomplete="off" name="EdFst" type="text" id="EdFst" style="width:150px;" tabindex="1" placeholder="Name" Value=<?php echo "$LoggedFirst"?>> <input autocomplete="off" name="EdSur" type="text" id="EdSur" style="width:141px;" tabindex="2" placeholder="Surname" Value=<?php echo "$LoggedLast"?>></p>
						<p><strong>About You:</strong></p>
						<textarea autocomplete="off" name="EdAbt" style="max-Width:363px; Width:363px; height:250px; padding:5px;" id="EdAbt" tabindex="3" placeholder="Write Something about you here... HTML is optional">
							<?php echo "$LoggedInfo";?>
						</textarea>
					</div>
					
					<div style="float:right; Width:45%;">
						<p><strong>Birthday: </strong><input autocomplete="off" name="EdBir" type="date" id="EdBir" tabindex="4" placeholder="Surname" Value=<?php echo "$LoggedBirth"?>></p>
						<p><strong>Gender: </strong><select autocomplete="off" name="EdGnd" style="50px" id="EdGnd" tabindex="5" placeholder="Gender" Value=<?php echo "$LoggedGend"?>><option value="1" <?php echo "$Gend[0]";?>>Female</Option><option value="2" <?php echo "$Gend[1]";?>>Male</Option></select></p>
						<br /><br />
						<h3>Contact Details</h3>
						<p><strong>Mobile: </strong><input autocomplete="off" name="EdMob" type="text" id="EdMob" tabindex="6" placeholder="Mobile" Value=<?php echo "$LoggedMob"?>></p>
						<p><strong>Phone: </strong><input autocomplete="off" name="EdPhone" type="text" id="EdPhone" tabindex="7" placeholder="Phone" Value=<?php echo "$LoggedPhone"?>></p>
						<p><strong>Email: </strong><input autocomplete="off" name="EdMail" type="email" id="EdMail" tabindex="8" placeholder="Email" Value=<?php echo "$LoggedEmail"?>></p>
						<input type="hidden" id="EdSent" name="EdSent">
						<input id="Btn" name="EdAbSub" type="submit" id="EdAbSub" value="Save" tabindex="9" style="position:absolute; bottom:6px; right:10px;">
					</div>
				</form>
			</div>
		</div>
		
		<div class="Elem" id="WinProjects" style="display:none;">
			<a id="CloseOver" onclick="HideAllElem();"></a>
			<h2 id="Title">Connected Projects</h2>
			<a id="Btn"><img src="css-img/BtnPlus.png"> Add</a>
			<div id="ViewMate">
				<ul id="Viewer">
					<?php
					include "Scripts/connect_to_mysql.php";
					$id = $_SESSION["LoggedID"];
					$sql = mysql_query("SELECT * FROM Projects WHERE Host_ID = '$id'");
					$ProjectCount = mysql_num_rows($sql);
					if ($ProjectCount > 0){
						while ($row = mysql_fetch_array($sql)){
							$Prjid = $row['id'];
							$Pic = $row['Pic'];
							$NtTitle = $row['Title'];
							$NtHostID = $row['Host_ID'];
							if(!$NtHostID == $id){
								$NtHostsql = mysql_query("SELECT * FROM Users WHERE id = '$NtHostID'");
								$C = mysql_num_rows($NtHostsql);
								if ($C > 0){
									while ($Row = mysql_fetch_array($NtHostsql)){
										$NtHost = $Row['First'];
									}
								}
							} else{$NtHost = "You";};
							$NtTime = $row['Date_Created'];
							$List = "<img src='$Pic'><h3>$NtTitle</h3><i>created: <strong>$NtTime</strong> by: <strong>$NtHost</strong></i>";
							echo nl2br("<li id='PrjItm' name='PrjItm' alt='$NtTitle' title='$NtTitle'>$List</li>");
						 }
					} else{
						$List = "No Projects Yet";
						echo nl2br("<li>$List</li>");
					}
					?>
				</ul>
			</div>
			
			<div id="ViewMate1">
				<div id="Viewer">
					<?php
					include "Scripts/connect_to_mysql.php";
					$id = "";
					$sql = mysql_query("SELECT * FROM Projects WHERE id = '$id' LIMIT 1");
					$ProjectCount = mysql_num_rows($sql);
					if ($ProjectCount > 0){
						while ($row = mysql_fetch_array($sql)){
							$Pic = $row['Pic'];
							$NtTitle = $row['Title'];
							$NtHostID = $row['Host_ID'];
							if(!$NtHostID == $id){
								$NtHostsql = mysql_query("SELECT * FROM Users WHERE id = '$NtHostID'");
								$C = mysql_num_rows($NtHostsql);
								if ($C > 0){
									while ($Row = mysql_fetch_array($NtHostsql)){
										$NtHost = $Row['First'];
									}
								}
							} else{$NtHost = "You";};
							$NtTime = $row['Date_Created'];
							$List = "<img style='Float:left; height:50px; margin-right:10px;' src='$Pic'><h3>$NtTitle</h3><i>created: <strong>$NtTime</strong> by: <strong>$NtHost</strong></i>";
							echo nl2br("$List");
						 }
					} else{
						$List = "No Information is Yet Available";
						echo nl2br("<p>$List</p>");
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="Elem" id="WinPeople" style="display:none;">
			<a id="CloseOver" onclick="HideAllElem();"></a>
			<h2 id="Title">People</h2>
			<div id="ViewMate">
				<ul id="Viewer">
					<li>hi</li>
				</ul>
			</div>
		</div>
		
		<div class="Elem" id="WinSettings" style="display:none;">
			<a id="CloseOver" onclick="HideAllElem();"></a>
			<h2 id="Title">Settings</h2>
			<div id="Fill">
				
			</div>
		</div>
	</body>
</html>