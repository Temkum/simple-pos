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

    public function update($id, $data)
    {
       $clean_arr = $this->getAllowedColumns($data, $this->table);

        $keys = array_keys($clean_arr);

        $query = "UPDATE $this->table SET ";

        // loop to get column names
        foreach ($keys as $column) {
            $query .= $column . '=:' . $column . ',';
        }
        // get rid of commas at the end
        $query = trim($query, ',');

        // add where clause
        $query .= " WHERE id = :id";

        // add id to clean arr
        $clean_arr['id'] = $id;
    
        $DB = new Database();
        $DB->query($query, $clean_arr);
    }

    public function delete($id)
    {
       $query = "DELETE FROM $this->table WHERE id = :id LIMIT 1";

        // add id to clean arr
        $clean_arr['id'] = $id;
    
        $DB = new Database();
        $DB->query($query, $clean_arr);
    }
}