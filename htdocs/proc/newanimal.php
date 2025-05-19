<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

$id_change=$_GET['animal']; //id животного
//$sql = "SELECT * FROM animals where `ID`='$id_change'";
//$result = $db->query($sql);
//$idUser=$user['ID'];

$types = array('image/gif', 'image/png', 'image/jpeg');
$size = 1024000;

//if ($result->num_rows > 0) {
//    while($row = $result->fetch_assoc()) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $aName=$_POST["name"];
            $aType=$_POST["type"];
            $aDescription=$_POST["description"];



        	// Проверяем картинку
        	if (!in_array($_FILES['picture']['type'], $types)){
            ?>
                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8" />
                    <title>Доброе сердце</title>
                    <link rel="stylesheet" href="<?=$uri?>/css/style.css" />
                    <link rel="stylesheet" href="<?=$uri?>/css/main.css" />
                </head>
                <body>
                    <div>
                        <h1 class="mess_refresh">Извините, запрещённый тип файла. Разрешены gif, png, jpeg</h1>
                        <meta http-equiv="refresh" content="1;url=../new_animal.php">
                    </div>
                </body>
                </html>
            <?exit;}
        	// Проверяем размер файла
        	if ($_FILES['picture']['size'] > $size){
            ?>
                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8" />
                    <title>Доброе сердце</title>
                    <link rel="stylesheet" href="<?=$uri?>/css/style.css" />
                    <link rel="stylesheet" href="<?=$uri?>/css/main.css" />
                </head>
                <body>
                    <div>
                        <h1 class="mess_refresh">Слишком большой размер файла.</h1>
                        <meta http-equiv="refresh" content="1;url=../new_animal.php">
                    </div>
                </body>
                </html>
            <?exit;}

        	// Загрузка файла
        	if (!@copy($_FILES['picture']['tmp_name'], $tn_root_path. '/images/' . $_FILES['picture']['name'])){
            ?>
                <!DOCTYPE html>
                <html lang="ru">
                <head>
                    <meta charset="UTF-8" />
                    <title>Доброе сердце</title>
                    <link rel="stylesheet" href="<?=$uri?>/css/style.css" />
                    <link rel="stylesheet" href="<?=$uri?>/css/main.css" />
                </head>
                <body>
                    <div>
                        <h1 class="mess_refresh">Ошибка.</h1>
                        <meta http-equiv="refresh" content="1;url=../new_animal.php">
                    </div>
                </body>
                </html>
            <?exit;}
        	else {
        		 //echo 'Загрузка удачна в каталог'.$tn_root_path. '/images/';
                 $aFile='/images/'.$_FILES['picture']['name'];
                 $retImg = mysqli_query ($db, "INSERT INTO `animals` (`NAME`, `IMAGE`, `TYPE`, `DESCRIPTION`)
                                                    VALUES ('$aName', '$aFile', '$aType', '$aDescription')");
                 $idAnimal = mysqli_insert_id($db);
                 header("location:".$uri."/to_take.php?animal=".$idAnimal); exit;
                 
                 
                 
            }




        }
//    }
//}
header("location:".$uri."/to_take.php?animal=".$id_change); exit;
?>


