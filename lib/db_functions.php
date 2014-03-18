<?php
class db_functions {
    private function db_Connect()
    {
        $db = new PDO('mysql:host=localhost;dbname=dashboard', 'root', '');
        
        return $db;
    }
    
    private function setUpAndOr($andOR = true)
    {
        if (is_bool($andOR) && $andOR == true) {
            $andOR = "AND";
        } else if (is_bool($andOR) && $andOR == false) {
            $andOR = "OR";
        } else {
            return false;
        }
        
        return $andOR;
    }
    
    private function setUpWhereStmt($conditions, $ao = true)
    {
        $ao = db_functions::setUpAndOr($ao);
        if($ao == false) {
            return "error";
        }
        
        $where = "";
        $options = array();
        
        foreach ($conditions as $key => $value) {
            $options[] = $key;
            
            $options[] = $value;
            
            if ($where == "") {
                $where = "? = ? ";
            } else {
                $where .= " {$ao} ? = ?";
            }
        }
        
        $result = array('options' => $options, 'where' => $where);
        
        return $result;
    }
    
    private function setUpData($data)
    {
        $fieldNames = array();
        $sqlValues = array();
        
        $questionMarks = "";
        
        foreach ($data as $key => $value) {
            $fieldNames[] = $key;
            
            $sqlValues[] = $value;
            
            if ($questionMarks == "") {
                $questionMarks = "?";
            } else {
                $questionMarks .= ", ?";
            }
        }
        
        $options = array_merge($fieldNames, $sqlValues);
        
        $result = array('qMarks' => $questionMarks, 'options' => $options);
        
        return $result;
    }
    
    private function setUpSetStmt($data)
    {
        $set = "";
        $options = array();
        
        foreach ($data as $key => $value) {
            $options[] = $key;
            
            $options[] = $value;
            
            if ($set == "") {
                $set = "? = ?";
            } else {
                $set .= ", ? = ?";
            }
        }
        
        $result = array('options' => $options, 'set' => $set);
        
        return $result;
    }
    
    public function db_select($table, $conditions, $ao = true)
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $select = $db->prepare("SELECT * FROM {$table} WHERE {$where['where']}");
        $select->execute($where['options']);
        
        
        $result = $select->fetchAll();
        
        return $result;
    }
    
    public function db_insert($table, $data)
    {
        $db = db_functions::db_Connect();
        
        $data = db_functions::setUpData($data);
        
        $insert = $db->prepare("INSERT INTO $table ({$data['qMarks']}) VALUES ({$data['qMarks']})");
        $insert->execute($data['options']);
        
        $rows = $insert->rowCount();
        
        return !!$rows;
    }
    
    public function db_update($table, $data, $conditions, $ao = true)
    {
        $db = db_functions::db_Connect();
        
        $data = db_functions::setUpSetStmt($data);
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $options = array_merge($data['options'], $where['options']);
        
        $update = $db->prepare("UPDATE {$table} SET {$where['where']} WHERE {$where['where']}");
        $update->execute($options);
        
        $rows = $update->rowCount();
        
        return !!$rows;
    }
    
    public function db_delete($table, $conditions, $ao = true)
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        return "DELETE FROM {$table} WHERE {$where['where']}";
//        $delete = $db->prepare("DELETE FROM {$table} WHERE {$where['where']}");
//        $delete->execute($where['options']);
//        
//        $row = $delete->rowCount();
//        
//        return !!$row;
    }
    
    public function db_query($query)
    {
        $db = db_functions::db_Connect();
        
        $qry = $db->prepare($query);
        $qry->execute();
        $result = $qry->fetchAll();
        
        return $result;
    }
}