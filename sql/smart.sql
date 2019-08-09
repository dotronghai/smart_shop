DROP DATABASE IF EXISTS smart_shop;
CREATE DATABASE smart_shop CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE smart_shop;

CREATE TABLE tbl_nguoi_dung (
 id_nd int(11) primary key auto_increment,
 ten varchar(50) not null,
 email varchar(100) not null unique,
 phone varchar(15) not null,
 tai_khoan varchar(50) not null unique,
 mat_khau varchar(50) not null,
 level tinyint(1) DEFAULT '0' COMMENT '0 là khách hàng, 1 là quản trị viên'
);

CREATE TABLE tbl_khach_hang (
 id_kh int(11) primary key auto_increment,
 ten_kh varchar(50) not null,
 sdt varchar(15) not null unique,
 mail varchar(100) not null unique,
 mat_khau varchar(50) not null,
level tinyint(1) DEFAULT '0' COMMENT '0 là khách hàng, 1 là quản trị viên'

);

CREATE TABLE tbl_dm_sp(
 id_dm int(11) primary key auto_increment,
 ten_danhmuc  varchar(50) not null,
 status int not null
);

CREATE TABLE tbl_san_pham (
 id_sp int(11)  primary key auto_increment,
 id_dm int(11)  not null,
 ten_sp varchar(100) not null,
 anh_sp varchar(200) not null,
 anh_list text NULL COMMENT 'Nhiều ảnh khác',
 gia_sp int(12) not null,
 so_luong int(5) not null,
 kich_thuoc varchar(255) null,
 man_hinh varchar(255) null,
 cau_hinh varchar(255) null,
 trong_luong varchar(255) null,
 mau_sac varchar(255) null,
 bo_nho varchar(255) null,
 he_dieu_hanh varchar(255) null,
 the_nho varchar(255) null,
 camera varchar(255) null,
 pin varchar(255) null,
 bao_hanh varchar(255) null, 
 ket_noi varchar(255) null,
 gia_km int(11) null,
 batdau_km datetime null,
 ketthuc_km datetime null,
 mo_ta text not null 	
);

CREATE TABLE tbl_binhluan(
 id_bl int(11) primary key auto_increment,
 id_sp int(11) null ,
 ho_ten varchar(50) not null,
 ngay_gio datetime null,
 dien_thoai varchar(50) not null,
 mail varchar(100) not null
);

CREATE TABLE tbl_don_hang(
 id_hd int(11)  primary key auto_increment,
 id_kh int(11) not null ,
 tinh_trang int(11) not null default '1',
 ngay_lap datetime not null,
 ten_kh varchar(200) null ,
 sdt_nhan varchar(200) null,
 email_nhan varchar(255) null,
 dia_chi_nhan text null,
 noi_nhan text not null,
 ghi_chu varchar(1000) null

);

CREATE TABLE tbl_ct_ddh(
 id_ct_hd int(11) primary key auto_increment,	
 id_hd int(11) not null ,
 id_sp int(11) not null,
 so_luong_mua int(5) default '1' not null,
 don_gia int(11) not null
);

CREATE TABLE tbl_tinh_trang(
 id_tinh_trang int(11) AUTO_INCREMENT primary key,
 tinh_trang varchar(255)  null
);

CREATE TABLE tbl_nv_gh(
 id_nvgh int(11) primary key AUTO_INCREMENT,
 ten_nvgh varchar(50) not null,
 sdt varchar(50) not null
);

CREATE TABLE tbl_sp_ban(
 id_sp_ban int(11) primary key auto_increment,
 id_sp int(11) not null,
 so_luong_ban int(11) null
);

CREATE TABLE banner
(
	id_banner int PRIMARY KEY AUTO_INCREMENT,
	name varchar(100) NOT NULL,
	image varchar(200) NOT NULL ,
	link varchar(200) DEFAULT '#',
	ordering int DEFAULT '0',
	status tinyint(1) DEFAULT '1'
);

CREATE TABLE blog
(
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(100) NOT NULL,
	image varchar(200) NOT NULL ,
	content text NULL,
	created_date timestamp DEFAULT CURRENT_TIMESTAMP,
	status tinyint(1) DEFAULT '1'
);

alter table tbl_san_pham 
add foreign key (id_dm) references tbl_dm_sp(id_dm);

alter table tbl_don_dh 
add foreign key (id_kh) references tbl_khach_hang(id_kh);

alter table tbl_don_dh 
add foreign key (id_tinh_trang) references tbl_tinh_trang(id_tinh_trang);

alter table tbl_don_dh 
add foreign key (id_nvgh) references tbl_nv_gh(id_nvgh);

alter table tbl_binhluan 
add foreign key (id_sp) references tbl_san_pham(id_sp);

	alter table tbl_ct_dh
	add foreign key (id_hd) references tbl_don_hang(id_hd);

alter table tbl_ct_dh
add foreign key (id_sp) references tbl_san_pham(id_sp);

alter table tbl_sp_ban
add foreign key (id_sp) references tbl_san_pham(id_sp);
