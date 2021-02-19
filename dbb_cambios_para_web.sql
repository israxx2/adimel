ALTER TABLE FUNCIONARIOS
ADD password VARCHAR(127);

ALTER TABLE DEPENDENCIAS_DEL_CLIENTE
ADD password VARCHAR(127),
dep_cli_email VARCHAR(100),
dep_cli_web VARCHAR(100),
dep_cli_usuario_web VARCHAR(100)

ALTER TABLE CLIENTE
ADD tipo varchar(100);

CREATE TABLE web_despacho (
	desp_idn int IDENTITY(1,1) PRIMARY KEY,
    dep_cli_idn varchar(10) NOT NULL,
	seg_div_pol_idn varchar(20) NOT NULL,
    direccion varchar(511),
	numero varchar(10),
	telefono varchar(12),
	created_at date DEFAULT getdate(),
	updated_at date,
);

CREATE TABLE web_configuracion (
	conf_idn varchar(100) PRIMARY KEY,
	titulo varchar(1023),
	modificado_por varchar(50),
	fecha_modificado date DEFAULT getdate(),
	estado int DEFAULT 1,
	estado int default 1
);

CREATE TABLE web_carrito (
	conf_idn int IDENTITY(1,1) PRIMARY KEY,
	dep_cli_idn varchar(50) NOT NULL,
	prod_codigo varchar(50) NOT NULL,
	prod_nombre varchar(255),
	cantidad int,
	created_at date DEFAULT getdate(),
	updated_at date,
	estado int default 1,
	pro_idn varchar(50),
	pro_aux varchar(25)
);
