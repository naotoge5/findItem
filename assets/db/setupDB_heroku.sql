use heroku_c356dc99892b5ac;
drop table if exists companies;
drop table if exists objects;
drop table if exists pre_companies;
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
    /*object_update datetime*/
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