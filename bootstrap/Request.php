<?php
namespace bootstrap;
class Request {
  private $method;
  private $uri;
  private $query;
  private $headers;
  private $parameters;
  private $uploadedFile;
  private $formData;
  
  public function __construct() {
    //$data = json_decode(file_get_contents('php://input'));
    //$this->parameters = $data;

    $this->uploadedFile = $_FILES;
    $this->formData = $_POST;

    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->query = $_GET;
    $this->headers = getallheaders();
  }

  function getUploadedFile() {
    return $this->uploadedFile;
  }

  function getFormData() {
    if($this->method==='POST')
      return $this->formData;
    
    parse_str(file_get_contents('php://input'),$input);

    return $input;
  }


  public function getMethod() {
    return $this->method;
  }

  public function getUri() {
      return $this->uri;
  }

  public function getQuery() {
      return $this->query;
  }

  public function getHeaders() {
      return $this->headers;
  }  
  public function getParameter($name, $default = null) {
    return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
  }
  
}
