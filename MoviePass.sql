create database MoviePass;
use MoviePass;

create table if not exists Cinema(
    idCinema int auto_increment not null,
	nameCinema varchar(50),
    addressCinema varchar (50),
    statusCinema boolean default 1,
    constraint Pk_id_cinema primary key (idCinema)
    );

create table  if not exists Users (
	id int auto_increment,
    userName varchar (50),
    lastName varchar (50),
	email varchar (50) unique,
    userPassword varchar (20),
    constraint Pk_users primary key (id)
    );

create table  if not exists Movies (
	idMovie int, # viene de la Api
    adult bool default 0,
    movieName varchar(500),
    summary varchar(1000),
    movieLanguage varchar(10),
    playingNow bool default 0,
    releaseDate date,
    constraint PK_movie primary key (idMovie) 
    );

create table  if not exists Genres (
   idApi int,
   genreName varchar (20),
   constraint PK_genre primary key (idApi)
   );
   
create table  if not exists MovieXgenres (
	idMovieXgenres int,
    idMovie int,
    idApi int,
    constraint PK_mXg primary key (idMovieXgenres),
    constraint FK_movie foreign key (idMovie) references Movies (idMovie),
    constraint FK_genre foreign key (idApi) references Genres (idApi)
    );


create table if not exists Rooms(
    idRoom int auto_increment not null unique,
    roomName varchar(50),
    capacity int,
    idCinema int,
    roomPrice int,
	statusRoom bool default 1,
    constraint Pk_id_room primary key(idRoom),
   constraint Fk_Cinema_id_cinema foreign key (idCinema) references Cinema (idCinema));

create table if not exists Shows(
    idShow int auto_increment not null,
    showTime time,
    showDay date,
    idMovieApi int not null, #id de la Movie de la Api
    idRoom int not null,
    statusShow bool default 1,
    constraint Pk_id_show primary key (idShow),
    constraint Fk_id_movie foreign key (idMovieApi) references Movies(idMovie),
    constraint Fk_id_room foreign key (idRoom) references Rooms(idRoom)
    );
    


create table if not exists ShowxUser(
id_sxu int auto_increment not null,
id_user int not null,
id_show int not null,
constraint Pk_ShowxUser primary key (id_sxu),
constraint Fk_users_sxu foreign key (id_user) references Users (id),
constraint Fk_shows_sxu foreign key (id_show) references Shows (idShow));


create table if not exists Tickets
(
    idTicket int auto_increment not null unique,
    ticketprice float,
    idShow int not null,
    idUser int not null ,
    quantity smallint not null,
    total float,
    constraint PK_id_ticket primary key (idTicket),
    constraint FK_id_show foreign key (idShow) references Shows (idShow),
	constraint FK_id_User foreign key (idUser) references Users (id)
);