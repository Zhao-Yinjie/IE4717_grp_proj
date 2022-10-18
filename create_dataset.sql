
create table movie(
    movie_id int primary key AUTO_INCREMENT,
    title varchar(100) not null,
    poster_dir varchar(200) not null,
    details varchar(500) not null,
    synopsis varchar(500) not null,
    timeslot varchar(500) not null,
    seat varchar(1000) not null,
    price float not null
);

create table orders(
    order_id int primary key AUTO_INCREMENT,
    movie_id int not null,
    userid int not null,
    timeslot varchar(100) not null,
    seat varchar(200) not null,
    price float not null,
    successful_payment boolean not null
);

create table user_account(
    userid int primary key AUTO_INCREMENT,
    username varchar(100) not null,
    user_pwd varchar(100) not null,
    email varchar(100) not null
);
