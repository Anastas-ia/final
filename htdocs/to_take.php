<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

$id_change=$_GET['animal']; //id животного

$sql = "SELECT * FROM animals where `ID`='$id_change'";
$result = $db->query($sql);
$idUser=$user['ID']; //id пользователя

$request = mysqli_query($db, "SELECT * FROM animal_requests where `ID_USER`='$idUser' AND `ID_ANIMAL`='$id_change' ");
$getReq = mysqli_fetch_assoc($request);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Доброе сердце</title>

    <!-- Метаинфо -->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Стили -->
    <link rel="stylesheet" href="<?=$uri?>/css/style.css" />
    <link rel="stylesheet" href="<?=$uri?>/css/main.css" />

</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <!-- Шапка -->
    <?include ($tn_root_path.'/includes/head.php');?>


    <section id="gallery" class="gallery-wrap" style="background: rgb(249, 249, 249);">
        <div class="container">

            <?if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {?>
            <h2 class="section-title"><?=$row["NAME"]?></h2>
            
            
            
            <div class="gallery">
                        <div class='animal-fix'>
                        <img src="<?=$row["IMAGE"]?>" alt="<?=$row["NAME"]?>">
                        <h3> <?=$row["NAME"]?> </h3>
                        <p><?=$row["TYPE"]?></p>
                        <p><?=$row["DESCRIPTION"]?></p>
                        </div>
            <?if (isset($getReq['ID']) and $getReq['ID'] > 0){?>
                Вы подали заявку на это животное.<br />
                Ваша заявка №<?=$getReq['ID']?>.
            <?}else{            
            ?>
                <form id="takeAnimalForm" action="../proc/take_animal.php?animal=<?=$row["ID"]?>" method="POST">
                    <label>
                        <input type="radio" name="type" value="1" checked />Забрать навсегда<br />
                        <input type="radio" name="type" value="2" />Взять на передержку
                    </label>
                    <button type="submit">Отправить</button>
                </form>
            <?}}}?>
                


            </div>
        </div>
    </section>


    <!-- Контакты -->
    <?include ($tn_root_path.'/includes/footer.php');?>

</body>
</html>
<?exit;?>