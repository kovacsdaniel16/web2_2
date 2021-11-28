<?php
  switch($_POST['op']) {
    case 'eloadas':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("select id, cim from eloadas");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "cim" => $row['cim']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny); //visszakapja az eredményt
      break;

    case 'temakor':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("SELECT tudos.id, nev FROM tudos INNER JOIN kapcsolo on tudosid=tudos.id INNER JOIN eloadas on eloadasid=eloadas.id WHERE eloadas.id= :id"); //második keresés olyan témaköröket keresünk, hol a tudós idja a kulcs
        $stmt->execute(Array(":id" => $_POST["id"])); //itt az id a JS/post-ból küldött "id"
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'datum':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("SELECT eloadas.id, ido FROM eloadas INNER JOIN kapcsolo ON eloadas.id=eloadasid INNER JOIN tudos ON tudos.id=tudosid WHERE tudos.id = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "date" => $row['ido']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
      
    case 'info':
      $eredmeny = array("eloado" => "", "eloadas" => "", "temakor" => "", "datum" => "");
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("SELECT nev, cim, terulet, ido FROM eloadas INNER JOIN kapcsolo ON eloadas.id=eloadasid INNER JOIN tudos ON tudos.id=tudosid WHERE eloadas.id= :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny = array("eloado" => $row['nev'], "eloadas" => $row['cim'], "temakor" => $row['terulet'], "datum" => $row['ido']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
  }
  
?>
