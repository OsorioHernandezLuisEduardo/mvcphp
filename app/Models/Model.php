<?php
namespace app\Models;

use mysqli;
class Model{
  protected $db_host = 'localhost';
  protected $db_user = 'root';
  protected $db_pass = '';
  protected $db_database = 'cars';
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
}