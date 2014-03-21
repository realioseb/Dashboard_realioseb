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
            return null;
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
        
        $result = array('options' => $options, 'queryPart' => $where);
        
        return $result;
    }
    
    private function setUpIntoStmt($data)
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
        
        $result = array('options' => $options, 'queryPart' => $questionMarks);
        
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
        
        $result = array('options' => $options, 'queryPart' => $set);
        
        return $result;
    }
    
    public function db_select($table, $conditions, $ao = true)
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $select = $db->prepare("SELECT * FROM {$table} WHERE {$where['queryPart']}");
        $select->execute($where['options']);
        
        
        $result = $select->fetchAll();
        
        return $result;
    }
    
    public function db_insert($table, $data)
    {
        $db = db_functions::db_Connect();
        
        $data = db_functions::setUpIntoStmt($data);
        
        $insert = $db->prepare("INSERT INTO $table ({$data['queryPart']}) VALUES ({$data['queryPart']})");
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
        
        $update = $db->prepare("UPDATE {$table} SET {$data['queryPart']} WHERE {$where['queryPart']}");
        $update->execute($options);
        
        $rows = $update->rowCount();
        
        return !!$rows;
    }
    
    public function db_delete($table, $conditions, $ao = true)
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $delete = $db->prepare("DELETE FROM {$table} WHERE {$where['queryPart']}");
        $delete->execute($where['options']);
        
        $row = $delete->rowCount();
        
        return !!$row;
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