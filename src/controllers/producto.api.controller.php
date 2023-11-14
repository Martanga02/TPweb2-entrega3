<?php 
    require_once 'src/models/producto.model.php';
    require_once 'src/controllers/api.controller.php';

    class ProductoApiController extends ApiController{
        private $productoModel;
        public function __construct(){
            parent::__construct();
            $this->productoModel = new productoModel();
        }

        public function get($params = []){
            if (empty($params)){
                $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';
                $field = isset($_GET['field']) ? strtolower($_GET['field']) : 'producto';
                $filterBy = isset($_GET['filterBy']) ? strtolower($_GET['filterBy']) : 'null';
                $filterValue = isset($_GET['filterValue']) ? ucfirst($_GET['filterValue']) : 'null';
                $limit = isset($_GET['limit']) ? ($_GET['limit']) : 'null';
                $offset = isset($_GET['offset']) ? ($_GET['offset']) : 'null';
                
                $productos = $this->productoModel->getproducto($order, $field, $filterBy, $filterValue, $limit, $offset);
                $this->view->response($productos, 200);    
            } else {
                $producto = $this->productoModel->getproductoById($params[':ID']);
                if(!empty($producto)){
                    if(!empty($params[':subrecurso'])){
                        switch($params[':subrecurso']){
                            case 'PRODUCTOS':
                                $this->view->response($aproducto -> PRODUCTOS, 200);
                                break;
                            case 'categoria':
                                $this->view->response($producto -> categoria, 200);
                                break;
                            default:
                                $this->view->response('No se encontró: '. $params[':subrecurso'] . '.', 404);
                        }
                    } else {
                        $this->view->response($producto, 200);
                    }
                } else {
                    $this->view->response("Producto ID: " . $params[':ID'] . " no encontrado", 404);
                }
            }
        }

        function create ($params = []){
            $data = $this->getData();
            $PRODUCTOS = $data->PRODUCTOS;
            $Precio = $data->Precio;
            $IDcategoria = $data->categoria;

            if(empty($PRODUCTOS) || empty($Precio) || empty($IDcategoria)){
                $this->view->response("Faltan datos", 400);
            } else {
                $id = $this->productoModel->insertProducto($PRODUCTOS, $Precio, $IDcategoria);

                $producto = $this->productoModel->getproductoById($IDproducto);
                $this->view->response($producto, 201);
            }
        }

        function update($params = []){
            $IDproducto = $params[':ID'];
            $producto = $this->productoModel->getproductoById($IDproducto);

            if($producto){
                $data = $this->getData();
                $PRODUCTOS = $data->PRODUCTOS;
            $Precio = $data->Precio;
            $IDcategoria = $data->categoria;

                if(empty($PRODUCTOS) || empty($Precio) || empty($IDcategoria)){
                    $this->view->response("Faltan datos", 400);
                }
            
                $this->productoModel->updateProducto($IDproducto, $PRODUCTOS, $Precio, $IDcategoria);
                $this->view->response($producto -> PRODUCTOS . " actualizado", 200);
            } else {
                $this->view->response("Producto ID: " . $IDproducto . " no encontrado", 404);
            }
        }

        function delete($params = []){
            $IDproducto = $params[':ID'];
            $producto = $this->productoModel->getproductoById($IDproducto);

            if($producto){
                $this->productoModel->deleteproducto($IDproducto);
                $this->view->response($producto -> PRODUCTO . " eliminado", 200);
            } else {
                $this->view->response("pRODUCTO ID: " . $IDproducto . " no encontrado", 404);
            }
        }


    }