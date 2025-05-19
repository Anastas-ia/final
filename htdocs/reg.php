<?require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');?>
<?include ($tn_root_path.'/libs/db.php');?>

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
       <div class="reg_div"><h1 class="reg_h1">Регистрация</h1></div>
       <form name="signup_form" method="post" action="<?=$uri?>/proc/register.php" >
            <div>
                <div class="modal-content">
                    <div class="box-outer">
                         <form method="post" action="login.php">
                            <div class="reg-label"><label>Логин</label></div>
                            <input type="text" name="login" size="33" required>
                            <div class="reg-label"><label>Пароль</label></div>
                            <input type="password" name="password" size="33" required>
                            <input type="submit" name="submit" class="button" value="Регистрация">
                        </form>
                    </div>
                </div>
            </div>
        </form>

    <!-- Контакты -->
    <?include ($tn_root_path.'/includes/footer.php');?>

</body>
</html>
<?exit;?>