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
//$sql_animals = "SELECT * `animals`";
//--------------------------------------------------------------------------------------------
   $result_ani = mysqli_query($db, "SELECT a.`ID` ID, 
                                                a.`NAME` NAME,
                                                a.`IMAGE` IMAGE,
                                                a.`TYPE` TAPE,
                                                a.`DESCRIPTION` DESCRIPTION
                                        FROM `animals` a
                                        ");
    if ($result_ani){
        if (mysqli_num_rows($result_ani)>0){ //Если выборка удачна
            $array_ani = array();
			$row_ani = array();
            $arr_ani = 0;
			$collor = 1;
            //------------------------------------
			while ($row_ani = mysqli_fetch_array($result_ani)) //перебор
            {
				$array_ani[$arr_ani] = (array('ID'=>$row_ani['ID'],
                                                'NAME'=>$row_ani['NAME'],
                                                'IMAGE'=>$row_ani['IMAGE'],
                                                'TAPE'=>$row_ani['TAPE'],
                                                'DESCRIPTION'=>$row_ani['DESCRIPTION'],
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
               if(nodes[i].id==i){
                nodes[i].checked = check;
               }
            }
        }
</script>
<?include ($tn_root_path . '/admin/includes/toolbar.php');?>
<div class="center_column_admin">
    <div class="container_admin">
        <form action="../admin/proc/animals.php" method="post">
        <h2><input type="Checkbox" onclick="CheckAll_id(this.checked)" /> Отметить все</h2>
            <table id="myTable" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        	<thead>
        		<tr>
                    <th class="header tablesorter_200">ID</th>
                    <th class="header tablesorter_200">NAME</th>
                    <th class="header tablesorter_200">IMAGE</th>
                    <th class="header tablesorter_200">TAPE</th>
                    <th class="header tablesorter_200">DESCRIPTION</th>

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
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['NAME']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['IMAGE']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['TAPE']?></td>
                        <td class="th_right_ani" id="<?=$tablesorter_collor?>"><?=$array_ani[$i]['DESCRIPTION']?></td>
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


