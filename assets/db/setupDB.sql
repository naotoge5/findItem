drop database if exists kittydb;
create database kittydb;
use kittydb;
/*↓を使う*/
drop user if exists kitty@localhost;
create user 'kitty'@'localhost' identified by 'pro02';
/*mysql8.0~*/
/*create user 'kitty'@'localhost' identified with mysql_native_password by 'pro02';*/
/*権限の付与*/
grant all on kittydb.* to 'kitty' @'localhost';
create table companies (
    id int auto_increment primary key,
    name varchar(100) not null,
    tel varchar(100) null,
    postal varchar(100) not null,
    prefecture varchar(100) not null,
    city varchar(100) not null,
    town varchar(100) not null,
    details text,
    mail varchar(100) not null,
    password varchar(100) not null
);
create table objects (
    id int auto_increment primary key,
    name varchar(100) not null,
    details text,
    category varchar(100) not null,
    datetime datetime,
    company_id int not null
);
create table pre_companies (
    id int auto_increment primary key,
    token varchar(128) not null,
    mail varchar(100) not null,
    datetime datetime not null
);