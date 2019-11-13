----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.8.2
-- Exported: 7:46am on September 24, 2019 (UTC)
-- database file: ../proyects/sigebi/database\sigebi.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for status
----

----
-- Data dump for status, a total of 3 rows
----
INSERT INTO "status" ("id","nombre") VALUES ('1','Disponible');
INSERT INTO "status" ("id","nombre") VALUES ('2','Prestado');
INSERT INTO "status" ("id","nombre") VALUES ('3','Perdido');
COMMIT;
