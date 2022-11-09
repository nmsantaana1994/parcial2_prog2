<?php

class Producto {

    private $id;
    private $modelo;
    private $marca_id;
    private $descripcion;
    private $precio;
    private $foto;

    private $creacionValores = ["id","modelo","marca_id","descripcion","precio","foto"];


    /**
     * Devuelve una instancia del objeto Producto, con todas sus propiedades configuradas
     * @return Producto
     */
    public function crearProducto($datosProducto): Producto {
        $producto = new self();

        foreach ($this->creacionValores as $value){
            $producto->{$value} = $datosProducto[$value];
        }

        return $producto;
    } 

    /**
     * Devuelve el catálogo completo de productos
     */
    public function catalogo_completo(): array {
        $catalogo = [];

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM bicicletas";
        
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        while ($result = $PDOStatement->fetch()){
            $catalogo[]= $this->crearProducto($result);
        }

        //$catalogo = $PDOStatement->fetchAll();

        return $catalogo;

    }

    /**
     * Devuelve el catalogo de un grupo de productos en particular
     * @param int $id El id de la bici a buscar
     * @return Producto[] Un Array lleno de instancias de objeto Producto
     */
    function catalogo_x_producto(int $id): array{
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM bicicletas WHERE id = $id";

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
    function producto_x_id(int $idProducto): ?Producto{

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM bicicletas WHERE id = $idProducto";

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
     * Obtiene el valor del nombre de la marca
     */ 
    public function getMarca()
    {
        $marca = (new Marca())->get_x_id($this->marca_id);
        $nombre = $marca->getNombre();
        return $nombre;
    }

    /**
     * Obtiene el valor del logo de la marca
     */ 
    public function getLogo_Marca()
    {
        $marca = (new Marca())->get_x_id($this->marca_id);
        $logo = $marca->getLogo();
        return $logo;
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