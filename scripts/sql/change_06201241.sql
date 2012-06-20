alter table member add email varchar(50) not null;
alter table member add unique (`email`);
alter table member add passwd varchar(50) not null;
alter table member add first_name varchar(50);
alter table member add last_name varchar(50);
alter table member drop auth_id;

alter table admin add email varchar(50) not null;
alter table admin add unique (`email`);
alter table admin add passwd varchar(50) not null;
alter table admin add first_name varchar(50);
alter table admin add last_name varchar(50);
alter table admin drop auth_id;
