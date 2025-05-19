<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

$tokenuser = htmlspecialchars($_COOKIE['token']); // на всякий сл.

mysqli_query($db, "DELETE FROM `tokens` WHERE `TOKEN`='$tokenuser'");
unset ($tokenuser); // Уничтожаем переменную
setcookie('token', '', 0,'/');
setcookie('token', 'false', time() - 1, '/');
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Доброе сердце</title>
    
    <meta http-equiv='refresh' content='1; url=./' />

    <!-- Метаинфо -->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Стили -->
    <link rel="stylesheet" href="<?=$uri?>/css/style.css" />
    <link rel="stylesheet" href="<?=$uri?>/css/main.css" />

</head>
<body>
<table width='100%' height='85%' align='center'>
<tr>
  <td valign='middle'>
      <table align='center' cellpadding="4" class="tablefill">
      <tr>
        <td width="100%" align="center">
          Вы вышли. Всего доброго!<br />
          Будем рады видеть Вас снова!<br /><br />
          Подождите, сейчас Вы будете перемещены на начальную страницу...<br /><br />
          (<a href='./'>Или нажмите сюда, если не хотите ждать</a>)
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
</body>
</html>
<?php
?>