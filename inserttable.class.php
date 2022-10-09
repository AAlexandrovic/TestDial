<?php

////запуск класса только в случае отправки данных

if(count($_POST)>0) {
    $test = new insert($_POST);


}

class insert extends database
{

    function __construct(...$number)
    {


        $this->connection();

        try {

            $md5=md5(microtime());
            $md5_new = substr($md5, 0,-28);
///////////////////добавление через транзакции, что-бы избежать сбивания md5 кода используемый для объединения таблицы
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->beginTransaction();

            /////////добавление в таблицу основных показателей
            $query = "INSERT INTO indicators(droper_size, droper_EC, droper_PH, drain_size, drain_EC, drain_PH, mat_EC, mat_PH, md_5) VALUES ( :1_size, :1_PH,:1_EC,:2_size,:2_PH,:2_EC,:3_EC,:3_PH,:md_5)";

            $usr = $this->pdo->prepare($query);
            $params = [];
            foreach ($number as $num) {
                $params = [
                    '1_size' =>  (string)$num['1_size'],
                    '1_PH' => (string)$num['1_PH'],
                    '1_EC' =>(string)$num['1_EC'],
                    '2_size' => (string)$num['2_size'],
                    '2_PH' => (string)$num['2_PH'],
                    '2_EC' => (string)$num['2_EC'],
                    '3_EC' => (string)$num['3_EC'],
                    '3_PH' => (string)$num['3_PH'],
                    'md_5' => $md5_new

                ];
            }
            $usr->execute($params);
///
            $time = microtime(true);
         ///////////////// вторая таблица содержит время добавления, дату, клапан и id департамента
            $date = date('Y-m-d', $time);
            $query2 = "INSERT INTO relations(m5_id, valve, id_department, Date, acess_name) VALUES ( :md5_id, :valve,:id_department,:date,:name)";

            // A set of queries; if one fails, an exception should be thrown
            $usr = $this->pdo->prepare($query2);
            $params = [];
            foreach ($number as $num) {
                $params = [
                    'md5_id' => $md5_new,
                    'valve' => (int)$num['valve_number'],
                    'id_department' => (int)$num['department_number'],
                    'date' => $date,
                    'name' => $num['name']

                ];
            }
            $usr->execute($params);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            echo "Ошибка: " . $e->getMessage();
        }


    }

}
