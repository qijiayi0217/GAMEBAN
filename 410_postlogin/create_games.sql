Set FOREIGN_KEY_CHECKS = 0;
drop table if exists comment;
drop table if exists games;
drop table if exists 410users;
Set FOREIGN_KEY_CHECKS = 1;

create table 410users(
UserName varchar(20) not null,
Password varchar(20) not null,
age int,
gender varchar(20),
primary key(UserName)
);

create table games(
gameName varchar(20) not null,
category varchar(20),
description text,
primary key(gameName)
);

create table comment(
UserName varchar(20) not null,
gameName varchar(20) not null,
content varchar(200) not null,
create_date datetime not null, 
number_of_like int,
primary key (UserName, gameName, content),
foreign key (UserName) references 410users(UserName) on delete cascade,
foreign key (gameName) references games(gameName) on delete  cascade
);
