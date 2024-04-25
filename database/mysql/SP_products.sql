use brwknyyxc7knxxgnb8li;

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