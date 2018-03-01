drop database if exists PruebaAhorcado;

create database if not exists PruebaAhorcado;

use PruebaAhorcado;

create table Jugador(
usuario varchar(30) not null,
cantidadJuegos int,
contra varchar(32) not null,
puntajeMaximo int,
Enlinea bool not null,
primary key pkJugador(usuario)
);

create table Puntuacion(
idPuntuacion int auto_increment not null,
puntaje int not null,
usuario varchar(30) not null,
primary key pkPuntuacion(idPuntuacion),
foreign key fkPuntuacionXJugador(usuario) references Jugador(usuario)
);

create table Palabra(
codigoPalabra int auto_increment not null,
texto varchar(25) not null,
reporte int,
pista varchar(35) not null,
primary key pkPalabra(codigoPalabra)
);

create table JugadorXPalabra(
idJugadorXPalabra int auto_increment not null,
usuario varchar(30) not null,
codigoPalabra int not null,
primary key pkJugadorXpalabra(idJugadorXPalabra),
foreign key fkJugadorXPalabraXJugador(usuario) references Jugador(usuario),
foreign key fkJugadorXPalabraXPalabra(codigoPalabra) references Palabra(codigoPalabra)
);
