<?php

/**
 *
 */
class Model extends Database
{

    public function insert($data,)
    {
        $clean_arr = allowedColumns($data, $this->table);

        $keys = array_keys($clean_arr);

        $sql= "INSERT INTO $this->table ";
        $sql .= "(". implode(',', $keys) .") VALUES (:";
        $sql .= implode(',:', $keys) .")";
    
        $DB = new Database();
        $DB->query($sql, $clean_arr);
    }

    public function where($data)
    {
        $keys = array_keys($data);

        $sql= "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $sql .= "$key = :$key && ";
        }
        $sql = trim($sql, "&& ");

        $DB = new Database();

        return $DB->query($sql, $data);
    }
}
