<?php

class Repuestos {

    private $id;
    private $categoria_id;
    private $modelo;
    private $marca_id;
    private $descripcion;
    private $precio;
    private $foto;

    /**
     * Devuelve el catálogo completo de productos
     */
    public function catalogo_completo(): array {

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM repuestos";
        
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;

    }

    /**
     * Devuelve el catalogo de un grupo de productos en particular
     * @param int $id El id del repuesto a buscar
     * @return Repuestos[] Un Array lleno de instancias de objeto Repuestos
     */
    function catalogo_x_producto(int $id): array{
        
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM repuestos WHERE categoria_id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;

    }

    /**
     * Devuelve los datos de un producto en particular
     * @param int $idProducto El ID único del producto a mostrar
     */
    function producto_x_id(int $idProducto): ?Repuestos{

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM repuestos WHERE id = $idProducto";

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
     * Esta función devuelve las primeras x palabras de un párrafo
     * @param int $cantidad Esta es la cantidad de palabras a extraer (Opcional)
     */
    function recortar_palabras(int $cantidad = 22):string{

        $texto = $this->descripcion;

        $array = explode(" ", $texto);
        if (count($array)<=$cantidad)
        {
            $resultado = $texto;
        }
        else
        {
            array_splice($array, $cantidad);
            $resultado = implode(" ", $array)."...";
        }

        return $resultado;

    }

    /**
     * Devuelve el precio de la unidad, formateado correctamente
     */
    public function precio_formateado(): string {
        return number_format($this->precio, 2, ",", ".");
    }

    /**
     * Obtiene el valor de id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Obtiene el valor de categoria_id
     */
    public function getCategoria()
    {
        $categoria = (new Categoria())->get_x_id($this->categoria_id);
        $nombre = $categoria->getCategoria();
        return $nombre;
    }

    /**
     * Obtiene el valor de marca_id
     */ 
    public function getMarca()
    {
        $marca = (new Marca())->get_x_id($this->marca_id);
        $nombre = $marca->getNombre();
        return $nombre;
    }

    /**
     * Obtiene el valor de modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Obtiene el valor de descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene el valor de precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Obtiene el valor de foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }
}

?>