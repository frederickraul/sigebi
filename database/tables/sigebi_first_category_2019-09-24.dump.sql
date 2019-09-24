----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.8.2
-- Exported: 3:54am on September 24, 2019 (UTC)
-- database file: ../proyects/sigebi/database\sigebi.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for first_category
----
CREATE TABLE "first_category" ("id" integer not null primary key autoincrement, "concepto" varchar not null);

----
-- Data dump for first_category, a total of 10 rows
----
INSERT INTO "first_category" ("id","concepto") VALUES ('0','Generalidades ');
INSERT INTO "first_category" ("id","concepto") VALUES ('100','Filosofía & psicología ');
INSERT INTO "first_category" ("id","concepto") VALUES ('200','Religión ');
INSERT INTO "first_category" ("id","concepto") VALUES ('300','Ciencias sociales ');
INSERT INTO "first_category" ("id","concepto") VALUES ('400','Lenguas ');
INSERT INTO "first_category" ("id","concepto") VALUES ('500','Ciencias naturales & matemáticas ');
INSERT INTO "first_category" ("id","concepto") VALUES ('600','Tecnología (Ciencias aplicadas) ');
INSERT INTO "first_category" ("id","concepto") VALUES ('700','Las artes ');
INSERT INTO "first_category" ("id","concepto") VALUES ('800','Literatura & retórica ');
INSERT INTO "first_category" ("id","concepto") VALUES ('900','Geografía & historia ');
COMMIT;
