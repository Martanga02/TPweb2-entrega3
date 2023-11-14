<?php

require_once 'src/models/Model.php';

class ProductoModel extends Model
{
    function getProducto($order, $field, $filterBy, $filterValue, $limit, $offset)
    {
        $sql = "SELECT producto.*, categoria.CATEGORIA as role FROM producto JOIN role ON producto.IDcategoria=categoria.IDcategoria";

        switch($filterBy){
            case 'Camioneta':
                $sql .= ' WHERE Camioneta = ' . '\''. $filterValue.'\'';
                break;
            case 'Auto':
                $sql .= ' WHERE Auto = ' . '\''. $filterValue.'\'';
                break;
            case 'Moto':
                $sql .= ' WHERE Moto = ' . '\''. $filterValue.'\'';
                break;
            default:
                $sql .= ' ';
                break;
        }

        switch($order){
            case 'ASC':
                $sql .= ' ORDER BY ' . $field . ' ASC';
                break;
            case 'DESC':
                $sql .= ' ORDER BY ' . $field . ' DESC';
                break;
            default:
                $sql .= ' ORDER BY PRODUCTOS ASC';
                break;
        }

        if($limit != 'null'){
            $sql .= ' LIMIT ' . $limit;
        }

        if($offset != 'null'){
            $sql .= ' OFFSET ' . $offset;
        }
        
        $query = $this->db->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getProductoById ($IDproducto) {
        $query = $this->db->prepare('SELECT producto.*, categoria.CATEGORIAS as role FROM producto JOIN role ON producto.IDcategoria=categoria.IDcategoria WHERE id = ?');
        $query->execute([$IDproducto]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertProducto($PRODUCTOS, $Precio, $IDcategoria)
    {
        $query = $this->db->prepare('INSERT INTO producto (IDproducto,PRODUCTOS,Precio,IDcategoria) VALUES(null,?,?,?)');
        $query->execute([$PRODUCTOS, $Precio, $IDcategoria]);

        return $this->db->lastInsertId();
    }

    function deleteProducto($IDproducto)
    {
        $query = $this->db->prepare('DELETE FROM producto WHERE IDproducto = ?');
        $query->execute([$IDproducto]);
    }

    function updateProducto($IDproducto,$PRODUCTOS, $Precio, $IDcategoria)
    {
        $query = $this->db->prepare('UPDATE producto SET PRODUCTOS = ?, Precio = ?, description = ?, IDcategoria = ? WHERE IDproducto = ?');
        $query->execute([$PRODUCTOS, $Precio, $IDcategoria,$IDproducto]);
    }

}