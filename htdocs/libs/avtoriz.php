<?php
// ����� �������� ���� � ���������� � ��������� ��������� � ����
if (isset($_COOKIE['token']) ) // ����������� �� ����������
{
    $tokenuser = htmlspecialchars($_COOKIE['token']); // �� ������ ��.
    $res_t = mysqli_query($db, "SELECT `COLLECTION_ID` FROM `tokens` WHERE `TOKEN`='$tokenuser'");
    $tok_id = mysqli_fetch_assoc($res_t);
    $get_id = $tok_id['COLLECTION_ID'];

    $res = mysqli_query($db, "SELECT `ID`, `LOGIN`, `ROLE`
                                FROM `users` WHERE `ID`='$get_id'");
    $user = mysqli_fetch_assoc($res);
    
    if (mysqli_num_rows($res) < 1)
    {
      setcookie('token', '', 0,'/'); //�������� �������� � ����� �����
    }
}
?>