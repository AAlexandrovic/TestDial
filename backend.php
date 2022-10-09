<?php



class database
{
    public $pdo;
    function connection()
    {
        $host = '127.0.0.1'; //HOST NAME.
        $db_name = 'shopbd'; //Database Name
        $db_username = 'new_app'; //Database Username
        $db_password = '4953133773dom'; //Database Password

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


