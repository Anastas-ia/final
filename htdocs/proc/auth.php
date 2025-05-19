<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
//require_once 'db_config.php';
include ($tn_root_path.'/libs/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login= $_POST["login"];
    $password=$_POST["password"];
    //$role = $_POST["role"];

    //отправляем запрос на выборку всего содержимого , где поле логин равно переменной $login
    $query = mysqli_query($db, "SELECT * FROM `users`  WHERE `LOGIN`='".$login."'");
    if (mysqli_num_rows($query)>0){ //Если выборка удачна
        $user = mysqli_fetch_assoc($query);
        $hash = $user['PASSWORD'];

        if (password_verify($password, $hash)) {
            $hashLogin = password_hash($login, PASSWORD_DEFAULT);
            setcookie('token', $hashLogin, 0, '/'); // до окончания сессии
            mysqli_query($db, "INSERT INTO `tokens` (`COLLECTION_ID`, `TOKEN`) VALUES ('$user[ID]','$hashLogin')");
        }
        else{
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
                    <h1 class="mess_refresh">Извините, введённый вами логин пароль не совпадают.</h1>
                    <meta http-equiv="refresh" content="3;url=<?=$uri?>/login.php">
                </div>
            </body>
            </html>
            <?
            exit;            
        }
    }
    else{
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
                <h1 class="mess_refresh">Извините, введённый вами логин не существует.</h1>
                <meta http-equiv="refresh" content="3;url=<?=$uri?>/login.php">
            </div>
        </body>
        </html>
        <?
        exit;
    }
}
//header("refresh:1; url=/index.php");
header("location:".$uri."/index.php"); exit;
?>
