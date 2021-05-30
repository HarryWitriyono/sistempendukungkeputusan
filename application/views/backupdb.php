<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = 'spk';
$user = 'root';
$pass = '';
$host = 'localhost';
//$dir = dirname(__FILE__) . '\dump.sql';
$dir="d:\spk.sql";
echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

//exec("c:\xampp\mysql\bin\mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
//exec("c:\xampp\mysql\bin\mysqldump --user=".$user." --password=".$pass." --host=".$host." ".$database." --result-file=".$dir,$output);
//$perintah="\xampp\mysql\bin\mysqldump -u".$user." -p".$pass." ".$database." > ".$dir;
$perintah=" c:\\xampp\\mysql\\bin\\mysqldump -u".$user." -p".$pass." ".$database." > ".$dir;
echo $perintah."<br>";
exec($perintah,$output);
var_dump($output);