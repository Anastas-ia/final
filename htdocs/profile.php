<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

include($tn_root_path.'/libs/access.php');
$PageRightsV = new classCheckVolunteer();
$PageRightsA = new classCheckAdmin();



if ($PageRightsA->checkAdmin($db, $user['ID'])=='1'){
    $toolbar_separ = "<a href='../admin/index.php' ><span class='user-text'>Администратор</span></a>";
}else
	if ($PageRightsV->checkVolunteer($db, $user['ID'])=='1'){
		$toolbar_separ = 'Волонтер';
	}else
	{$toolbar_separ = 'Пользователь';};
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
        <div class="reg_div"><h1 class="reg_h1">Личный кабинет</h1></div>
        <div class="reg_div"><h1 class="reg_h1"><?=$toolbar_separ?> </h1></div>
            <div>
                <div class="modal-div">
                    <div class="box-outer">
            
                        <nav class="modal-gen">
                            <table class="mess_refresh">
                                <?if ($PageRightsV->checkVolunteer($db, $user['ID'])=='1' or $PageRightsA->checkAdmin($db, $user['ID'])=='1'){?>
                                <tr>
                                	<td align="left">Ваша роль:</td>
                                	<td align="left"><?=$toolbar_separ?></td>
                                </tr>
                                <?}?>

                                <tr>
                                	<td align="left">Логин:</td>
                                	<td align="left"><?=$user['LOGIN']?></td>
                                </tr>
                                <tr>
                                	<td align="left">Роль:</td>
                                	<td align="left"><?=$user['ROLE']?></td>
                                </tr>
            
                                <tr class="profile_tr_gap">
                                	<td align="left"></td>
                                	<td align="left"></td>
                                </tr>

                                <?if ($PageRightsV->checkVolunteer($db, $user['ID'])=='1' or $PageRightsA->checkAdmin($db, $user['ID'])=='1'){?>
                                <tr>
                                	<td align="left">Добавить животное:</td>
                                	<td align="left"><a href="<?=$uri?>/new_animal.php" ><span class="user-text">Добавить</span></a></td>
                                </tr>
                                <?}?>

                                                                                        
                                <tr>
                                 <td colspan="2" align="left">
                                    <a href="<?=$uri?>/logout.php" ><span class="user-text">Выход</span></a>
                                 </td>
                                </tr>
                            </table>
                        </nav>



                    </div>
                </div>
            </div>


    <!-- Контакты -->
    <?include ($tn_root_path.'/includes/footer.php');?>

</body>
</html>
<?exit;?>