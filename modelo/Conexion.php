<?php
class Conexion
{
     private $servidor = "ftp.dimerlyn.com";
     private $db = "dimerlyn_bdmerlyn";
     private $puerto = 3306;
     private $charset = "utf8";
     private $usuario = "dimerlyn_dimerlyn";
     private $contrasena = "Maau09231999";
     public $pdo = null;
     private $atributos = [PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
     //PDO:FETCH_PBJ -> retorna obejtos en la consulta
     //PDO-> Definicion google/barra de favoritos/desarrolloweb 
     function __construct()
     {
          $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto}; charset->{$this->charset}", $this->usuario, $this->contrasena, $this->atributos);
     }
}
?>