<?php
Session_Start();
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
			$LoggedURL = $row['AccURL'];
			if($LoggedURL = ""){
				$_SESSION["LoggedURL"] = $row['AccURL'];
				$file = fopen("Scripts/GenPage.php", "r");)
			}
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
} else {
	header("location: main_login.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS.css">
		
		<title>Home: SkillStream Online</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<LINK REL="SHORTCUT ICON" HREF="Favicon.ico">
		
		<script type="Text/Javascript">
			function Show(id){
				document.getElementByID(id).style.display = "inline";
			}
			function View(id){
				document.getElementByID('ProjView').style.display = "inline";
			}
		</script>
		
	</head>
	
	<body>
		<div id="DevState"><h3>Welcome to the Pre-Alpha!</h3></div>
		
		<div id="wrapper">
			<nav>
				<a id="BtnNav" href="index.php"><h1><strong>Skill</strong>Stream Online</h1></a>
				<ul id="Navbar">
					<li>
						<p>Projects</p>
						
						<ul id="Nested">
							<?php
								include "Scripts/connect_to_mysql.php";
								$id = $_SESSION["LoggedID"];
								$sql = mysql_query("SELECT * FROM Projects WHERE Host_ID = '$id'");
								$ProjectCount = mysql_num_rows($sql);
								if ($ProjectCount > 0){
									while ($row = mysql_fetch_array($sql)){
										$Pic = $row['Pic'];
										$NtTitle = $row['Title'];
										$List = "<img src='$Pic'><a>$NtTitle</a>";
										echo nl2br("<li alt='$NtTitle' title='$NtTitle'>$List</li>");
									 }
								} else{
									$List = "No Projects Yet";
									echo nl2br("<p alt='$List' style='margin-left:20px;' title='$List'>$List</p>");
								}
							?>
						</ul>
					</li>
					
					<li>
						<p>Tools</p>
					
						<ul id="Nested">
							<li alt="Projects" title="Projects">
								<img src="css-img/Projects.png">
								<a href="Projects.php">Projects</a>
							</li>
							
							<li alt="Events" title="Events">
								<img src="css-img/Events.png">
								<a href="Events.php">Events</a>
							</li>
							
							<li alt="Documents" title="Documents">
								<img src="css-img/Docs.png">
								<a href="Docs.php">Documents</a>
							</li>
						</ul>
					<li>
				</ul>
			</nav>
			
			<div id="Title">
				<span style="float:left;">
					<h1 style="height:35px;">
						<a href="index.php">
							<?php 
								echo "<img src='$LoggedPic' style='width:32px; height:32px;'> <span style='margin-left:40px;line-height:35px; vertical-align:middle;'>$LoggedFirst $LoggedLast</span>"
							?>
						</a>
					</h1>
				</span>
				
				<span style="float:right; margin-right:10px;">
					<form id="Search" class="Net" onsubmit="Search.php">
						<input id="TxtSearch" placeholder="Search..." type="text" autocomplete="off">
						<input id="BtnSearch" type="Submit" Value="" title="Search" alt="Search">
					</form>
				</span>
			</div>
			
			<div id="Main" class="Main">
				<a id="Elements" href="#Projects"><img src="css-img/Projects.png" id="IcoImg">Projects</a>
				<a id="Elements" href="#Events"><img src="css-img/Events.png" id="IcoImg">Events</a>
				<a id="Elements" href="#Docs"><img src="css-img/Docs.png" id="IcoImg">Documents</a>
				<a id="Elements" href="#People"><img src="css-img/People.png" id="IcoImg">Connections</a>
				
				<div id="Projects">
					<div id="Item">
						<ul>
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
										$NtURL = $row['URL'];
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
										echo nl2br("<li id='PrjItm' name='PrjItm' alt='$NtTitle' title='$NtTitle'><a href='#{$NtTitle}'>$List</a></li>");
									 }
								} else{
									$List = "No Projects Yet";
									echo nl2br("<li>$List</li>");
								}
							?>
						</ul>
					</div>
				</div>
				
				<div id="ProjView">
					<?php 
						include "Scripts/connect_to_mysql.php";
						$id = $_SESSION["LoggedID"];
						$sql = mysql_query("SELECT * FROM Projects WHERE Host_ID = '$id'");
						$ProjectCount = mysql_num_rows($sql);
						if ($ProjectCount > 0){
							while ($row = mysql_fetch_array($sql)){
								$Prjid = $row['id'];
								$Pic = $row['Pic'];
								$Desc = $row['Description'];
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
								$List = "<img src='$Pic'><div id='Desc'><h3>$NtTitle</h3><i>created: <strong>$NtTime</strong> by: <strong>$NtHost</strong></i></div><div id='desc'>$Desc</div>";
								echo nl2br("<div class='PrjItm' id='$NtTitle' alt='$NtTitle' title='$NtTitle'>$List</div>");
							 }
						} else{
							$List = "No Projects Yet";
							echo nl2br("<li style='margin-bottom:20px;'>$List</li>");
						}
					?>
					
					<a id="Elementtwo" href="#Projects"><img src="css-img/BtnPlus.png" id="IcoImg">Add New Project</a>
				</div>
			</div>
		</div>
		
		<div id="Bottom">
			<p>Copyright <?php echo date('Y');?> &#169 All Rights Reserved. Valid(HTML/CSS/Javascript)</p>
		</div>
	</body>
</html>