<?php include("inc/offlineDB.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./styles.css">
  <link rel="manifest" href="./manifest.webmanifest">
  <title>Test App</title>
</head>

<body>
  <header>
    <h1>Test App</h1>
  </header>

  <main>
    
    <h3>Local DB'den gelen veriler</h3>
    <ul>
      <?php
      $sqlLocal = "SELECT * FROM pwa_test ORDER BY id DESC;";
      $dataLocal = $sqlite->query($sqlLocal);
      foreach($dataLocal as $row)
      {
      ?>
      <li><?=$row["name"]?> (<?=$row["email"]?>)</li>
      <?php } ?>
    </ul>
    
    <br><br>

    

    <div>Network Status : <span id="NetworkStatus"></span></div>
    <div>Cache Data Count : <span id="CacheDataCount"></span></div>
    
    <br><br>

    <form action="#" method="post" name="saveform">
        <input type="text" placeholder="Name Surname" name="name" id="name">
        <input type="text" placeholder="E-mail" name="email" id="email">
        <input type="submit" value="Save Data">
    </form>
    
  </main>
  <script src="./index.js" type="module"></script>
  <script>
    window.addEventListener('load', () =>
    {
        if (navigator.onLine) {
            //alert("online");
            console.log("online");
            //$("#NetworkStatus").html("Online");
            //document.getElementById("NetworkStatus").html("Online");
            window.location.replace("index.php");

        } else {
            //alert("offline");
            console.log("offline");
            //$("#NetworkStatus").html("Offline");
            //document.getElementById("NetworkStatus").html("Offline");
            //window.location.replace("index_offline.php");

        }
    });
  </script>
</body>

</html>
