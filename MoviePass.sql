create database MoviePass;
use MoviePass;

create table if not exists Cinema(
    id_cinema int auto_increment not null,
	cinema_name varchar(50),
    statusCinema bool default 1,
    cinema_address varchar (50),
    cinema_capacity int,
    ticket_price float,
    constraint Pk_id_cinema primary key (id_cinema)
    );


create table  if not exists Users (
    id_user int auto_increment,
    user_name varchar (50),
    user_lastName varchar (50),
    user_mail varchar (50) unique,
    user_pass varchar (20),
    constraint Pk_users primary key (id_user)
    );

create table  if not exists Movies (
	id_movie_api int,
    name_movie varchar(500),
    summary varchar(1000),
    lenguage varchar(10),
    dir_image varchar(80),
    playingNow bool default 0,
    releaseDate date,
    constraint PK_movie primary key (id_movie_api) 
    );

create table  if not exists Genres (
   id_gender_api int,
   gender_tipe varchar (20),
   constraint PK_gender primary key (id_gender_api)
   );
   
create table  if not exists MovieXgender (
    id_movie_api int,
    id_gender_api int,
    constraint PK_mXg primary key (id_movie_api,id_gender_api) ,
    constraint FK_movie foreign key (id_movie_api) references Movies (id_movie_api),
    constraint FK_gender foreign key (id_gender_api) references Genres (id_gender_api)
    );


create table if not exists Rooms(
    id_room int auto_increment not null unique,
    room_name varchar(50),
    room_capacity int,
    id_cinema int,
     statusRoom bool default 1,
    constraint Pk_id_room primary key(id_room),
   constraint Fk_Cinema_id_cinema foreign key (id_cinema) references Cinema (id_cinema));

create table if not exists Shows(
    id_show int auto_increment not null,
    show_time time,
    show_day date,
    id_movie_api int not null,
    id_room int not null,
    statusShow bool default 1,
    constraint Pk_id_show primary key (id_show),
    constraint Fk_id_movie foreign key (id_movie_api) references Movies(id_movie_api),
    constraint Fk_id_room foreign key (id_room) references Rooms(id_room)
    );
    


create table if not exists ShowxUser(
id_sxu int auto_increment not null,
id_user int not null,
id_show int not null,
constraint Pk_ShowxUser primary key (id_sxu),
constraint Fk_users_sxu foreign key (id_user) references Users (id_user),
constraint Fk_shows_sxu foreign key (id_show) references Shows (id_show));


create table if not exists Tickets
(
    id_ticket       int auto_increment not null unique,
    ticket_price    float,
    id_show         int                not null,
    id_user         int                 not null ,
    ticket_quantity smallint           not null,
    ticket_subtotal float,
    constraint PK_id_ticket primary key (id_ticket),
    constraint FK_id_show foreign key (id_show) references Shows (id_show)
);



