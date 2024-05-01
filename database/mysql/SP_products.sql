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


call sp_registrar_cesta_temporal(3, "2345678901277")