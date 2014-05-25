<?php

class db_functions {
    private static function db_Connect()
    {
        $db = new PDO('mysql:host=localhost;dbname=dashboard', 'root', '');
        
        return $db;
    }
    
    private static function checkAndOr($con)
    {
        if ($con == "and" || $con == "or") {
            return $con;
        }
        
        return false;
    }
    
    private static function setUpWhereStmt($conditions, $ao)
    {
        $ao = db_functions::checkAndOr($ao);
        if($ao == false) {
            return "error";
        }
        
        $where = "";
        $options = array();
        
        foreach ($conditions as $key => $value) {
            $options[] = $value;
            
            if ($where == "") {
                $where = "{$key} = ? ";
            } else {
                $where .= " {$ao} {$key} = ?";
            }
        }
        
        $result = array('options' => $options, 'queryPart' => $where);
        
        return $result;
    }
    
    private static function setUpIntoStmt($data)
    {
        $fieldNames = array();
        $options = array();
        
        $questionMarks = "";
        $fields = "";
        
        foreach ($data as $key => $value) {
            $fieldNames[] = $key;
            
            $options[] = $value;
            
            if ($questionMarks == "") {
                $questionMarks = "?";
            } else {
                $questionMarks .= ", ?";
            }
        }
        
        foreach ($fieldNames as $value) {
            if ($fields == "") {
                $fields = $value;
            } else {
                $fields .= ", {$value}";
            }
        }
        
        $result = array('options' => $options, 'fields' => $fields, 'queryPart' => $questionMarks);
        
        return $result;
    }
    
    private static function setUpSetStmt($data)
    {
        $set = "";
        $options = array();
        
        foreach ($data as $key => $value) {
            $options[] = $value;
            
            if ($set == "") {
                $set = "{$key} = ?";
            } else {
                $set .= ", {$key} = ?";
            }
        }
        
        $result = array('options' => $options, 'queryPart' => $set);
        
        return $result;
    }
    
    public static function db_select($table, $conditions, $ao = "and")
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $select = $db->prepare("SELECT * FROM {$table} WHERE {$where['queryPart']}");
        $select->execute($where['options']);
        
        $result = $select->fetchAll();
        
        return $result;
    }
    
    public static function db_insert($table, $data)
    {
        $db = db_functions::db_Connect();
        
        $data = db_functions::setUpIntoStmt($data);
        
        $insert = $db->prepare("INSERT INTO $table ({$data['fields']}) VALUES ({$data['queryPart']})");
        $insert->execute($data['options']);
        
        $rows = $insert->rowCount();
        
        return !!$rows;
    }
    
    public static function db_update($table, $data, $conditions, $ao = "and")
    {
        $db = db_functions::db_Connect();
        
        $data = db_functions::setUpSetStmt($data);
        
        $where = db_functions::setUpWhereStmt($conditions, $ao = "and");
        
        $options = array_merge($data['options'], $where['options']);
        
        $update = $db->prepare("UPDATE {$table} SET {$data['queryPart']} WHERE {$where['queryPart']}");
        $update->execute($options);
        
        $rows = $update->rowCount();
        
        return !!$rows;
    }
    
    public static function db_delete($table, $conditions, $ao = "and")
    {
        $db = db_functions::db_Connect();
        
        $where = db_functions::setUpWhereStmt($conditions, $ao);
        
        $delete = $db->prepare("DELETE FROM {$table} WHERE {$where['queryPart']}");
        $delete->execute($where['options']);
        
        $row = $delete->rowCount();
        
        return !!$row;
    }
    
    public static function db_query($query)
    {
        $db = db_functions::db_Connect();
        
        $qry = $db->prepare($query);
        $qry->execute();
        $result = $qry->fetchAll();
        
        return $result;
    }
}