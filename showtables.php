<?php
///функция подзагрузки всех классов
function load( $class ) {
    $file = $class . '.class.php';
    if (is_file($file)) {
        require_once($file);
    }
}

spl_autoload_register( 'load' );
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Итог</title>

        <link href="bootstrap.min.css" rel="stylesheet">
    </head><!--/head-->
    <body>
    <form>

    <select name="department">
        <option value="0">Все департаменты</option>
        <?php

        $select = new Select();
        //вызов метода коннекта с БД
        $select->connection();

        $query = "SELECT * FROM departments";
    /////выбор отделения
        $com = $select->pdo->query($query);
        while ($comments = $com->fetch()) {


            echo
            "<option value='{$comments['id']}'>Отделение:{$comments['name']}</option> ";
        }

echo '  </select>
    <select name="date">';

////отображение всех дат из бд для выбора в итоговой таблице
$query = "Select distinct Date from relations";
$com = $select->pdo->query($query);
while ($comments = $com->fetch()) {



    if(empty(@$_REQUEST['date'])) {
        echo
        "<option value='{$comments['Date']}'>{$comments['Date']}</option> ";
    }else{
        echo
        "<option value='{$comments['Date']}'"; if($comments['Date'] == $_REQUEST['date']){ echo "selected";} echo ">{$comments['Date']}</option> ";
    }


}
?>

    </select>
    <input type="submit">
    </form>

<?php


////вывести таблицы
$select->show(@$_REQUEST['department'],@$_REQUEST['date']);

?>

<script src="jquery.js"></script>
<script src="bootstrap.min.js"></script>
<script src="script.js"></script>
    </body>
</html>
