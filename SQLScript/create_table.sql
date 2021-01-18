/* 
 * 此脚本建表不一定正确，后期对数据库进行了调整，以数据库图片为准
 */

create database test_db;
create database RMS;


-- creat table
create table building (
  Bno varchar(20) primary key,
  Ano varchar(20) not null,
  foreign key (Ano) references administrator(Ano)
);

create table student
(
	Sno varchar(20) not null,
	Spasswd varchar(20) not null,
	constraint passwd_constraint check (length(Spasswd) >= 6),
	Sname varchar(20),
	Ssex varchar(2),
	constraint Ssex_constraint check(Ssex in('男','女')),
	Sdepartment varchar(20),
	Sclass varchar(20),
	Stel varchar(11),
	Saddress varchar(80),
	Sin boolean,
	Sstay boolean,
	Bno varchar(20),
	foreign key (Bno) references building (Bno),
	Rno varchar(20),
	foreign key (Rno) references room (Rno)

);
alter table student add column SleftTime date after Sdepartment;

create table administrator
(
  Ano varchar(20) primary key ,
  Apasswd varchar(20) not null,
  Aname varchar(20),
  Asex varchar(2),
  constraint sex_constraint check(Asex in('男','女')),
  Atel varchar(11)
);
-- 增加administrator表密码约束
alter table administrator add constraint Apasswd_constraint check (length(Apasswd) >= 6);


create table room
(
    Rno varchar(20) primary key ,
    Rcapacity smallint,
    Bno varchar(20),
    foreign key (Bno) references building(Bno),
    Rfloor varchar(20)
);

alter table building
    drop primary key;

create table e_arrange(
    EBno varchar(20) not null,
    EAno varchar(20) not null,
    foreign key (EAno) references administrator (Ano),
    foreign key (EBno) references building (Bno)
);


alter table room add column Bno varchar(20) after Rcapacity;
alter table room add foreign key (Bno) references building(Bno);


create table student_room (
    Sno varchar(20) not null,
    Rno varchar(20),
    Bno varchar(20),
    foreign key (Sno) references student(Sno),
    foreign key (Rno, Bno) references room(Rno, Bno)
);



create table test(
    A varchar(20),
    B varchar(20),
    foreign key (B) references test_refeA(A),
    primary key (A, B)
);

create table test_refeA(
    A varchar(20) primary key
);
alter table room add column Bno varchar(20) after Rno;
alter table room add primary key (Rno, Bno);

alter table room add foreign key (Bno) references building(Bno);


alter table student add primary key (Sno);

alter table room_admin add foreign key (Bno) references building (Bno);
alter table room_admin add foreign key (Ano) references administrator (Ano);