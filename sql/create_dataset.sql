
create table movie(
    movie_id int primary key AUTO_INCREMENT,
    title varchar(100) not null,
    poster_dir varchar(200) not null,
    details varchar(500) not null,
    synopsis varchar(500) not null,
    timeslot_index varchar(500) not null,
    price float not null
);

create table orders(
    order_id int primary key AUTO_INCREMENT,
    movie_id int not null,
    userid int not null,
    timeslot_index varchar(100) not null,
    seat_index varchar(200) not null,
    price float not null,
    paid boolean not null,
    cart boolean not null
);

create table user_account(
    userid int primary key AUTO_INCREMENT,
    username varchar(100) not null,
    user_pwd varchar(100) not null,
    email varchar(100) not null
);

create table cinema( -- {seat_name}; {timeslot_id: timeslot}
    seats varchar(2000) not null,
    timeslots varchar(2000) not null
);


