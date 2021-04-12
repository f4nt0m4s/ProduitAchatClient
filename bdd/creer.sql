-------------------------------------------------------
-- cas PAC
-------------------------------------------------------
-- script creer.sql
-- connexion a postgresql:    	$plsql di-a2-17
-- execution du script:		=>\i creer.sql
-- verif:			=>\dt
-------------------------------------------------------


drop table if exists achat cascade;
drop table if exists client cascade;
drop table if exists produit cascade;

create table client
       (ncli 	integer primary key ,
        nom 	varchar(10),
	ville   varchar(20));
   
create table produit
	(np 	integer primary key ,
 	 lib 	varchar(20),
 	 coul 	varchar(10),
 	 qs 	integer check (qs>=0)); 

create table achat
	(ncli 	integer references client(ncli),
	 np 	integer references produit(np),
	 qa 	integer check (qa>=0),
	 primary key(ncli,np));

