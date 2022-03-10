<?php

/**
 *
 */
class Model extends Database
{
    protected function getAllowedColumns($data)
    {
        if (!empty($this->allowed_columns)) {
            foreach ($data as $key => $value) {
                // check if key is in columns arr
                if (!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }
        
        return $data;
    }

    public function insert($data)
    {
        $clean_arr = $this->getAllowedColumns($data, $this->table);

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
    
    public function getSingle($data)
    {
        $keys = array_keys($data);

        $sql= "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $sql .= "$key = :$key && ";
        }
        $sql = trim($sql, "&& ");

        $DB = new Database();

        if($result = $DB->query($sql, $data)){
            return $result[0];
        }

        return false;
    }
}