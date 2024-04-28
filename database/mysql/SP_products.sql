use minimarket_laravel11;

delimiter //
create procedure sp_list_products()
begin
    select p.id, 
        p.name, 
        p.purchase_price, 
        p.sale_price, 
        p.stock, 
        p.barcode, 
        c.nombre as categoria,
        e.nombre as estado
    from products p
    left join  tb_categoria_producto c on p.category_id = c.id
    left join tb_estado e on p.state_id = e.id;
end; //

-- call sp_list_products()

delimiter //
create procedure sp_show_product_by_code(
    in p_product_id int
)
begin
    select 
        p.id, 
        p.name, 
        p.stock, 
        p.purchase_price, 
        p.sale_price,
        p.barcode,
        c.nombre as categoria,
        e.nombre as estado
    from 
        products p
	inner join 
        tb_categoria_producto c on p.category_id = c.id
    inner join 
        tb_estado e on p.state_id = e.id
    where 
        p.id = p_product_id;
end; //

-- CALL sp_show_product_by_code('1');

delimiter //
create procedure sp_list_product_category()
begin
    select * from tb_categoria_producto;
end; //

-- CALL sp_list_product_category();


delimiter //
create procedure sp_list_product_statuses()
begin
	select * from tb_estado;
end;

-- CALL sp_list_product_statuses();