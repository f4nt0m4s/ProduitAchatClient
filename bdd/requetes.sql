------------------------------------------
-- cas PAC TP1
------------------------------------------
-- script requetes.sql
-- requetes sql
-- execution sous postgresql:	=>\i requetes.sql
------------------------------------------

--Partie 1 : Fonctions d'agrégation

--Q1. le nombre d'achats stockés dans la base 
--select count(*) from achat;

--Q2. le nombre de clients différents ayant fait des achats 
--select count(distinct ncli) from achat;

--Q3.le nombre de produits achetés par le client 101 
--select count(np) from achat where ncli=101;

--Q4. la quantité moyenne de produits achetés par le client 101 
--select round(avg(qa),2) as"Moy"from achat where ncli=101;

/*Arrondir 2 chiffres après la virgule */

--Q5. la plus petite quantité de produit achetée par le client 101 
select sum(qa) from achat where ncli=101;

--Q6. la quantité totale de produits achetés par le client 101
select sum(qa) from achat where ncli=101;


--Partie 2 : Tri des tuples

--Q7. la liste des noms des clients triés par ordre alphabétique
select nom from client order by nom;

--Q8. les produits classés par couleur et pour chaque couleur classés par quantité en stock décroissante
select coul, qs from produit
order by coul asc,qs desc;

--Q9. les clients dont le nom commence par R, classés par ordre alphabétique
select nom from client
where nom like'R%' 
order by nom;


--Partie 3 : Requêtes imbriquées 

--Q10. identifiants des produits achetés par les clients parisiens

	--Q10.1. avec une jointure 
	select np from produit natural join achat natural join client where ville='PARIS';
	--Q10.2. avec l'opérateur IN
	select np from produit natural join achat where ncli in (select ncli from client where ville='PARIS');

--Q11. noms des clients qui habitent dans la même ville que Mr. Defrere 
select ville from client where nom='DEFRERE';


select nom from client where ville in (select ville from client where nom='DEFRERE'); 

--Q12. noms des clients ayant acheté au moins un des produits que Mr. Defrere a acheté 
select distinct nom from client natural join achat where nom = 'DEFRERE';

--Q13. nom et couleur du produit ayant la plus grande quantité en stock. 
select lib, coul from produit where qs = (select max(qs) from produit);

--Q14. nom du client qui a acheté la plus grand quantité de crayons bleus 
select lib, coul from produit where qs = (select max(qs) from produit where coul='BLEU');

--Q15. noms et couleurs des produits achetés par au moins un client qui n'est pas parisien

	--Q15.1. avec une jointure 
	select nom, coul from produit natural join achat natural join client where ville !='PARIS';
	
	--Q15.2. avec  NOT IN 
	select lib, coul from produit natural join achat natural join client where ncli <> ALL (select ncli from client where ville = 'PARIS');  













