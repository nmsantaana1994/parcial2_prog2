<?php

class Categoria {

    private $id;
    private $categoria;
    
    /**
     * Devuelve los datos de una categoria en particular
     * @param int $id El id único de la marca
     */
    public function get_x_id(int $id): ?Categoria {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM categoria WHERE id = $id";

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
     * Obtiene el valor de categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
