<?php
  switch($_POST['op']) {
    case 'eloado':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("select id, nev from tudos");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
              $_SESSION['eredmeny']=$eredmeny;
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;

    case 'temakor':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select id, terulet from tudos");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "terulet" => $row['terulet']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'intezmeny':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select idintezmeny, nev from intezmeny where idvaros = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['idintezmeny'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'info':
      $eredmeny = array("nev" => "", "cim" => "", "tel" => "", "email" => "");
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select nev, cim, telefon, email from intezmeny where idintezmeny = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny = array("nev" => $row['nev'], "cim" => $row['cim'], "tel" => $row['telefon'], "email" => $row['email']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
  }
?>
