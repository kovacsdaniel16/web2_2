
<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=web3', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM tudos";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Tudós neve</th><th>Témaköre</th>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
				
				$_SESSION['eredmeny']=$eredmeny;
			break;
		case "POST":
				$sql = "insert into tudos values (0, :kn, :tn)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":kn"=>$_POST["kn"], ":tn"=>$_POST["tn"]));
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['kn'] != "") {$modositando .= ", nev = :kn"; $params[":kn"] = $data["kn"];}
				if($data['tn'] != "") {$modositando .= ", terulet = :tn"; $params[":tn"] = $data["tn"];}
				/*if($data['bn'] != "") {$modositando .= ", bejelentkezes = :bn"; $params[":bn"] = $data["bn"];}
				if($data['jel'] != "") {$modositando .= ", jelszo = :jel"; $params[":jel"] = sha1($data["jel"]);}*/
				$sql = "update tudos set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from tudos where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>