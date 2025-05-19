<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');
include($tn_root_path.'/libs/access.php');
$PageRightsV = new classCheckVolunteer();
$PageRightsA = new classCheckAdmin();

if ($PageRightsA->checkAdmin($db, $user['ID'])=='1'){
    $access_admin = 'Доступ есть';
}
else{
    header("location:../index.php");exit;
}
//--------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $edit=$_GET["edit"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit=$_POST["user"];
    $type=$_POST["type"];
    
    $retUser = mysqli_query($db, "UPDATE `users` SET `ROLE`='$type' WHERE `ID`='$edit'");
}
    $request = mysqli_query($db, "SELECT * FROM users WHERE ID = $edit");
    $getReq = mysqli_fetch_assoc($request);
    $userID=$getReq['ID'];
    $role=$getReq['ROLE'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Доброе сердце</title>
    <!-- Стили -->
    <link href="../css/css_admin.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">


<div class="center_column_admin">
    <div class="container_admin">
        Пользователь ID <?=$getReq['ID']?> <br /><br />
        Логин <?=$getReq['LOGIN']?> <br /><br />
        Роль <?=$getReq['ROLE']?> <br /><br /><br />
        <form action="../admin/edit_user.php" method="post">
            <?if (isset($getReq['ID']) && $getReq['ID'] > 0){?>
                <label>
                        <input type="radio" name="type" value="admin" <?=$getReq['ROLE']=='admin'?'checked':''?> />Админ<br />
                        <input type="radio" name="type" value="guest" <?=$getReq['ROLE']=='guest'?'checked':''?> />Гость<br />
                        <input type="radio" name="type" value="volunteer" <?=$getReq['ROLE']=='volunteer'?'checked':''?> />Волонтер<br />
                </label>
            <?}?>
            <input type="hidden" name="user" value="<?=$userID?>" />
            <br /><br />
            <input type="submit" name="formSubmit" value="Сохранить" />
         </form>
    </div>
</div>

</body>
</html>
<?exit;?>


