drop table if exists student CASCADE;
drop table if exists match CASCADE;
drop table if exists message CASCADE;
drop table if exists adjective CASCADE;
drop table if exists token CASCADE;
drop table if exists token_keep_me_logged CASCADE;

create table adjective (
	id_adjective SERIAL primary key,
	wording varchar(30) not null
);

create table student (
	id_student SERIAL primary key,
	surname varchar(30) not null,
	email varchar(50) not null UNIQUE,
	password_student text not null,
	year integer not null,
	pic varchar(300), 
	description text,
	score integer default 0,
	adjective_1 integer ,
	adjective_2 integer ,
	adjective_3 integer ,
	validate_account boolean default false,
	foreign key (adjective_1) references adjective(id_adjective) ,
	foreign key (adjective_2) references adjective(id_adjective),
	foreign key (adjective_3) references adjective(id_adjective)  
);

create table match (
	id_match SERIAL primary key,
	result boolean default false, 
	id_student_god_father integer not null,
	id_student_god_son integer not null,
	liked_by_god_father boolean default false,
	liked_by_god_son boolean default false,	
	foreign key (id_student_god_father) references Student(id_student),
	foreign key (id_student_god_son) references Student(id_student)
);

create table message (
	id_message SERIAL primary key,
	id_recipient integer not null,
	date_message date,
	content text,
	id_sender integer not null,
	foreign key (id_sender) references Student(id_student)
);

create table token (
	birth date,
	token varchar(32),
	is_alive boolean default true,
	id_student integer primary key,
	foreign key (id_student) references student(id_student) on delete cascade
);

create table token_keep_me_logged (
	birth date,
	token varchar(32),
	is_alive boolean default true,
	id_student integer primary key,
	foreign key (id_student) references student(id_student) on delete cascade
);

create table token_forgot_passwd (
	birth date,
	token varchar(32),
	id_student integer primary key,
	foreign key (id_student) references student(id_student) on delete cascade
);

insert into adjective (wording) values ('Froid') ;
insert into adjective (wording) values ('Calculateur') ;
insert into adjective (wording) values ('Michto') ;
insert into adjective (wording) values ('Chaud') ;
insert into adjective (wording) values ('Studieux') ;
insert into adjective (wording) values ('Geek') ;
insert into adjective (wording) values ('Crédule') ;
insert into adjective (wording) values ('Stoner') ;
insert into adjective (wording) values ('Beau') ;
insert into adjective (wording) values ('Intelligent') ;
insert into adjective (wording) values ('Sportif') ;
insert into adjective (wording) values ('Magnifique') ;
insert into adjective (wording) values ('Universel') ;
insert into adjective (wording) values ('Ambicieux') ;
insert into adjective (wording) values ('Altruiste') ;
insert into adjective (wording) values ('Cupide') ;
insert into adjective (wording) values ('Sympatique') ;
insert into adjective (wording) values ('Rigoureux') ;
insert into adjective (wording) values ('Créatif') ;
insert into adjective (wording) values ('Coquin') ;
insert into adjective (wording) values ('Mauvais joueur') ;
insert into adjective (wording) values ('Franc') ;
insert into adjective (wording) values ('Serviable') ;
insert into adjective (wording) values ('Timide') ;
insert into adjective (wording) values ('Souple') ;
insert into adjective (wording) values ('Arogant') ;
insert into adjective (wording) values ('Charmant') ;
insert into adjective (wording) values ('Cinéphile') ;
insert into adjective (wording) values ('Gamer') ;
insert into adjective (wording) values ('Dynamique') ;
insert into adjective (wording) values ('Drole') ;
insert into adjective (wording) values ('Sudiste') ;
insert into adjective (wording) values ('Tyranique') ;
insert into adjective (wording) values ('Sociable') ;
insert into adjective (wording) values ('Fetard') ;
insert into adjective (wording) values ('Extravertis') ;
insert into adjective (wording) values ('Gourmand') ;
insert into adjective (wording) values ('A l''écoute') ;
insert into adjective (wording) values ('Vrai') ;
insert into adjective (wording) values ('Faux') ;
insert into adjective (wording) values ('Digne de confiance') ;

