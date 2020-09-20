create database contact;
use contact;

create table users (
    id INT PRIMARY KEY AUTO_INCREMENT not null,
    name VARCHAR(50) not null,
    email VARCHAR(50) not null,
    title VARCHAR(50) null,
    msg VARCHAR(500) null,
    created_at timestamp default current_timestamp
);


create table newsletter (
    id INT PRIMARY KEY AUTO_INCREMENT not null,
    name VARCHAR(50) not null,
    email VARCHAR(50) not null,
    created_at timestamp default current_timestamp
);

