<?php

/**
 * Database class
 */
class Database
{
    private function connect()
    {
        $DB_HOST = 'localhost';
        $DB_NAME = 'pos_desktop';
        $DB_USER = 'root';
        $DB_PWD = '';
        $DB_DRIVER = 'mysql';

        try {
            // we use php data objects to connect PDO
            $db_string = "$DB_DRIVER:host=$DB_HOST;dbname=$DB_NAME";

            $link = new PDO($db_string, $DB_USER, $DB_PWD); //create an instance
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $link;
    }

    public function query($query, $data = [])
    {
        $conn = $this->connect();

        // prepare a stmt
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);

        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (is_array($result) && count($result) > 0) {
                return $result;
            }
        }
        return false;
    }
}