<?
Session_Start();
// FIRST SET - COPY TPL_DEX , RENAME IT AS INDEX.PHP

// $source="../tpl_for_dupli/tpl_dex.php"; 
// $dest="../index.php"; 
$source="Acc/tpl_for_dupli/tpl_dex.php"; 
$dest="Acc/tpl_dex.php";

if (!copy($source, $dest)) { 
print ("failed to copy $dest...\n"); 
} 
echo ""; 
// end of copy file 

// rename file
rename("Acc/tpl_dex.php", "Acc/index.php");

$new_file="Acc/index.php";

//here we write to file

$fp = fopen("$new_file", "r+"); 
if(!$fp) die ("Unfortunately, I cannot open index");

//in ($fp,any #) the number is the precise number of bites from where we start writing data to file 
//for needed reasons in that example I pass the ID to the page. 
fseek($fp, 52); 
// HERE WE NEED THE REAL "ID" to match includes requirements; the write function passs id # to new file $id 
Include "Scripts/connect_to_mysql.php";
$email = $_SESSION["LoggedEmail"];
$page = $_SESSION["LoggedURL"];
$query = "select id from Users where email= '$email' and AccURL= '$page' "; 
$result= mysql_query ($query);

while($query_data=mysql_fetch_array($result)) { 


$byte = fwrite($fp,$query_data["id"]); 
}
?> 