<?php
namespace app\Models;

use mysqli;
class Model{
  protected $db_host = DB_HOST;
  protected $db_user = DB_USER;
  protected $db_pass = DB_PASS;
  protected $db_database = DB_DATABASE;
  protected $table;

  protected $connection;
  protected $query;
  public function __construct()
  {
    $this->connection= new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_database);
    if($this->connection->error){
      die("error".$this->connection->error);
    }
  }
  public function execute($sql)
  {
    $this->query=$this->connection->query($sql);
    return $this;
  }
  public function get()
  {
    return $this->query->fetch_all(MYSQLI_ASSOC);
  }
  public function first()
  {
    return $this->query->fetch_assoc();
  }
  public function all()
  {
    $sql="SELECT * FROM {$this->table}";
    //$results= $this->connection->query($sql)->fetch_assoc();
    return $this->execute($sql)->get();
  }
  public function find($id)
  {
    $sql="SELECT * FROM {$this->table} WHERE id= {$id}";
    return $this->execute($sql)->first();
  }

  public function create($data)
  {
    //INSERT INTO table (column1, column2...) values ('value1','value2'...)
    $columns=array_keys($data);
    $columns= implode(',',$columns);

    $values=array_values($data);
    $values='\''.implode("','",$values).'\'';
    
    $sql= "INSERT INTO {$this->table} ({$columns}) values ({$values})";

    $this->execute($sql);
    $id= $this->connection->insert_id;
    return $this->find($id);
  }

  public function update($id, $data)
  {
    //update tabla set column1=value1 , column2=value2
    $campos=[];
    foreach ($data as $key => $value) {
      $campos[]="{$key}='{$value}'";
    }
    $campos= implode(', ',$campos);

    $sql="UPDATE {$this->table} SET {$campos} WHERE id= {$id}";
    $this->execute($sql);
    return $this->find($id);
  }

  public function delete($id)
  {
    $sql="DELETE FROM {$this->table} WHERE id = $id";
    $object= $this->find($id);
    $this->execute($sql);
    return $object;
  }
  public function where($column, $operator, $value = null)
  {
    if (!$value) {
      $value = $operator;
      $operator = '=';
    }
    $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
    $this->execute($sql);
    return $this;
  }
  public function hasMany($table, $id){
    $sql="SELECT * FROM {$table} where {$this->table}_id = {$id}";
    return $this->execute($sql)->get();
  }

  public function belongsTo($table,$foreignKey, $id){
    $object= $this->find($id);
    $foreign=$object[$foreignKey];
    $sql ="SELECT * FROM {$table} WHERE id={$foreign}";
    return $this->execute($sql)->first();
  }

  public function belongsToMany($table,$id){
    $tables=array($this->table,$table);
    sort($tables,SORT_STRING);

    $sql="SELECT {$table}.*  
          FROM  {$table} 
          INNER JOIN {$tables[0]}_{$tables[1]} on {$table}.id= {$tables[0]}_{$tables[1]}.{$table}_id
          INNER JOIN {$this->table} on {$tables[0]}_{$tables[1]}.{$this->table}_id={$this->table}.id
          WHERE {$this->table}.id={$id}";

    return $this->execute($sql)->get();
  }
}