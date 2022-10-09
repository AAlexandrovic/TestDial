<?php



class database
{
    public $pdo;
    function connection()
    {
        $host = '127.0.0.1'; //HOST NAME.
        $db_name = '*****'; //Database Name
        $db_username = '*****'; //Database Username
        $db_password = '*******; //Database Password

        try
        {
            $this->pdo = new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
        }

        catch
        (PDOException $e)
        {
            exit('Error Connecting To DataBase');
        }
    }
}

require_once 'inserttable.class.php';


