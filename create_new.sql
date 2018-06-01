drop table if exists student CASCADE;
drop table if exists matched CASCADE;
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
    id_match integer ,
    admin boolean default false,
    validate_account boolean default false,
    foreign key (adjective_1) references adjective(id_adjective) ,
    foreign key (adjective_2) references adjective(id_adjective),
    foreign key (adjective_3) references adjective(id_adjective),
    foreign key (id_match) references matched(id_match)   
);
 
create table matched (
    id_match SERIAL primary key,
    result boolean default false, 
    id_student_god_father integer not null,
    id_student_god_son integer not null,
    liked_by_god_father boolean default false,
    liked_by_god_son boolean default false, 
    final default false,
    foreign key (id_student_god_father) references Student(id_student),
    foreign key (id_student_god_son) references Student(id_student)
);
create table conversation (
    id_conversation SERIAL primary key,
    birth date,
    student_1 integer,
    student_2 integer,
    foreign key (student_1) references Student(id_student),
    foreign key (student_2) references Student(id_student)
 
)
create table message (
    id_message SERIAL primary key,
    id_conversation integer not null,
    date_message date,
    content text,
    id_sender integer not null,
    foreign key (id_sender) references Student(id_student),
    foreign key (id_conversation) references conversation(id_conversation)
);
 
create table token_on_create (
    id_token_oncr SERIAL primary key,
    birth date,
    hash_oncr varchar(32),
    is_alive boolean default true,
    id_student integer,
    foreign key (id_student) references student(id_student) on delete cascade
);
 
create table token_keep_me_logged (
    id_token_kml SERIAL primary key,
    birth date,
    hash_kml varchar(32),
    is_alive boolean default true,
    id_student integer,
    foreign key (id_student) references student(id_student) on delete cascade
);
 
create table token_forgot_passwd (
    id_token_fp SERIAL primary key,
    birth date,
    hash_fp varchar(32),
    is_alive boolean default true,
    id_student integer,
    foreign key (id_student) references student(id_student) on delete cascade
);
 
insert into adjective (wording) values ('Froid') ;
insert into adjective (wording) values ('Calculateur') ;
insert into adjective (wording) values ('Michto') ;
insert into adjective (wording) values ('Chaud') ;
insert into adjective (wording) values ('Studieux') ;
insert into adjective (wording) values ('Geek') ;
insert into adjective (wording) values ('Cr�dule') ;
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
insert into adjective (wording) values ('Cr�atif') ;
insert into adjective (wording) values ('Coquin') ;
insert into adjective (wording) values ('Mauvais joueur') ;
insert into adjective (wording) values ('Franc') ;
insert into adjective (wording) values ('Serviable') ;
insert into adjective (wording) values ('Timide') ;
insert into adjective (wording) values ('Souple') ;
insert into adjective (wording) values ('Arogant') ;
insert into adjective (wording) values ('Charmant') ;
insert into adjective (wording) values ('Cin�phile') ;
insert into adjective (wording) values ('Gamer') ;
insert into adjective (wording) values ('Dynamique') ;
insert into adjective (wording) values ('Drole') ;
insert into adjective (wording) values ('Sudiste') ;
insert into adjective (wording) values ('Tyranique') ;
insert into adjective (wording) values ('Sociable') ;
insert into adjective (wording) values ('Fetard') ;
insert into adjective (wording) values ('Extravertis') ;
insert into adjective (wording) values ('Gourmand') ;
insert into adjective (wording) values ('A l''�coute') ;
insert into adjective (wording) values ('Vrai') ;
insert into adjective (wording) values ('Faux') ;
insert into adjective (wording) values ('Digne de confiance') ;
