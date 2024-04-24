-- create database bd_minimarket;
-- drop database bd_minimarket;
use bxpqgpobaybia5qpscw2;

CREATE TABLE tb_estado(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL unique
);

create table tb_tipo_usuario(
	id int not null auto_increment primary key,
    nombre varchar(80) not null unique,
    descripcion varchar(250) not null
);

create table tb_turno(
	id int not null auto_increment primary key,
    nombre varchar(80) not null unique
);


create table tb_usuario(
	id int not null auto_increment primary key,
    correo varchar(60) not null unique,
    contraseña varchar(20) not null,
    telefono char(9) not null unique,
    nombre varchar(80) not null,
    apellido varchar(80) not null,
	id_tipo_usuario int,
    id_turno int,
    id_estado INT ,
    foreign key (id_tipo_usuario) references tb_tipo_usuario (id),
    foreign key (id_turno) references tb_turno (id),
	foreign key (id_estado) REFERENCES tb_estado(id)
);


create table tb_proveedor(
	id int not null auto_increment primary key,
    nombre varchar(80) not null unique,
    ruc char(11) not null unique,
    descripcion varchar(250) not null,
    telefono char(9) not null unique,
    correo varchar(60) not null unique,
    direccion varchar(100) not null,
    id_estado int not null,
    foreign key (id_estado) REFERENCES tb_estado(id)
);

create table tb_categoria_producto(
	id int not null auto_increment primary key,
    nombre varchar(60) not null,
    descripcion varchar(250) not null
);

create table tb_producto(
	id int not null auto_increment primary key,
    nombre varchar(100) not null unique,
    precio_compra float not null,
    precio_venta float not null,
    stock_disponible int not null,
    codigoBarras varchar(50) not null unique,
    id_categoria_producto int,
    id_estado int,
    foreign key (id_categoria_producto) references tb_categoria_producto (id),
    foreign key (id_estado) references tb_estado (id)
);

create table tb_pedido(
	id int not null auto_increment primary key, 
    fecha date not null,
    costoTotal float not null,
    id_usuario int,
    id_proveedor int,
    foreign key (id_usuario) references tb_usuario (id),
	foreign key (id_proveedor) references tb_proveedor (id)
);

create table tb_detalle_pedido(
    cantidad int not null,
    precioUnitario double not null,
    id_pedido int,
    id_producto int,
    foreign key (id_pedido) references tb_pedido (id),
    foreign key (id_producto) references tb_producto (id)
);

create table tb_tipo_comprobante(
	id int not null auto_increment primary key, 
    comprobante varchar(50) not null,
    descripcion varchar(150) not null
);

create table tb_metodo_pago(
	id int not null auto_increment primary key, 
    metodo_pago varchar(50) not null,
    descripcion varchar(150) not null
);

create table tb_venta(
	id int not null auto_increment primary key, 
    fecha_hora datetime not null,
    impuesto float,
    total float not null,
    id_tipo_comprobante int,
    id_metodo_pago int,
    id_usuario int,
    foreign key (id_tipo_comprobante) references tb_tipo_comprobante (id),
    foreign key (id_metodo_pago) references tb_metodo_pago (id),
    foreign key (id_usuario) references tb_usuario (id)
);

create table tb_detalle_venta(
	id int not null auto_increment primary key, 
    precio_unitario float not null,
    subtotal float not null,
    cantidad int,
    id_producto int,
    id_venta int,
    foreign key (id_producto) references tb_producto (id),
    foreign key (id_venta) references tb_venta (id)
);

create table tb_cesta_temporal(
	id int not null auto_increment primary key,
    precio_unitario float not null,
    cantidad int not null,
    subtotal float not null,
    id_usuario int not null,
    id_producto int not null,
    foreign key (id_usuario) references tb_usuario (id),
    foreign key (id_producto) references tb_producto (id)
);
-- *****************************************************************************************************************
-- Procedimientos alamcenados para cesta temporal
-- *****************************************************************************************************************
DELIMITER //
CREATE PROCEDURE sp_registrar_cesta_temporal(
    IN p_id_usuario INT,
    IN p_codigobarras VARCHAR(50)
)
BEGIN
    DECLARE v_producto_id INT;
    DECLARE v_producto_nombre VARCHAR(100);
    DECLARE v_producto_precio_venta FLOAT;
    DECLARE v_cantidad_existente INT;

    -- Obtener el ID del producto según el código de barras
    SELECT id, precio_venta INTO v_producto_id, v_producto_precio_venta
    FROM tb_producto
    WHERE codigoBarras = p_codigobarras;

    -- Verificar si el producto ya está en la cesta para el mismo usuario
    SELECT cantidad INTO v_cantidad_existente
    FROM tb_cesta_temporal
    WHERE id_usuario = p_id_usuario AND id_producto = v_producto_id;

    IF v_cantidad_existente IS NOT NULL THEN
        -- El producto ya existe, actualizar la cantidad y subtotal
        UPDATE tb_cesta_temporal
        SET cantidad = cantidad + 1,
            subtotal = (cantidad  * v_producto_precio_venta)
        WHERE id_usuario = p_id_usuario AND id_producto = v_producto_id;
    ELSE
        -- El producto no existe, insertarlo con cantidad 1
        INSERT INTO tb_cesta_temporal (precio_unitario, cantidad, subtotal, id_usuario, id_producto)
        VALUES (v_producto_precio_venta, 1, v_producto_precio_venta, p_id_usuario, v_producto_id);
    END IF;
END //

delimiter //
create procedure sp_editar_cesta_temporal_cantidad (
	in p_id_usuario int,
	in p_cantidad int,
    in p_nombre_producto varchar(100)
)
begin
	declare v_precio_unitario float;
    declare v_id_producto int;
    
	-- Obtener el ID del producto según el nombre
    select precio_venta, id into  v_precio_unitario, v_id_producto
    from tb_producto where nombre = p_nombre_producto;
 
    update tb_cesta_temporal set cantidad = p_cantidad,  subtotal = (p_cantidad * v_precio_unitario)
    where id_usuario = p_id_usuario AND id_producto = v_id_producto;
    
end; //

-- call sp_editar_cesta_temporal_cantidad(2, 2, "Atún enlatado")

delimiter //
create procedure sp_consultar_cesta_temporal_usuario(in p_idusuario int)
begin
	select p.nombre as producto,p.precio_venta as precio_unitario, ct.cantidad, ct.subtotal
    from tb_cesta_temporal ct
    inner join tb_producto p on ct.id_producto = p.id
    where ct.id_usuario = p_idusuario;
end //

delimiter //
create procedure sp_eliminar_item_cesta_temporal(
	in p_id_usuario int,
    in p_nombre_producto varchar(100)
)
begin
	declare v_id_producto int;
    
    -- Obtener el ID del producto según el nombre
    select id into v_id_producto from tb_producto where nombre = p_nombre_producto;
    
    -- Eliminar item de la cesta temporal
    delete from tb_cesta_temporal where id_usuario = p_id_usuario and id_producto = v_id_producto;
    
end; //

delimiter //
create procedure sp_eliminar_cesta_temporal_usuario(in p_id_usuario int)
begin 
	delete from tb_cesta_temporal where id_usuario =  p_id_usuario;
end; //
-- call sp_eliminar_cesta_temporal_usuario("2");
-- CALL sp_eliminar_item_cesta_temporal(2, 'Papas Fritas');


-- *****************************************************************************************************************
-- Procedimientos alamcenados para Proveedor
-- *****************************************************************************************************************
delimiter //
create procedure sp_listar_proveedor()
begin
    select p.id, p.nombre, p.ruc, p.correo, e.nombre as estado
    from tb_proveedor p
    inner join tb_estado e ON p.id_estado = e.id;
end //

-- call sp_listar_proveedor();

delimiter //
create procedure sp_buscar_proveedor_por_codigo(in codproveedor int)
begin
	select p.id, p.nombre, p.ruc, p.descripcion,p.telefono, p.correo, p.direccion, e.nombre as estado
    from tb_proveedor p
    inner join tb_estado e on p.id_estado = e.id
    where p.id = codproveedor;
end; //
-- call sp_buscar_proveedor_por_codigo('12');

delimiter //
create procedure sp_registrar_proveedor(
    in nombre VARCHAR(100),
    in ruc VARCHAR(15),
    in descripcion VARCHAR(255),
    in telefono VARCHAR(20),
    in correo VARCHAR(100),
    in direccion VARCHAR(255),
    in id_estado INT
)
begin	
    insert into tb_proveedor (nombre, ruc, descripcion, telefono, correo, direccion, id_estado)
    values (nombre, ruc, descripcion, telefono, correo, direccion, id_estado);
end //


delimiter //
CREATE PROCEDURE sp_editar_proveedor(
    IN p_codprov INT,
    IN p_nombre VARCHAR(80),
    IN p_ruc CHAR(11),
    IN p_descripcion VARCHAR(250),
    IN p_telefono CHAR(9),
    IN p_correo VARCHAR(60),
    IN p_direccion VARCHAR(100),
    IN p_id_estado_proveedor INT
)
BEGIN
    UPDATE tb_proveedor
    SET nombre = p_nombre,
        ruc = p_ruc,
        descripcion = p_descripcion,
        telefono = p_telefono,
        correo = p_correo,
        direccion = p_direccion,
        id_estado = p_id_estado_proveedor
    WHERE id = p_codprov;
END //

-- call sp_editar_proveedor(1, 'DiestrituiUUdorade Alfa Enlatados', '22345678900', 'Proveedor de alimentos enlatados', '987954329', 'info@alfa.com', 'Calle Principal #888', 1);

-- select * from tb_proveedor;

delimiter //
create procedure sp_borrar_proveedor(
    IN p_idProveedor INT
)
begin
    delete from tb_proveedor WHERE id = p_idProveedor;
end //

-- call sp_listar_proveedor();
-- call sp_borrar_proveedor('18');

DELIMITER $$
CREATE PROCEDURE sp_consultar_proveedor_codigo(
    IN codprov INT
)
BEGIN
    SELECT * FROM tb_proveedor
    WHERE id = codprov;
END$$
DELIMITER ;

-- call sp_consultar_proveedor_codigo('2');

DELIMITER $$
CREATE PROCEDURE sp_filtrar_proveedor(
    IN valor VARCHAR(40)
)
BEGIN
    SELECT * FROM tb_proveedor
    WHERE nombre LIKE CONCAT('%', valor, '%');
END$$
DELIMITER ;
 -- call sp_filtrar_proveedor('Distribuidora')





-- *****************************************************************************************************************
-- *****************************************************************************************************************
-- Procedimientos alamcenados para Productos

delimiter //
create procedure sp_listar_productos()
begin
    select p.id, 
        p.nombre, 
        p.precio_compra, 
        p.precio_venta, 
        p.stock_disponible, 
        p.codigoBarras, 
        c.nombre as categoria,
        e.nombre as estado,
        p.id_estado
    from tb_producto p
    left join  tb_categoria_producto c on p.id_categoria_producto = c.id
    left join tb_estado e on p.id_estado = e.id;
end; //

delimiter //
create procedure sp_buscar_producto_por_codigo(in codigobar varchar(50))
begin
    select nombre, precio_venta
    from tb_producto
    where codigoBarras = codigobar;
end; //

delimiter //
create procedure sp_mostrar_producto_por_codigo(
    in producto_id int
)
begin
    select 
        p.id, 
        p.nombre, 
        p.stock_disponible as stock, 
        p.precio_compra, 
        p.precio_venta,
        p.codigoBarras,
        c.nombre as categoria,
        e.nombre as estado
    from 
        tb_producto p
	inner join 
        tb_categoria_producto c on p.id_categoria_producto = c.id
    inner join 
        tb_estado e on p.id_estado = e.id
    where 
        p.id = producto_id;
end; //

-- CALL sp_mostrar_producto_por_codigo('1');

delimiter //
create procedure sp_filtrar_producto(
    in valor varchar(100)
)
begin
    select 
        p.id, 
        p.nombre, 
        p.stock_disponible as stock, 
        p.precio_compra, 
        p.precio_venta,
        p.codigobarras,
        c.nombre as categoria_producto, 
        e.nombre as estado_producto
    from 
        tb_producto p
    inner join
        tb_categoria_producto c on p.id_categoria_producto = c.id
    left join 
        tb_estado e on p.id_estado = e.id
    where 
        p.nombre like concat('%', valor, '%');
end; //

-- CALL sp_filtrar_producto('man');

delimiter //
create procedure sp_listar_categoria_producto()
begin
    select * from tb_categoria_producto;
end; //

delimiter //
create procedure sp_registrar_producto(
    in p_nombre varchar(100),
    in p_precio_compra float,
    in p_precio_venta float,
    in p_stock_disponible int,
    in p_codigo_barras varchar(100),
    in p_id_categoria_producto int,
    in p_id_estado int
)
begin
    insert into tb_producto (nombre, precio_compra, precio_venta, stock_disponible, codigoBarras, id_categoria_producto, id_estado)
    values (p_nombre, p_precio_compra, p_precio_venta, p_stock_disponible, p_codigo_barras, p_id_categoria_producto, p_id_estado);
end; //


delimiter //
create procedure sp_editar_producto(
    in p_id int,
    in p_nombre varchar(255),
    in p_precio_compra float,
    in p_precio_venta float,
    in p_stock_disponible int,
    in p_codigo_barras varchar(255),
    in p_id_categoria_producto int,
    in p_id_estado int
)
begin
    update tb_producto
    set nombre = p_nombre,
        precio_compra = p_precio_compra,
        precio_venta = p_precio_venta,
        stock_disponible = p_stock_disponible,
        codigoBarras = p_codigo_barras,
        id_categoria_producto = p_id_categoria_producto,
        id_estado = p_id_estado
    where id = p_id;
end; //

delimiter //
create procedure sp_eliminar_producto(
    in p_id int
)
begin
    delete from tb_producto
    where id = p_id;
end; //

delimiter //
create procedure sp_listar_estado_producto()
begin
	select * from tb_estado;
end //

delimiter //

create procedure sp_buscar_producto_por_ID(IN codprod INT)
begin
    select * from tb_producto
    where id = codprod;
end;//

delimiter //
create procedure sp_actualizar_estado_producto(in codprod int, in idesta int)
begin
	update tb_producto set id_estado = idesta
    where id = codprod;
end //


-- call sp_buscar_producto_por_codigo("1234567890188")

-- call sp_listar_productos()

-- call sp_buscar_producto_por_codigo("1234567890188")

-- *****************************************************************************************************************
-- Procedimientos alamcenados para Ventas y sus detalles
-- *****************************************************************************************************************
delimiter //
create procedure sp_listar_tipo_comprobante()
begin
	select * from tb_tipo_comprobante;
end //

delimiter //
create procedure sp_listar_metodo_pago()
begin
	select * from tb_metodo_pago;
end //


delimiter //
create procedure sp_listar_venta()
begin
	select v.id, v.fecha_hora, v.impuesto, v.total, c.comprobante, mp.metodo_pago, concat(u.nombre, ' ', u.apellido) as usuario
    from tb_venta v
    inner join tb_tipo_comprobante c on v.id_tipo_comprobante = c.id
    inner join tb_metodo_pago mp on v.id_metodo_pago = mp.id
    inner join tb_usuario u on v.id_usuario = u.id;
end; //

delimiter //
create procedure sp_buscar_venta_por_codigo(in codventa int)
begin
	select v.id, v.fecha_hora, v.impuesto, v.total, c.comprobante, mp.metodo_pago, concat(u.nombre, ' ', u.apellido) as usuario
    from tb_venta v
    inner join tb_tipo_comprobante c on v.id_tipo_comprobante = c.id
    inner join tb_metodo_pago mp on v.id_metodo_pago = mp.id
    inner join tb_usuario u on v.id_usuario = u.id
    where v.id = codventa;
end; //

-- call sp_buscar_venta_por_codigo("4");

delimiter //
create procedure sp_filtrar_venta_por_rango_fecha(
	in p_fecha_inicio date,
    in p_fecha_fin date
)	
begin
	set p_fecha_fin = date_add(p_fecha_fin, interval 1 day); -- incrementar un dia a la fecha fin, para que en el filtrado tenga en cuenta el mismo dia de fin

	select v.id, v.fecha_hora, v.impuesto, v.total, c.comprobante, mp.metodo_pago, concat(u.nombre, ' ', u.apellido) as usuario
    from tb_venta v
    inner join tb_tipo_comprobante c on v.id_tipo_comprobante = c.id
    inner join tb_metodo_pago mp on v.id_metodo_pago = mp.id
    inner join tb_usuario u on v.id_usuario = u.id
    where fecha_hora >= p_fecha_inicio and fecha_hora < p_fecha_fin;
end ; //

-- CALL sp_filtrar_venta_por_rango_fecha('2024-04-16', '2024-04-18');

delimiter //
create procedure sp_buscar_detalle_venta_por_codigo(in codventa int)
begin
	select p.nombre, dv.precio_unitario,
    dv.cantidad, dv.subtotal
    from tb_detalle_venta dv
    inner join tb_producto p on dv.id_producto = p.id
    where id_venta = codventa;
end; //

-- call sp_buscar_detalle_venta_por_codigo("4");

delimiter //
create procedure sp_registrar_venta(
	in p_impuesto float,
    in p_total float,
    in p_id_tipo_comprobante int,
    in p_id_metodo_pago int,
    in p_id_usuario int
)
begin
	declare v_venta_id int;

	-- Insertar los parámetros de entrada a la tabla venta
	insert into tb_venta (fecha_hora, impuesto, total, id_tipo_comprobante, id_metodo_pago, id_usuario)
    values (now(), p_impuesto, p_total, p_id_tipo_comprobante, p_id_metodo_pago, p_id_usuario);
    
    -- Obtener el ID de la venta recién insertada
    set v_venta_id = last_insert_id();
    
    -- Insertar los datos de la cesta temporal en la tabla tb_detalle_venta
    insert into tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
    select precio_unitario, subtotal, cantidad, id_producto, v_venta_id
    from tb_cesta_temporal
    where id_usuario = p_id_usuario;
    
    -- Actualizar el stock disponible en la tabla tb_producto
    update tb_producto p
    join tb_cesta_temporal ct on p.id = ct.id_producto
    set p.stock_disponible = p.stock_disponible - ct.cantidad
    where ct.id_usuario = p_id_usuario;
    
    -- Limpiar la cesta temporal después de la venta
    DELETE FROM tb_cesta_temporal WHERE id_usuario = p_id_usuario;
    
end //
delimiter ;


delimiter //
create procedure sp_eliminar_venta(in p_id_venta int)
begin
	delete from tb_detalle_venta where id_venta = p_id_venta; -- eliminar los detalles de la venta
    
    delete from tb_venta where id = p_id_venta; -- eliminar la propia venta
end; //

-- call sp_eliminar_venta("3")

-- CALL sp_registrar_venta(18.5, 250.75, 1, 3, 2);
-- select * from tb_venta;
-- select * from tb_cesta_temporal
-- *****************************************************************************************************************

-- *****************************************************************************************************************
-- Procedimientos alamcenados para Uliente
-- *****************************************************************************************************************

delimiter //
create procedure sp_listar_tipo_usuario()
begin
	select * from tb_tipo_usuario;
end //

delimiter //
create procedure sp_listar_turno_usuario()
begin
	select * from tb_turno;
end //

delimiter //
create procedure sp_listar_estado_usuario()
begin
	select * from tb_estado;
end //

delimiter //
create procedure sp_listar_usuario()
begin
	select u.id,
			u.correo,
            u.contraseña,
            u.nombre,
            u.apellido,
            u.telefono,
            u.id_estado,
            e.nombre as estado
    from tb_usuario u
    inner join tb_estado e on u.id_estado = e.id;
end //

-- call sp_listar_usuario();

delimiter //
create procedure sp_buscar_usuario_por_codigo(in iduser int)
begin
	select * from tb_usuario
    where id = iduser;
end //

delimiter //
create procedure sp_mostrar_usuario_por_codigo(in iduser int)
begin
	select u.id,
		   u.correo,
           u.contraseña,
           u.telefono,
           u.nombre,
           u.apellido,
           t.nombre as tipo,
           tu.nombre as turno,
           e.nombre as estado
	from tb_usuario u
    inner join tb_tipo_usuario t on u.id_tipo_usuario = t.id
    inner join tb_turno tu on u.id_turno = tu.id
    inner join tb_estado e on u.id_estado = e.id
    where u.id = iduser;
end //

delimiter //
create procedure sp_filtrar_usuario(in valor varchar(80))
begin
	select u.id,
		   u.correo,
           u.contraseña,
           u.telefono,
           u.nombre,
           u.apellido,
           t.nombre as tipo,
           tu.nombre as turno,
           e.nombre as estado
	from tb_usuario u
    inner join tb_tipo_usuario t on u.id_tipo_usuario = t.id
    inner join tb_turno tu on u.id_turno = tu.id
    inner join tb_estado e on u.id_estado = e.id
    where u.nombre like concat(valor, '%');
end //

delimiter //
create procedure sp_registrar_usuario(
    in p_correo varchar(60),
    in p_contraseña varchar(20),
    in p_telefono char(9),
    in p_nombre varchar(80),
    in p_apellido varchar(80),
    in p_id_tipo_usuario int,
    in p_id_turno int,
    in p_id_estado int
)
begin
    insert into tb_usuario (correo, contraseña, telefono, nombre, apellido, id_tipo_usuario, id_turno, id_estado)
    values (p_correo, p_contraseña, p_telefono, p_nombre, p_apellido, p_id_tipo_usuario, p_id_turno, p_id_estado);
end //

-- CALL sp_registrar_usuario('usuaradsio@example.com', 'contraseña123', '123451889', 'Juan', 'torres', 2, 1, 1);
-- select * from tb_usuario

delimiter //
create procedure sp_editar_usuario(
    in id_usuario int,
    in correo_usuario varchar(60),
    in contraseña_usuario varchar(20),
    in telefono_usuario char(9),
    in nombre_usuario varchar(80),
    in apellido_usuario varchar(80),
    in id_tipo_usuario int,
    in id_turno int,
    in id_estado_usuario int
)
begin
    update tb_usuario
    set correo = correo_usuario,
        contraseña = contraseña_usuario,
        telefono = telefono_usuario,
        nombre = nombre_usuario,
        apellido = apellido_usuario,
        id_tipo_usuario = id_tipo_usuario,
        id_turno = id_turno,
        id_estado = id_estado_usuario
    where id = id_usuario;
end //

delimiter //
create procedure sp_actualizar_estado_usuario(in iduser int, in idest int)
begin
	update tb_usuario set id_estado = idest
    where id = iduser;
end //

-- *****************************************************************************************************************
-- Procedimientos alamcenados para PEDIDO Y DETALLE PEDIDO
-- *****************************************************************************************************************

-- Crear procedimiento para registrar un pedido
DELIMITER //
CREATE PROCEDURE sp_registrar_pedido(
	IN p_fecha_pedido DATE,
	IN p_total DECIMAL(10, 2),
    IN p_id_usuario INT,
    in p_id_proovedor int
)
BEGIN
    INSERT INTO tb_pedido (fecha, costoTotal, id_usuario, id_proveedor)
    VALUES (p_fecha_pedido, p_total, p_id_usuario, p_id_proovedor);
END //
DELIMITER //

CREATE PROCEDURE sp_listar_pedidos()
BEGIN
    SELECT * FROM tb_pedido;
END //

-- Crear procedimiento para obtener un pedido por su ID
DELIMITER //

CREATE PROCEDURE sp_obtener_pedido_por_id(IN p_id_pedido INT)
BEGIN
    SELECT * FROM tb_pedido WHERE id_pedido = p_id_pedido;
END //

-- Crear procedimiento para actualizar un pedido
DELIMITER //

CREATE PROCEDURE sp_actualizar_pedido(
    IN p_id_pedido INT,
    IN p_id_cliente INT,
    IN p_fecha_pedido DATE,
    IN p_total DECIMAL(10, 2)
)
BEGIN
    UPDATE pedido
    SET id_cliente = p_id_cliente,
        fecha_pedido = p_fecha_pedido,
        total = p_total
    WHERE id_pedido = p_id_pedido;
END //

-- Crear procedimiento para eliminar un pedido por su ID
DELIMITER //

CREATE PROCEDURE sp_borrar_pedido(IN p_id_pedido INT)
BEGIN
    DELETE FROM tb_pedido WHERE id_pedido = p_id_pedido;
END //

DELIMITER //

CREATE PROCEDURE sp_buscar_pedido_por_codigo(
    IN p_codpedido INT
)
BEGIN
    SELECT * FROM tb_pedido WHERE id = p_codpedido;
END //



-- Crear procedimiento para registrar un detalle de pedido
DELIMITER //

CREATE PROCEDURE sp_registrar_detalle_pedido(
    IN p_id_pedido INT,
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_precio_unitario DECIMAL(10, 2)
)
BEGIN
    INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario)
    VALUES (p_id_pedido, p_id_producto, p_cantidad, p_precio_unitario);
END //

-- Crear procedimiento para obtener todos los detalles de un pedido por su ID
DELIMITER //

CREATE PROCEDURE sp_obtener_detalles_pedido(IN p_id_pedido INT)
BEGIN
    SELECT * FROM detalle_pedido WHERE id_pedido = p_id_pedido;
END //

-- Crear procedimiento para actualizar un detalle de pedido
DELIMITER //

CREATE PROCEDURE sp_actualizar_detalle_pedido(
    IN p_id_detalle_pedido INT,
    IN p_id_pedido INT,
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_precio_unitario DECIMAL(10, 2)
)
BEGIN
    UPDATE detalle_pedido
    SET id_pedido = p_id_pedido,
        id_producto = p_id_producto,
        cantidad = p_cantidad,
        precio_unitario = p_precio_unitario
    WHERE id_detalle_pedido = p_id_detalle_pedido;
END //

-- Crear procedimiento para eliminar un detalle de pedido por su ID
DELIMITER //

CREATE PROCEDURE sp_borrar_detalle_pedido(IN p_id_detalle_pedido INT)
BEGIN
    DELETE FROM detalle_pedido WHERE id_detalle_pedido = p_id_detalle_pedido;
END //




-- *****************************************************************************************************************

-- Inserts
-- Insertar tipos de usuario
INSERT INTO tb_tipo_usuario (nombre, descripcion) VALUES 
('admin', 'Rol de administrador con acceso completo al sistema'),
('empleado', 'Rol de empleado con acceso limitado al sistema');


-- Insertar turnos
INSERT INTO tb_turno (nombre) VALUES 
('mañana'),
('tarde'),
('noche');

-- Insertar estado de usuario
INSERT INTO tb_estado (nombre) VALUES 
('Activo'),
('Inactivo'),
('Eliminado');

-- Insertar usuarios
INSERT INTO tb_usuario (correo, contraseña, telefono, nombre, apellido, id_tipo_usuario, id_turno, id_estado) VALUES 
('admin@example.com', 'contraseña', '123456789', 'Admin', 'Apellido', 1, 1, 1),
('empleado1@example.com', 'contraseña', '987654321', 'Luis', 'Lopez', 2, 1, 1),
('empleado2@example.com', 'contraseña', '123123123', 'Fabian', 'Ambrosio', 2, 2, 1),
('empleado3@example.com', 'contraseña', '456456456', 'jean', 'Benedicto', 2, 3, 1),
('empleado4@example.com', 'contraseña', '789789789', 'fabrizzio', 'Zambrano', 2, 1, 1);

-- Insertar proveedores de productos
INSERT INTO tb_proveedor (nombre, ruc, descripcion, telefono, correo, direccion, id_estado) VALUES 
('Distribuidora Alfa Enlatados', '22345678901', 'Proveedor de alimentos enlatados', '987954329', 'info@alfa.com', 'Calle Principal #123', 1),
('Distribuidora frut S.A.', '28768432101', 'Proveedor de frutas', '954321987', 'ventas@productosfrescos.com', 'Avenida Central #456', 1),
('Bebidas Refrescantes Ltda.', '26789052301', 'Proveedor de bebidas gaseosas y aguas embotelladas', '921654981', 'pedidos@bebidasrefrescantes.com', 'Calle Secundaria #789', 1),
('PepsiCO S.A.', '20987654721', 'Proveedor de golosinas, chocolates y snacks', '989012345', 'contacto@dulcesygolosinas.com', 'Avenida Sur #234', 1),
('Distribuidora FyN Limpieza', '23456719012', 'Proveedor de productos de limpieza, detergentes y desinfectantes', '919344678', 'ventas@articulosdelimpieza.com', 'Calle Norte #567', 1),
('Lácteos Deliciosos S.A.', '28765472109', 'Proveedor de productos lácteos frescos y saludables', '987654321', 'ventas@lacteosdeliciosos.com', 'Avenida Norte #456', 1),
('Verduras Orgánicas Ltda.', '21934667890', 'Proveedor de verduras frescas y orgánicas', '912395698', 'ventas@verdurasorganicas.com', 'Calle Verde #789', 1),
('Cervecería Backus S.A.', '21294567810', 'Proveedor de cervezas de alta calidad y variedad', '992345678', 'contacto@cervezabackus.com', 'Avenida Cervecera #123', 1),
('Productos de Higiene Personal S.A.', '22375688971', 'Proveedor de productos de higiene personal, como jabones, champús y cremas', '123456789', 'ventas@higienepersonal.com', 'Calle Higiene #456', 1),
('Heladería Donofrio S.A.', '22347618901', 'Proveedor de helados artesanales y postres helados', '991476189', 'ventas@heladeriadelicias.com', 'Calle Principal #990', 1),
('Panadería PanDuro S.A.', '22345078501', 'Proveedor de productos de panadería frescos y variados', '983416719', 'ventas@panaderiapanDulce.com', 'Calle del Pan #789', 1),
('Carnes y Pescados Frescos S.A.', '28795032009', 'Proveedor de carnes y pescados frescos y de calidad', '987154821', 'ventas@carnespescadosfrescos.com', 'Avenida del Mar #789' , 2);

-- Insertar categorías de productos para un minimarket
INSERT INTO tb_categoria_producto (nombre, descripcion) VALUES 
('Enlatados', 'Productos enlatados como conservas de frutas, verduras, pescados y otros.'),
('Frutas', 'Productos frescos como manzanas, bananas, y naranjas.'),
('Bebidas', 'Incluye agua embotellada, jugos, refrescos y bebidas energéticas.'),
('Snacks y golosinas', 'Productos como papas fritas, galletas, caramelos y chocolates.'),
('Productos de limpieza', 'Incluye detergentes, desinfectantes, y productos para la limpieza del hogar.'),
('Lácteos', 'Productos lácteos como leche, yogur, queso y mantequilla.'),
('Verduras', 'Productos frescos como zanahorias, lechuga, y tomates.'),
('Cervezas', 'Productos relacionados con la fabricación y venta de cervezas, tanto artesanales como comerciales.'),
('Cuidado personal', 'Productos como jabón, champú, pasta de dientes y papel higiénico.'),
('Helados', 'Productos relacionados con la fabricación y venta de helados, incluyendo diferentes sabores y presentaciones.'),
('Panadería', 'Productos horneados como pan blanco, pan integral y pastelería.'),
('Carnes y pescados', 'Incluye carne de res, pollo, pescado fresco y mariscos.');

-- Insertar productos relacionados con las categorías ya definidas
INSERT INTO tb_producto (nombre, precio_compra, precio_venta, stock_disponible, codigoBarras, id_categoria_producto, id_estado) VALUES 
('Atún enlatado', 3.1, 3.99, 50, '0123456789099', 1, 1),
('Sopa de fideos enlatada', 0.8, 1.75, 80, '1234567890188', 1, 1),
('Maíz enlatado', 0.95, 1.49, 60, '2345678901277', 1, 1),
('Manzanas', 1.98, 2.99, 50, '1234567890166', 2, 1),
('Plátanos', 0.97, 1.75, 80, '2345678901255', 2, 1),
('Naranjas', 0.85, 1.49, 60, '3456789012344', 2, 1),
('Coca-Cola',1.2, 1.99, 100, '1234567890133', 3, 1),
('Pepsi',0.94,  1.75, 120, '2345678901222', 3, 1),
('Sprite',0.80, 1.49, 80, '3456789012311', 3, 1),
('Papas Fritas',0.96, 1.99, 100, '1234567890197', 4, 1),
('Galletas',0.95, 1.75, 120, '2345678901264', 4, 1),
('Chocolate',0.60, 1.49, 80, '3456789012331', 4, 1),
('Detergente líquido',1.63, 3.99, 50, '1994567890123', 5, 1),
('Lejía',1.62, 2.75, 80, '2345678901234', 5, 1),
('Limpiador multiusos',0.95, 1.99, 60, '3886789012345', 5, 1),
('Mantequilla',1.84, 2.25, 90, '4777890123456', 6, 1),
('Yogur natural',0.96, 1.75, 80, '2665678901234', 6, 1),
('Queso fresco',1.67, 3.99, 60, '3556789012345', 6, 1),
('Zanahorias',0.45, 0.99, 80, '8441234567890', 7, 1),
('Tomates',1.1, 1.49, 50, '7833123456789', 7, 1),
('Espinacas',0.96, 1.25, 70, '9022345678901', 7, 1),
('Pilsen',1.21, 2.99, 100, '1114567890123', 8, 1),
('Cristal',1.94, 3.25, 120, '2005678901234', 8, 1),
('Cusqueña',1.84, 3.49, 80, '3456798012345', 8, 1),
('Champú',2.61, 4.99, 50, '1234561290123', 9, 1),
('Jabón de baño',1.6, 1.75, 80, '2345673901234', 9, 1),
('Crema hidratante',2.63, 3.49, 60, '3456749012345', 9, 1),
('Helado de vainilla',1.95, 2.99, 70, '4567870123456', 10, 1),
('Helado de chocolate',2.1, 3.25, 80, '5678081234567', 10, 1),
('Helado de fresa',1.94, 3.49, 90, '6789010645678', 10, 1),
('Pan de molde',0.98, 1.99, 50, '1234505890123', 11, 1),
('Croissants',0.57, 1.25, 60, '2345678041234', 11, 1),
('Baguettes',1.21, 2.49, 40, '3456780312345', 11, 1),
('Filete de pollo',3.58, 5.99, 70, '4567894023456', 12, 1),
('Filete de salmón',7.12, 8.25, 80, '5678900034567', 12, 1),
('Lomo de cerdo',5.12, 6.49, 90, '6789011745678', 12, 1);


-- Insert para los pedidos y sus detalles
-- pedido 1
INSERT INTO tb_pedido (fecha, costoTotal, id_usuario, id_proveedor)
VALUES ('2024-04-11', 15.50, 1, 2);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (2, 3.50, 1, 2);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (1, 2.50, 1, 5);

-- pedido 2
INSERT INTO tb_pedido (fecha, costoTotal, id_usuario, id_proveedor)
VALUES ('2024-04-10', 22.00, 2, 4);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (3, 1.80, 2, 7);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (2, 2.00, 2, 10);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (1, 10.00, 2, 12);

-- pedido 3
INSERT INTO tb_pedido (fecha, costoTotal, id_usuario, id_proveedor)
VALUES ('2024-04-09', 10.20, 3, 1);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (5, 2.50, 3, 1);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (2, 1.20, 3, 3);

-- pedido 4
INSERT INTO tb_pedido (fecha, costoTotal, id_usuario, id_proveedor)
VALUES ('2024-04-08', 18.70, 4, 3);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (1, 5.00, 4, 6);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (2, 3.50, 4, 8);

INSERT INTO tb_detalle_pedido (cantidad, precioUnitario, id_pedido, id_producto)
VALUES (1, 2.80, 4, 13);

-- Insert para tipo de comprobante
insert into tb_tipo_comprobante (comprobante, descripcion) values
("factura", "Comprobantes fiscales que detallan las ventas realizadas"),
("boleta", "Similar a las facturas, pero generalmente utilizadas para transacciones de menor valor o para clientes que no requieren una factura formal.");

-- Insert para los metodos de pago
insert into tb_metodo_pago (metodo_pago, descripcion) values
("efectivo", "Pago realizado con dinero fisico."),
("tarjeta", "Pago realizado con una tarjeta emitida por una entidad bancaria."),
("Yape", "Billetera digital.");

-- Insertar venta 1
INSERT INTO tb_venta (fecha_hora, impuesto, total, id_tipo_comprobante, id_metodo_pago, id_usuario)
VALUES ('2024-04-12 09:30:00', 1.50, 18.99, 1, 2, 2);

-- Detalles de la venta 1
INSERT INTO tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
VALUES (2.99, 11.96, 4, 4, 1);

INSERT INTO tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
VALUES (1.75, 1.75, 1, 11, 1);

-- Insertar venta 2
INSERT INTO tb_venta (fecha_hora, impuesto, total, id_tipo_comprobante, id_metodo_pago, id_usuario)
VALUES ('2024-04-12 12:45:00', 2.20, 10.24, 1, 3, 3);

-- Detalles de la venta 2
INSERT INTO tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
VALUES (1.75, 5.25, 3, 8, 2);

INSERT INTO tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
VALUES (1.75, 3.5, 2, 10, 2);

INSERT INTO tb_detalle_venta (precio_unitario, subtotal, cantidad, id_producto, id_venta)
VALUES (1.49, 1.49, 1, 12, 2);