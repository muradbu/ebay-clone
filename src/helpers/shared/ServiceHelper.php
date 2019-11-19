<?php

class Service
{
    
    public function get($table, $id, $column = "id")
    {
        
        $sql = "select * from $table where $column = $id";
        
    }
    
    public function query($table)
    {
        
        $sql = "select * from $table";
        
    }
    
    public function post($table, $model)
    {
        
        $columns = implode(',', array_keys($model));
        $values  = implode(',', $model);
        
        $sql = "insert into $table ($columns) values $values";
        
    }
    
    public function put($table, $model, $column, $id)
    {
        
        $values = "TODO";
        
        $sql = "update $table set $values where $column = $id";
        
    }
    
    public function delete($table, $column, $id)
    {
        
        $sql = "delete from $table where $column = '$id'";
        
    }
    
}

?>