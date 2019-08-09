SELECT product.id,product.name, category.name as cat_name FROM product JOIN category ON product.category_id = category.id

SELECT  * FROM category;
SELECT category.id, category.name,category.status, COUNT(product.category_id) as total_pro
FROM category LEFT JOIN product ON category.id = product.category_id
GROUP BY category.id


-- thêm mới vào bảng cateogry

INSERT INTO category(name, status) VALUES('Áo nắng',0)
INSERT INTO customer(name, email, gender, birthaday) VALUES('Khách hàng a',0)

INSERT INTO tbl_khach_hang
SELECT product.id,product.name,product.image, category.name as cat_name FROM tbl_san_pham JOIN tbl_dm_sp ON product.category_id = category.id
SELECT id_km,anh_sp,ten_sp,ten_danhmuc,gia_sp,so_luong FROM tbl_san_pham JOIN tbl_dm_sp ON tbl_san_pham.id_dm = tbl_dm_sp.id_dm
SELECT id_sp,ten_sp,anh_sp FROM tbl_san_pham JOIN tbl_dm_sp ON tbl_san_pham.id_dm = tbl_dm_sp.id_dm
SELECT ten_sp,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham
SELECT * ,((gia_sp-gia_km)/gia_sp)*100 AS sale FROM tbl_san_pham WHERE id_dm IN(SELECT id_dm from tbl_dm_sp WHERE id_dm = 1 Or parent = 1) or status=2 or status=3 or status=4 Order by id_sp DESC