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
$sql_animals = "SELECT * `animal_requests`";
//--------------------------------------------------------------------------------------------
   $result_ani = mysqli_query($db, "SELECT a.ID ID, 
                                                a.ID_USER ID_USER,
                                                a.ID_ANIMAL ID_ANIMAL,
                                                a.ID_REQUEST_TYPE ID_REQUEST_TYPE,
                                                a.REQUEST_DATE  REQUEST_DATE,
                                                b.LOGIN LOGIN,
                                                c.NAME NAME
                                        FROM `animal_requests` a
                                        LEFT JOIN `users` b ON a.ID_USER = b.ID
                                        LEFT JOIN `animals` c ON a.ID_ANIMAL = c.ID
                                        ");
                                        //FROM `animal_requests` a, `users` b, `animals` c
                                        //WHERE a.ID_USER = b.ID AND a.ID_ANIMAL = c.ID

                                        //FROM `animal_requests` a
                                        //LEFT JOIN `users` b ON a.ID_USER = b.ID
                                        //LEFT JOIN `animals` c ON a.ID_ANIMAL = c.ID

    if ($result_ani){
        if (mysqli_num_rows($result_ani)>0){ //Если выборка удачна
            $array_ani = array();
            $arr_ani = 0;
            //------------------------------------
            $collor = 1;
            while ($row_ani = mysqli_fetch_array($result_ani)) //перебор
            {
            
            $array_ani[$arr_ani] = (array('ID'=>$row_ani['ID'],
                                                'ID_USER'=>$row_ani['ID_USER'],
                                                'LOGIN'=>$row_ani['LOGIN'],
                                                'ID_ANIMAL'=>$row_ani['ID_ANIMAL'],
                                                'NAME'=>$row_ani['NAME'],
                                                'ID_REQUEST_TYPE'=>$row_ani['ID_REQUEST_TYPE'],
                                                'REQUEST_DATE'=>$row_ani['REQUEST_DATE'],
                                                'collor'=>$collor
                                                ));
				if ($collor==2){$collor=1;}else{$collor++;}
				$arr_ani ++;
            };
            //------------------------------
        }
        mysqli_free_result($result_ani);
    }
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
<script language="JavaScript" type="text/JavaScript">
    function CheckAll_id(check) {
			
            var nodes = document.getElementsByTagName("input");
			
            for (var i = 0; i < nodes.length; i++) {
				//alert("WARNING="+nodes[i].id+"="+i);
               if(nodes[i].id==i){
                nodes[i].checked = check;
               }
            }
        }
</script>
<?include ($tn_root_path . '/admin/includes/toolbar.php');?>
<div class="center_column_admin">
    <div class="container_admin">
        <form action="../admin/proc/del_a_req.php" method="post">
        <h2><input type="Checkbox" onclick="CheckAll_id(this.checked)" /> Отметить все</h2>
            <table id="myTable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        	<thead>
        		<tr>
                    <th class="header tablesorter_200">ID</th>
                    <th class="header tablesorter_200">ID Пользователь</th>
                    <th class="header tablesorter_200">Пользователь</th>
                    <th class="header tablesorter_200">ID Животного</th>
                    <th class="header tablesorter_200">Имя Животного</th>
                    <th class="header tablesorter_200">Тип запроса</th>
                    <th class="header tablesorter_200">Дата</th>
                    <th class="header"></th>
        		</tr>
        	</thead>
        	<tbody>
                <?
                 if (isset($array_ani) and $array_ani > 0){
				 for ($i = 0; $i < count($array_ani); $i++)  
                  {
                    if  ($array_ani[$i]['collor']=='1') {$tablesorter_collor = 'tablesorterani_collor_1';}
                    else{$tablesorter_collor = 'tablesorterani_collor_2';}
					$checkID=$i+1;
                    ?>
                      <tr >
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['ID']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['ID_USER']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['LOGIN']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['ID_ANIMAL']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['NAME']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['ID_REQUEST_TYPE']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['REQUEST_DATE']?></td>
                        <td id=""><input type="checkbox" id="<?=$checkID?>" name="dell_err[]" value="<?=$array_ani[$i]['ID']?>" /></td>
                      </tr>
				 <?}};
                ?>
            </tbody></table>
            <input type="submit" name="formSubmit" value="Удалить отмеченные" />
         </form>
    </div>
</div>

</body>
</html>
<?exit;?>


