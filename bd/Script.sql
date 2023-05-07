use mesa_cuadrada;

drop table usuario;
drop table hilo;
drop table mensaje;
drop table partida;
drop table noticia;
drop table producto;
drop table noticia;

create table usuario(
	usuario_id int not null auto_increment,
	usuario_email varchar(255) not null,
	usuario_nombre varchar(50) not null,
	usuario_contrasena varchar(255) not null,
	usuario_tipo varchar(1) not null,
	usuario_fecha_creacion date not null,
	usuario_ultima_conexion datetime,
	constraint tipo check (usuario_tipo = 'a' or usuario_tipo = "u" or usuario_tipo = "i"),
	primary key(usuario_id)
);

create table hilo(
	hilo_id int not null auto_increment,
	hilo_fecha date not null,
	hilo_contenido text not null,
	constraint contenido_maximo_hilo check (length(hilo_contenido) <= 5000),
	id_usuario int not null,
	constraint hilo_usuario foreign key (id_usuario) references usuario(usuario_id),
	primary key (hilo_id)
);


create table mensaje(
	mensaje_id int not null auto_increment,
	mensaje_fecha date not null,
	mensaje_contenido text not null,
	constraint contenido_maximo_mensaje check (length(mensaje_contenido) <= 2000),
	id_hilo int not null,
	constraint mensaje_hilo foreign key (id_hilo) references hilo(hilo_id),
	primary key (mensaje_id)
);


create table producto(
	producto_id int not null auto_increment,
	producto_fecha date not null,
	producto_precio double not null,
	producto_descripcion text not null,
	primary key (producto_id)
);

create table noticia(
	noticia_id int not null auto_increment,
	noticia_fecha date not null,
	noticia_contenido text not null,
	primary key (noticia_id)
);


create table partida (
	partida_id int not null,
	partida_numero_jugadores int not null,
	partida_puntuacion int not null,
	partida_fecha date,
	partida_nombre_juego varchar(100),
	id_usuario int not null,
	constraint partida_usuario foreign key (id_usuario) references usuario(usuario_id),
	primary key (partida_id)
);


INSERT INTO mesa_cuadrada.usuario  (usuario_email,usuario_nombre,usuario_contrasena,usuario_tipo,usuario_fecha_creacion) 
VALUES	("admin@gmail.com","ruben","1234","a","1970-02-02"), 
		("usuario@gmail.com","usuario","1234","u","2000-03-03"),
		("invitado@gmail.com","invitado","1234","i","2005-05-05");
