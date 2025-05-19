<?php
class classCheckAdmin {
    // Возвращает 1 если пользователь (`users`) входит в админы
    function checkAdmin($db, $user_id){
        $ret = '0';                
        if (isset($db) AND isset($user_id)){
        
            $result_acc = mysqli_query($db, "SELECT `ID`
                                        FROM `users` 
                                        WHERE  `ROLE` = 'admin'
                                            AND `ID` = ". $user_id ."
                                        ");
            if (mysqli_num_rows($result_acc)>0) // Если выборка успешна
            {
                $myrow_result = mysqli_fetch_assoc($result_acc);//Извлекаем данные пользователя с данным id
                if (!empty($myrow_result['ID'])) 
                {
                    $ret = '1';
                }
            }
            return $ret;
          }
        
        else{ 
          return $ret;
        }
      }
}

class classCheckVolunteer {
    // Возвращает 1 если пользователь (`users`) входит в волонтеры
    function checkVolunteer($db, $user_id){
        $ret = '0';
        if (isset($db) AND isset($user_id)){
            $result_acc = mysqli_query($db, "SELECT `ID`
                                        FROM `users` 
                                        WHERE  `ROLE` = 'volunteer'
                                            AND `ID` = ". $user_id ."
                                        ");
            if (mysqli_num_rows($result_acc)>0) // Если выборка успешна
            {
                $myrow_result = mysqli_fetch_assoc($result_acc);//Извлекаем данные пользователя с данным id
                if (!empty($myrow_result['ID'])) 
                {
                    $ret = '1';
                }
            }
            return $ret;
        }
        else{ 
          return $ret;
        }
      }
}
?>