<?php
$url =SITE_ROOT."models/hozzaad.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['kn'] = trim($_POST['kn']);
  $_POST['tn'] = trim($_POST['tn']);
 
  
  // Ha nincs id és megadtak minden adatot OK
  if($_POST['id'] == "" && $_POST['kn'] != "" && $_POST['tn'] != "")
  {
      $data = Array("kn" => $_POST["kn"], "tn" => $_POST["tn"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot 
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot
  elseif($_POST['id'] >= 1 && ($_POST['kn'] != "" || $_POST['tn'] != "" ))
  {
      $data = Array("id" => $_POST["id"], "kn" => $_POST["kn"], "tn" => $_POST["tn"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }

  //elseif ($_POST['id']>count($_SESSION['eredmeny'])) {
    
    
   // }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }

}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>

<body>
    <br>
    <?= $result ?>
    <h1>Tudósok:</h1>
    <?= $tabla ?>
    <br>
    <?= $result ?>
    <br>
    <h2>Módosítás / Beszúrás / Töröl</h2>
    <h4>1. Rekord hozzáadása: Töltse ki az összes mezőt!</h4>
    <h4>2. Rekord törlése: Írja be a <u>törlendő</u> sor sorszámát!</h4>
    <h4>3. Meglévő rekord módosítása: adja meg a módosítandó rekord <u>sorszámát</u> és a módosítandó <u>mezőt</u>! </h4>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Kutató neve: <input type="text" name="kn" maxlength="45"> Témaköre: <input type="text" name="tn" maxlength="45"><br><br>
    <input type="submit" value = "Küldés">
    </form>
   
</body>

