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
    $results= $this->execute($sql)->first();
    return $results;
  }
}