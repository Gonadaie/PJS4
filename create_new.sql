drop table if exists student CASCADE;
drop table if exists student_match CASCADE;
drop table if exists message CASCADE;
drop table if exists adjective CASCADE;
drop table if exists token_on_create CASCADE;
drop table if exists token_keep_me_logged CASCADE;
drop table if exists token_forgot_passwd CASCADE;
drop table if exists conversation CASCADE;
 
create table adjective (
    id_adjective SERIAL primary key,
    wording varchar(30) not null
);
 
create table student (
    student_id SERIAL primary key,
    surname varchar(30) not null,
    email varchar(50) not null UNIQUE,
    student_password text not null,
    year integer not null,
    pic varchar(300), 
    description text,
    score integer default 0,
    adjective_1 integer ,
    adjective_2 integer ,
    adjective_3 integer ,
    admin boolean default false,
    validate_account boolean default false,
    foreign key (adjective_1) references adjective(id_adjective) ,
    foreign key (adjective_2) references adjective(id_adjective),
    foreign key (adjective_3) references adjective(id_adjective)
);
 
create table student_match (
    id_match SERIAL primary key,
    result boolean default false, 
    student_id_god_father integer not null,
    student_id_god_son integer not null,
    liked_by_god_father integer default -1,
    liked_by_god_son integer default -1, 
    final boolean default false,
    final_by_god_father boolean default false,
    final_by_god_son boolean default false,
    foreign key (student_id_god_father) references Student(student_id) on delete cascade,
    foreign key (student_id_god_son) references Student(student_id) on delete cascade
);
create table conversation (
    conversation_id SERIAL primary key,
    birth timestamptz default now(),
	last_message timestamptz default now(),
    student_1 integer,
    student_2 integer,
    foreign key (student_1) references Student(student_id) on delete cascade,
    foreign key (student_2) references Student(student_id) on delete cascade
 
);
create table message (
    message_id SERIAL primary key,
    conversation_id integer,
    message_date timestamptz default now(),
    content text,
    sender_id integer,
	flag_read boolean default false,
    foreign key (sender_id) references Student(student_id),
    foreign key (conversation_id) references conversation(conversation_id) on delete cascade
);
 
create table token_on_create (
    id_token_oncr SERIAL primary key,
    birth date,
    hash_oncr varchar(32),
    is_alive boolean default true,
    student_id integer,
    foreign key (student_id) references student(student_id) on delete cascade
);
 
create table token_keep_me_logged (
    id_token_kml SERIAL primary key,
    birth date,
    hash_kml varchar(32),
    is_alive boolean default true,
    student_id integer,
    foreign key (student_id) references student(student_id) on delete cascade
);
 
create table token_forgot_passwd (
    id_token_fp SERIAL primary key,
    birth date,
    hash_fp varchar(32),
    is_alive boolean default true,
    student_id integer,
    foreign key (student_id) references student(student_id) on delete cascade
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
