use minimarket_laravel11;

DELIMITER //
CREATE PROCEDURE sp_registrar_cesta_temporal(
    IN p_id_usuario INT,
    IN p_codigobarras VARCHAR(50)
)
BEGIN
    DECLARE v_producto_id INT;
    DECLARE v_producto_nombre VARCHAR(100);
    DECLARE v_producto_precio_venta decimal(10,2);
    DECLARE v_cantidad_existente INT;

    -- Obtener el ID del producto según el código de barras
    SELECT id, sale_price INTO v_producto_id, v_producto_precio_venta
    FROM products
    WHERE barcode = p_codigobarras;

    -- Verificar si el producto ya está en la cesta para el mismo usuario
    SELECT cantidad INTO v_cantidad_existente
    FROM tb_cesta_temporal
    WHERE user_id = p_id_usuario AND product_id = v_producto_id;

    IF v_cantidad_existente IS NOT NULL THEN
        -- El producto ya existe, actualizar la cantidad y subtotal
        UPDATE tb_cesta_temporal
        SET cantidad = cantidad + 1,
            subtotal = (cantidad  * v_producto_precio_venta)
        WHERE user_id = p_id_usuario AND product_id = v_producto_id;
    ELSE
        -- El producto no existe, insertarlo con cantidad 1
        INSERT INTO tb_cesta_temporal (precio_unitario, cantidad, subtotal, user_id, product_id)
        VALUES (v_producto_precio_venta, 1, v_producto_precio_venta, p_id_usuario, v_producto_id);
    END IF;
END //

-- call sp_registrar_cesta_temporal(2, "2345678901277")

delimiter //
create procedure sp_registrar_venta(
	in p_impuesto decimal(10,2),
    in p_total decimal(10,2),
    in p_id_tipo_comprobante int,
    in p_id_metodo_pago int,
    in p_id_usuario int
)
begin
	declare v_venta_id int;

	-- Insertar los parámetros de entrada a la tabla venta
	insert into tb_venta (created_at, impuesto, total, tipo_comprobante_id, metodo_pago_id, users_id)
    values (now(), p_impuesto, p_total, p_id_tipo_comprobante, p_id_metodo_pago, p_id_usuario);
    
    -- Obtener el ID de la venta recién insertada
    set v_venta_id = last_insert_id();
    
    -- Insertar los datos de la cesta temporal en la tabla tb_detalle_venta
    insert into tb_detalle_venta (precio_unitario, subtotal, cantidad, products_id, sale_id)
    select precio_unitario, subtotal, cantidad, product_id, v_venta_id
    from tb_cesta_temporal
    where user_id = p_id_usuario;
    
    -- Actualizar el stock disponible en la tabla produtcs
    update products p
    join tb_cesta_temporal ct on p.id = ct.product_id
    set p.stock = p.stock - ct.cantidad
    where ct.user_id = p_id_usuario;
    
    -- Limpiar la cesta temporal después de la venta
    DELETE FROM tb_cesta_temporal WHERE user_id = p_id_usuario;
    
end //
delimiter ;