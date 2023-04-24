<?php
namespace app\Models;

use mysqli;

class User 
{
  protected $db_host = 'localhost';
  protected $db_user = 'root';
  protected $db_pass = '';
  protected $db_database = 'cars';

  protected $connection;

  public function __construct()
  {
    $this->connection= new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_database);
  }
  public function all()
  {
    $sql='SELECT * FROM users';
    $results= $this->connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    return $results;
  }
}
