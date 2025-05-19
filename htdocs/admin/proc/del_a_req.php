<?php //Удаление по отчеканым

require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');


include($tn_root_path.'/libs/access.php');
$PageRightsV = new classCheckVolunteer();
$PageRightsA = new classCheckAdmin();

//echo $_SERVER['DOCUMENT_ROOT'];

if ($PageRightsA->checkAdmin($db, $user['ID'])=='1'){
    $access_admin = 'Доступ есть';
}
else{
    header("location:../index.php");exit;
}

        if ($user > 0){ // Проверка залогининости
                          $aDoor = $_POST['dell_err'];
                          if(empty($aDoor))
                          {
                            //echo("Вы ничего не выбрали.");
                            header("location:../animal_req.php"); exit;
                          }
                          else
                          {
                            $N = count($aDoor);
                            //echo("Вы выбрали $N здание(й): ");
                            for($i=0; $i < $N; $i++)
                            {
                              //echo($aDoor[$i] . " ");
                              $result_adrr = mysqli_query($db, "DELETE FROM `animal_requests` WHERE `ID`='$aDoor[$i]'");
                            }
                            header("location:../animal_req.php"); exit;
                          }
        }
        else
        {
            header("location:../index.php"); exit;
        }


?>