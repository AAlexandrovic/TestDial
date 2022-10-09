<?php
require_once 'backend.php';
class Select extends database
{
    /////Отрисовка шапки таблицы
    private function columns()
    {
        echo ' </th>
            <th scope="col" colspan="3">Капельница</th>
            <th scope="col" colspan="3">Дренаж</th>
            <th scope="col"colspan="2">Мат</th>
        </tr>
        </thead>
        <thead>
        <tr>
            <th scope="col">№ Клапана топлива</th>
            <th scope="col">Объём</th>
            <th scope="col">ЕС</th>
            <th scope="col">pH</th>
            <th scope="col">Объём</th>
            <th scope="col">ЕС</th>
            <th scope="col">pH</th>
            <th scope="col">ЕС</th>
            <th scope="col">pH</th>
            <th scope="col">Выполнил</th>
            <th scope="col">Время</th>
        </tr>
        </thead>
        <tbody>';
    }
    //функция выбора департамента
    private function deparmtmentsname($val){
        echo '  <table class="table table-bordered">
        <thead>
        <tr><th scope="col"> '; switch ($val) {
            case 1:
                echo "Отделение: 1.1";
                break;
            case 2:
                echo "Отделение: 1.2";
                break;
            case 3:
                echo "Отделение: 1.4";
                break;
            case 4:
                echo "Отделение: 1.5";
                break;
        }
    }

    /////Вывод всех данных в таблицу
   private function iteration($val1,$val2)
    {
        for ($i = 1; $i <= 6; $i++) {
//
            $com = $this->pdo->prepare('SELECT * FROM indicators i
            LEFT JOIN relations as r ON i.md_5 = r.m5_id
            RIGHT JOIN departments as d ON r.id_department = d.id
            WHERE  '.$val1.' valve = ' . $i . ' AND DATE(`Date`) = ?
            ');

            $com->bindParam(1, $val2, PDO::PARAM_STR);
            $com->execute();

            while ($comments = $com->fetch()) {


                echo  "<tr> <th scope='row'>{$comments['valve']}</th><td>{$comments['droper_size']}</td>

<td>{$comments['droper_EC']}</td><td>{$comments['droper_PH']}</td><td>{$comments['drain_size']}</td><td>{$comments['drain_EC']}</td>



<td>{$comments['drain_PH']}</td><td>{$comments['mat_EC']}</td><td>{$comments['mat_PH']}</td><td>{$comments['acess_name']}</td>" . "<td>" . substr($comments['Time'], 10) . "</td></tr>";
            }
        }
        echo '</tbody>
        </table>';
    }

    /////собираем вместе все используемые функции
    function show($department = 1, $date = '2022-10-07')
    {
        $this->connection();

        if($department==0 ) {
            for($t=1;$t<5;$t++) {
                //$str_depsartment = '';

                $str_depsartment='id_department=' . $t . ' AND';


                $this->deparmtmentsname($t);


                $this->columns();


                $this->iteration($str_depsartment,$date);

            }

        }else{
            $str_depsartment='id_department=' . (int)$department . ' AND';

            $this->deparmtmentsname($_REQUEST['department']);

            $this->columns();

            $this->iteration($str_depsartment,$date);

        }
    }

}
