<?php
//UzakDB'ye Bağlan
session_start();
ob_start();
error_reporting(0);
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "test";
$prefix = "";
$mysqli = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("MYSQL'e baglanamadi");
$mysqli->set_charset("utf8");
date_default_timezone_set('Europe/Istanbul');
error_reporting(0);

//LocalDB yoksa LocalDB oluştur
$sqlite = new PDO("sqlite:".__DIR__."/LocalDB.sql"); 
 
$sorgu="CREATE TABLE IF NOT EXISTS `pwa_test`(
        ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
        name VARCHAR(255), 
        email VARCHAR(255), 
        status INT(20))";
$sqlite->exec($sorgu);











/* UzakDb'dekileri LocalDb'ye Yaz --start */

//LocalDB'deki Kayıtları bir diziye aktar.
$LocalDBArray = array();
$sqlLocal = "SELECT * FROM pwa_test ORDER BY id";
$LocalKayitlar = $sqlite->query($sqlLocal);
foreach($LocalKayitlar as $row)
{
  $LocalDBArray[$row["ID"]]["name"] = $row["name"];
  $LocalDBArray[$row["ID"]]["email"] = $row["email"];
}
//print_r($LocalDBArray);
$sql = $mysqli->query("SELECT * FROM pwa_test ORDER BY id DESC;");
while($veri = $sql->fetch_array(MYSQLI_ASSOC))
{ 
  //Uzak DB'de dönen veriler, LocalDB'de varsa işlem yapma, yoksa LocalDB'ye Ekle.
  if(array_key_exists($veri["id"], $LocalDBArray))
  {
    //Kayıtları Güncellenebilir yada Sabit Bırakılır. Hangi veri tabanının BASE olarak tanımlı olacağına bağlı olarak.
  }
  else
  {
    //Kayıtları Döndür ve Ekle
    $kayit_sorgu = "INSERT INTO pwa_test (id, name, email, status) 
    VALUES ('".$veri["id"]."','".$veri["name"]."','".$veri["email"]."','".$veri["status"]."')";
    $stmt = $sqlite->prepare($kayit_sorgu);
    $sqlite->exec($kayit_sorgu);
  }
}
/* UzakDb'dekileri LocalDb'ye Yaz --end */











/* LocalDB'dekileri UzakDB'ye yaz Yaz --start */

//LocalDB'deki Kayıtları bir diziye aktar.
$RemoteDBArray = array();
$sql = $mysqli->query("SELECT * FROM pwa_test ORDER BY id DESC;");
while($veri = $sql->fetch_array(MYSQLI_ASSOC))
{
    $RemoteDBArray[$veri["id"]]["name"] = $veri["name"];
    $RemoteDBArray[$veri["id"]]["email"] = $veri["email"];
}
//print_r($RemoteDBArray);
$sqlLocal2 = "SELECT * FROM pwa_test ORDER BY id";
$LocalKayitlar2 = $sqlite->query($sqlLocal2);
foreach($LocalKayitlar2 as $row)
{
   //LocalDB'de dönen veriler, UzakDB'de varsa işlem yapma, yoksa UzakDB'ye Ekle.
   if(array_key_exists($row["ID"], $RemoteDBArray))
   {
     //Kayıtları Güncellenebilir yada Sabit Bırakılır. Hangi veri tabanının BASE olarak tanımlı olacağına bağlı olarak.
   }
   else
   {
     //Kayıtları Döndür ve Ekle
     $sql = "INSERT INTO `pwa_test` (`id`, `name`, `email`, `status`)
             VALUES ('".$row["ID"]."', '".$row["name"]."', '".$row["email"]."', '1')";
     $ekle = $mysqli->query($sql);
   }
}
/* LocalDB'dekileri UzakDB'ye yaz Yaz --end */




?>