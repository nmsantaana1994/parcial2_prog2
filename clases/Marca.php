<?php

class Marca {

    private $id;
    private $nombre;
    private $ano;
    private $logo;

    /**
     * Devuelve los datos de una marca en particular
     * @param int $id El id único de la marca
     */
    public function get_x_id(int $id): ?Marca {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM marca WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $resultado = $PDOStatement->fetch();

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    /**
     * Obtiene el valor de id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Obtiene el valor de nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene el valor de ano
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Obtiene el valor de logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

}