<?php

require_once './config.php';

class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASS);
        $this->deploy();
    }

    function deploy() {
        $hashedPass = '$2y$10$G3KPdz0KqHwiPCDGHOW2s.KtQHQ2a2BKBXYRSKwJs0FdPfeOvUEpa';
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<END
            --
            -- Estructura de tabla para la tabla `categoria`
            --
            
            CREATE TABLE `categoria` (
              `IDcategoria` int(11) NOT NULL,
              `Nombre` varchar(20) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `categoria`
            --
            
            INSERT INTO `categoria` (`IDcategoria`, `Nombre`) VALUES
            (1, 'Camioneta'),
            (2, 'Auto'),
            (3, 'Moto');
            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `producto`
            --
            
            CREATE TABLE `producto` (
              `IDproducto` int(11) NOT NULL,
              `Nombre` varchar(20) NOT NULL,
              `Precio` decimal(10,0) NOT NULL,
              `IDcategoria` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `producto`
            --
            
            INSERT INTO `producto` (`IDproducto`, `Nombre`, `Precio`, `IDcategoria`) VALUES
            (1, 'Toyota Corolla', 10000000, 2),
            (3, 'Honda Wve', 1500000, 3);
            
            --
            -- Índices para tablas volcadas
            --
            
            --
            -- Indices de la tabla `categoria`
            --
            ALTER TABLE `categoria`
              ADD PRIMARY KEY (`IDcategoria`);
            
            --
            -- Indices de la tabla `producto`
            --
            ALTER TABLE `producto`
              ADD PRIMARY KEY (`IDproducto`),
              ADD KEY `IDcategoria` (`IDcategoria`),
              ADD KEY `IDproducto` (`IDproducto`);
            
            --
            -- AUTO_INCREMENT de las tablas volcadas
            --
            
            --
            -- AUTO_INCREMENT de la tabla `categoria`
            --
            ALTER TABLE `categoria`
              MODIFY `IDcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
            
            --
            -- AUTO_INCREMENT de la tabla `producto`
            --
            ALTER TABLE `producto`
              MODIFY `IDproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
            
            --
            -- Restricciones para tablas volcadas
            --
            
            --
            -- Filtros para la tabla `producto`
            --
            ALTER TABLE `producto`
              ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IDcategoria`) REFERENCES `categoria` (`IDcategoria`) ON UPDATE CASCADE;
            COMMIT;
END;
    $this->db->query($sql);
        }
    }
}