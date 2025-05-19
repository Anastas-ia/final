<?php
require($_SERVER['DOCUMENT_ROOT'].'/libs/variables.php');
include($tn_root_path.'/libs/db.php');
include($tn_root_path.'/libs/avtoriz.php');

$sql = "SELECT * FROM animals";
$result = $db->query($sql);


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
    <!-- Главный баннер -->
    <?include ($tn_root_path.'/includes/baner_main.php');?>
    <!-- Модальное окно карточки -->
    <div id="animalModal" class="animal-modal">
        <div class="animal-modal-content" id="modalContent">
            <span class="close-modal" id="closeModal">&times;</span>
        </div>
    </div>

    <!-- Галерея -->
    <section id="gallery" class="gallery-wrap" style="background: rgb(249, 249, 249);">
        <div class="container">
            <h2 class="section-title">Галерея животных</h2>
            <div class="gallery">
                <? 
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<a href='".$uri."/to_take.php?animal=".$row["ID"]."' class='nav-link'>";
                            echo "<div class='animal-card'>";
                            echo "<img src='" . $row["IMAGE"] . "' alt='" . $row["NAME"] . "'>";
                            echo "<h3>" . $row["NAME"] . "</h3>";
                            echo "<p>" . $row["TYPE"] . "</p>";
                            echo "<p>" . $row["DESCRIPTION"] . "</p>";
                            echo "</div>";
                            echo "</a>";        
                        }
                    } else {
                        echo "Нет животных.";
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Контакты -->
    <?include ($tn_root_path.'/includes/footer.php');?>

</body>
</html>
<?exit;?>