<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

$id_change=$_GET['animal']; //id животного
$sql = "SELECT * FROM animals where `ID`='$id_change'";
$result = $db->query($sql);
$idUser=$user['ID'];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $type=$_POST["type"];
            $idUser=$user['ID'];
            mysqli_query($db, "INSERT INTO `animal_requests` (`ID_ANIMAL`, `ID_USER`, `ID_REQUEST_TYPE`) VALUES ('$id_change', '$idUser', '$type')");
        }
    }
}
header("location:".$uri."/to_take.php?animal=".$id_change); exit;
?>
