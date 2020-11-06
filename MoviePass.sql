create database MoviePass;
use MoviePass;
create table if not exists Cinemas(
    id int auto_increment not null,
    cinemaName varchar (50) not null,
    address varchar (50) not null,
    statusCinema boolean default 1,
    constraint Pk_Cinemas primary key (id)
);
create table if not exists Users (
    id int auto_increment not null,
    userName varchar (50) not null,
    lastName varchar (50) not null,
    email varchar (50) unique not null,
    userPassword varchar (20) not null,
    esAdmin boolean default 0,
    constraint Pk_Users primary key (id)
);
create table if not exists Movies (
    id int not null,
    # viene de la Api
    adult bool default 0,
    movieName varchar(50) not null,
    summary varchar(2000) not null,
    movieLanguage varchar(10) not null,
    dir_image varchar(80),
    playingNow bool default 0,
    releaseDate date not null,
    constraint Pk_Movie primary key (id)
);

create table if not exists Genres (
    id int not null,
    genreName varchar (20) not null,
    constraint Pk_Genre primary key (id)
);
create table if not exists Movie_Genres (
    id int auto_increment not null,
    idMovie int not null,
    idGenre int not null,
    constraint Pk_Mxg primary key (id),
    constraint Fk_Movie foreign key (idMovie) references Movies (id),
    constraint Fk_Genre foreign key (idGenre) references Genres (id)
);
create table if not exists Rooms(
    id int auto_increment not null,
    roomName varchar(50) not null,
    capacity int not null,
    idCinema int not null,
    price int not null,
    statusRoom bool default 1,
    constraint Pk_id_room primary key(id),
    constraint Fk_Cinema_id_cinema foreign key (idCinema) references Cinemas (id),
    constraint Check_RoomName check (price > 0),
    constraint Check_Capacity check (capacity > 0)
);
create table if not exists Shows(
    id int auto_increment not null,
    showTime time not null,
    showDay date not null,
    idMovieApi int not null,
    #id de la Movie de la Api
    idRoom int not null,
    statusShow bool default 1,
    constraint Pk_Id_Show primary key (id),
    constraint Fk_Id_Movie foreign key (idMovieApi) references Movies(id),
    constraint Fk_Id_Room foreign key (idRoom) references Rooms(id)
);
create table if not exists ShowxUser(
    id int auto_increment not null,
    idUser int not null,
    idShow int not null,
    constraint Pk_ShowxUser primary key (id),
    constraint Fk_Users_sxu foreign key (idUser) references Users (id),
    constraint Fk_Shows_sxu foreign key (idShow) references Shows (id)
);
create table if not exists Tickets (
    id int auto_increment not null,
    price float,
    idShow int not null,
    idUser int not null,
    quantity smallint not null,
    total float,
    constraint Pk_Id_Ticket primary key (id),
    constraint Fk_Id_Show foreign key (idShow) references Shows (id),
    constraint Fk_Id_User foreign key (idUser) references Users (id)
);