<?php


//LocalDB yoksa LocalDB oluştur
$sqlite = new PDO("sqlite:".__DIR__."/LocalDB.sql"); 
 
$sorgu="CREATE TABLE IF NOT EXISTS `pwa_test`(
        ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
        name VARCHAR(255), 
        email VARCHAR(255), 
        status INT(20))";
$sqlite->exec($sorgu);


?>