Productos: Obtener todos los productos Ruta: /productos Método: GET Descripción: Obtiene una lista de todos los productos disponibles. Ejemplo de uso: localhost/TPweb2/api/productos

Obtener un producto por ID Ruta: /productos/:ID Método: GET Descripción: Obtiene un producto específico por su ID. Ejemplo de uso: localhost/tp3/api/productos/123

Obtener productos ordenados por campo Ruta: /api/productos?sort=:campo Método: GET Descripción: Obtiene productos ordenados según el campo especificado. Parámetros: campo: Campo por el cual ordenar los productos. Ejemplos de uso: localhost/tp3/api/productos?sort=nombre

Obtener productos ordenados en un sentido específico Ruta: api/productos?order=:sentido Método: GET Descripción: Obtiene productos ordenados en un sentido específico (ascendente o descendente). Parámetros: sentido: Sentido de orden (asc o desc). Ejemplo de uso: localhost/tp3/api/productos?order=asc

Obtener productos filtrados Ruta: /productos?[campo]=[condicion] Método: GET Descripción: Obtiene productos según un filtro específico. Ejemplos de uso: localhost/tp3/api/productos?precio=5
localhost/tp3/api/productos?producto=corolla

Agregar un nuevo producto  Ruta: /productos Método: POST Descripción: Agrega un nuevo producto.

Eliminar un producto por ID Ruta: /productos/:ID Método: DELETE Descripción: Elimina un producto por su ID. Ejemplo de uso: localhost/tp3/api/productos/123

Editar un producto por ID  Ruta: /productos/:ID Método: PUT Descripción: Edita un producto por su ID. Ejemplo de uso: localhost/tp3/api/productos/123(id del producto) {
"producto": "Producto Modificado", "precio": 12, "categoriaID": 18
}
