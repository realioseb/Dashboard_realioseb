<?php

namespace Database\Controller;

use Silex\Application;

class DatabaseManager
{
    private $db;

    public function __construct(Application $app)
    {
        $this->db = $app['db'];
    }
    
    private function checkAndOr($con)
    {
        if ($con == "and" || $con == "or") {
            return $con;
        }
        
        return false;
    }
    
    private function setUpWhereStmt($conditions, $ao, Application $app)
    {
        $ao = $app['database.abstraction']->checkAndOr($ao);
        
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
    
    private function setUpIntoStmt($data)
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
    
    private function setUpSetStmt($data)
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
    
    public function db_select($table, $conditions, Application $app, $ao = "and")
    {
        $db = $this->db;
        
        $where = $app['database.abstraction']->setUpWhereStmt($conditions, $ao, $app);
        
        $select = $db->prepare("SELECT * FROM {$table} WHERE {$where['queryPart']}");
        $select->execute($where['options']);
        
        $result = $select->fetchAll();
        
        return $result;
    }
    
    public function db_insert($table, $data, Application $app)
    {
        $db = $this->db;
        
        $data = $app['database.abstraction']->setUpIntoStmt($data);
        
        $insert = $db->prepare("INSERT INTO $table ({$data['fields']}) VALUES ({$data['queryPart']})");
        $insert->execute($data['options']);
        
        $rows = $insert->rowCount();
        
        return !!$rows;
    }
    
    public function db_update($table, $data, Application $app, $conditions, $ao = "and")
    {
        $db = $this->db;
        
        $data = $app['database.abstraction']->setUpSetStmt($data);
        
        $where = $app['database.abstraction']->setUpWhereStmt($conditions, $app, $ao);
        
        $options = array_merge($data['options'], $where['options']);
        
        $update = $db->prepare("UPDATE {$table} SET {$data['queryPart']} WHERE {$where['queryPart']}");
        $update->execute($options);
        
        $rows = $update->rowCount();
        
        return !!$rows;
    }
    
    public function db_delete($table, $conditions, Application $app, $ao = "and")
    {
        $db = $app['database.abstraction']->db_Connect();
        
        $where = $app['database.abstraction']->setUpWhereStmt($conditions, $app, $ao);
        
        $delete = $db->prepare("DELETE FROM {$table} WHERE {$where['queryPart']}");
        $delete->execute($where['options']);
        
        $row = $delete->rowCount();
        
        return !!$row;
    }
    
    public function db_query($query, Application $app)
    {
        $db = $this->db;
        
        $qry = $db->prepare($query);
        $qry->execute();
        $result = $qry->fetchAll();
        
        return $result;
    }

}
