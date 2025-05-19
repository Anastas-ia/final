<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include ($tn_root_path.'/libs/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login= $_POST["login"];
    $password=$_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    //$role = $_POST["role"];

    //отправляем запрос на выборку всего содержимого , где поле логин равно переменной $login
    $testUser = mysqli_query($db, "SELECT * FROM `users`  WHERE `LOGIN`='".$login."'");
    if (mysqli_num_rows($testUser)>0){ //Если выборка удачна
        $row = mysqli_num_rows($testUser); // считаем количество рядов результата запроса
    }
    else{
        $row = 0;
    }
	if($row > 0)
    { //если переменная больше 0
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
                <h1 class="mess_refresh">Извините, введённый вами логин уже зарегистрирован. Введите другой логин.</h1>
                <meta http-equiv="refresh" content="3;url=<?=$uri?>"/index.php">
            </div>
        </body>
        </html>
        <?
        exit;
    }
    else{//если же ошибок нет
        $retUsers = mysqli_query($db, "INSERT INTO `users` (`LOGIN`, `PASSWORD`, `ROLE`) VALUES ('$login', '$hash', 'guest')");
        //отправляем запрос на выборку всего содержимого , где поле логин равно переменной $login
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        ///echo " login=".$login;
        $query = mysqli_query($db, "SELECT * FROM `users` WHERE `LOGIN`='".$login."'");
        $user = mysqli_fetch_assoc($query);
        $row = mysqli_num_rows($query); // считаем количество рядов результата запроса
        if($row > 0) //если их больше 0
       	{
            ///echo " $ row=".$row;
            $hashLogin = password_hash($login, PASSWORD_DEFAULT);
            setcookie('token', $hashLogin, 0, '/'); // до окончания сессии
            //echo " $ row=".$row;
            //echo " user[LOGIN]=".$user[LOGIN]. " user[ID]=".$user[ID]." hashLogin=".$hashLogin;
            mysqli_query($db, "INSERT INTO `tokens` (`COLLECTION_ID`, `TOKEN`) VALUES ('$user[ID]','$hashLogin')");
        }
    }
    //echo "Регистрация прошла успешно!";
}
//header("refresh:1; url=/index.php");
header("location:".$uri."/index.php"); exit;
?>
