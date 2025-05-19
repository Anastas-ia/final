<?
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

include($tn_root_path.'/libs/access.php');
$PageRightsV = new classCheckVolunteer();
$PageRightsA = new classCheckAdmin();

if ($PageRightsV->checkVolunteer($db, $user['ID'])=='1' or $PageRightsA->checkAdmin($db, $user['ID'])=='1'){?>
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
       <div class="reg_div"><h1 class="reg_h1">Добавить животное</h1></div>
       
       <form enctype="multipart/form-data" name="signup_form" method="post" action="<?=$uri?>/proc/newanimal.php" >
            <div>
                <div class="modal-content">
                    <div class="box-outer">
                         <!--<form enctype="multipart/form-data" method="post" action="<?=$uri?>/proc/newanimal.php">-->
                            <div class="reg-label"><label>Имя</label></div>
                            <input type="text" name="name" size="33" required>
                            
                            <div class="reg-label"><label>Вид</label></div>
                            <label>
                                <input type="radio" name="type" value="Кот" checked />Кот<br />
                                <input type="radio" name="type" value="Пёс" />Пёс
                            </label>
                            
                            <div class="reg-label"><label>Картинка</label></div>
                            <input type="file" name="picture" size="33" required>
                            
                            <div class="reg-label"><label>Примечание</label></div>
                            <input type="text" name="description" size="33">
                            
                            <input type="submit" name="submit" class="button" value="Добавить">
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </form>

    <!-- Контакты -->
    <?include ($tn_root_path.'/includes/footer.php');?>

</body>
</html>
<?
}
else{
    header("location:../index.php"); exit;
}
exit;?>