<?php

class Conexion{

    public const DB_SERVER = "localhost";
    public const DB_USER = "root";
    public const DB_PASS = "";
    public const DB_NAME = "bmx_street";
    public const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    protected PDO $db;

    public function __construct(){

        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              ));
        } catch (Exception $e) {
            die('Error al intentar conectar con la base de datos MySQL.');
        }

    }

    /**
     * Función que devuelve una conexión PDO lista para usar
     * @return PDO
     */
    public function getConexion(): PDO{
        return $this->db;
    }

}