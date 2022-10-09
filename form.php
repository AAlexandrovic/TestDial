<?php

require_once 'backend.php';
$database = new database;
$database->connection();

$query = "SELECT * FROM departments";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Добавить данные</title>


<link href="bootstrap.min.css" rel="stylesheet">
</head><!--/head-->
<body>
<form action="backend.php" method="POST" id="form">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingSelect">Выбор отделения</label>
        <select class="form-select" id="autoSizingSelect" name="department_number">
            <option selected>Выбрать отделение</option>
            <?php
            $com = $database->pdo->query($query);
            while ($comments = $com->fetch()) {


                echo
                    "<option value='{$comments['id']}'>{$comments['name']}</option> ";
            }
            ?>
        </select>
    </div>

    <?php
    ///выбор полей таблицы
    echo '<div class="col-auto">
        <label class="visually-hidden" for="autoSizingSelect">Выбор клапана</label>
        <select class="form-select" id="autoSizingSelectValve" name="valve_number">
            <option selected>Выбрать клапан</option>';
    for($i=1;$i<=6;$i++){
        echo '
            <option value="'.$i.'">'.$i.'</option>';
    }
    echo '</select>';

    for($i=1;$i<=3;$i++){
        if($i == 1){
            echo ' <div class="col-6">
            <label for="inputAddress" class="form-label"><h1>Капельница</h1></label>
        </div>';
            $number = 1;

        }elseif($i == 2){
            echo '<div class="col-6">
            <label for="inputAddress" class="form-label"><h1>Дренаж</h1></label>
        </div>';
            $number = 2;
        }elseif($i == 3){
            echo '   <div class="col-6">
            <label for="inputAddress" class="form-label"><h1>Мат</h1></label>
        </div>
        <div class="row mb-3">
            <label for="colFormLabel" class="col-sm-2 col-form-label">ЕС</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="colFormLabel" name="'.$i.'_EC">
            </div>
        </div>
        <div class="row mb-3">
            <label for="colFormLabel" class="col-sm-2 col-form-label">PH</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="colFormLabel" name="'.$i.'_PH">
            </div>
        </div>';
            break;
        }
        echo '   <div class="row mb-3">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Объём</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="'.$number.'_size">
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="colFormLabel" class="col-sm-2 col-form-label">ЕС</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="colFormLabel" name="'.$number.'_EC">
        </div>
    </div>
   
        <div class="row mb-3">
            <label for="colFormLabel" class="col-sm-2 col-form-label">PH</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="colFormLabel" name="'.$number.'_PH">
            </div>
        </div>';

    }

    ?>

    <div class="row mb-3">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Отчёт отправил:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="colFormLabel" name="name">
        </div>
    </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
</form>

<script src="jquery.js"></script>
<script src="bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
