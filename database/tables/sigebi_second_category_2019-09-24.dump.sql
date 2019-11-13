----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.8.2
-- Exported: 8:55pm on September 25, 2019 (UTC)
-- database file: ../proyect/sigebi/database\sigebi.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for second_category
----
CREATE TABLE "second_category" ("id" integer not null primary key autoincrement, "concepto" varchar not null, "first_category_id" integer not null);

----
-- Data dump for second_category, a total of 99 rows
----
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('0','Generalidades','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('10','Bibliografía ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('20','Bibliotecología y ciencias de la información ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('30','Obras enciclopédicas generales ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('50','Publicaciones en serie generales ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('60','Organizaciones generales & museología ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('70','Medios noticiosos, periodismo, publicación ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('80','Colecciones generales ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('90','Manuscritos & libros raros ','0');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('100','Filosofía & psicología ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('110','Metafísica ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('120','Epistemología, causalidad, género humano ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('130','Fenómenos paranormales ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('140','Escuelas filosóficas específicas ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('150','Psicología ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('160','Lógica ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('170','Ética (filosofía moral) ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('180','Filosofía antigua, medieval, oriental  ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('190','Filosofía moderna occidental ','100');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('200','Religión ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('210','Filosofía y teología de la relig. ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('220','La Biblia ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('230','Cristianismo; Teología cristiana ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('240','Moral cristiana & teología piadosa ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('250','Ordenes cristianas & iglesia local ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('260','Teología social y eclesiástica ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('270','Historia del cristianismo y de la iglesia cristiana ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('280','Confesiones & sectas cristianas ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('290','Religión comparada y otras religiones  ','200');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('300','Ciencias sociales ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('310','Colecs. de estadística general ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('320','Ciencia política ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('330','Economía ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('340','Derecho ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('350','Administración  pública y ciencia militar ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('360','Problemas y servicios sociales; asociaciones ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('370','Educación ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('380','Comercio, comunicaciones, transporte ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('390','Costumbres, etiqueta, folclor ','300');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('400','Lenguas ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('410','Lingüística ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('420','Inglés e inglés antiguo ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('430','Lenguas germánicas Alemán ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('440','Lenguas romances Francés ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('450','Italiano, rumano, retorromano ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('460','Lenguas española y portuguesa ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('470','Lenguas itálicas Latín ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('480','Lenguas helénicas Griego clásico ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('490','Otras lenguas ','400');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('500','Ciencias naturales & matemáticas ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('510','Matemáticas ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('520','Astronomía y ciencias afines ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('530','Física ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('540','Química y ciencias afines ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('550','Ciencias de la tierra ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('560','Paleontología, Paleozoología ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('570','Ciencias de la vida. Biología ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('580','Ciencias botánicas. Plantas ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('590','Ciencias zoológicas. Animales  ','500');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('600','Tecnología (Ciencias aplicadas)','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('610','Ciencias médicas Medicina ','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('620','Ingeniería & operacionesafines','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('630','Agricultura y tecnologías relacionadas','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('640','Economía doméstica & vidafamiliar','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('650','Gerencia y servicios auxiliares','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('660','Ingeniería Química ','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('670','Manufactura ','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('680','Manufactura para usos específicos','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('690','Construcción ','600');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('700','Las artes. Bellas artes ydecorativas','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('710','Urbanismo & arte del paisaje ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('720','Arquitectura del paisaje ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('730','Artes plásticas, Escultura ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('740','Dibujo & artes decorativas ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('750','Pintura & pinturas ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('760','Artes gráficas, Arte de grabar y grabados','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('770','Fotografía & fotografías ','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('780','Música','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('790','Artes recreativas y de la actuación','700');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('800','Literatura & retórica','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('810','Literatura norteamericana en inglés','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('820','Literatura inglesa e inglesa antigua','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('830','Literatura de las lenguasgermánicas','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('840','Literaturas de las lenguas romances','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('850','Literaturas italiana, rumana, retorromana','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('860','Literatura española & portuguesa','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('870','Literaturas itálicas, Literatura latina','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('880','Literaturas helénicas, Literatura griega clásica','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('890','Literatura de otras lenguas','800');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('900','Geografía & historia ','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('910','Geografía y viajes','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('920','Biografía, genealogía, insignias','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('930','Historia del mundo antiguo','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('940','Historia general de Europa','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('950','Historia general de Asia. Lejano Oriente','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('960','Historia general de África','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('970','Historia general de América del Norte','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('980','Historia general de América del Sur','900');
INSERT INTO "second_category" ("id","concepto","first_category_id") VALUES ('990','Historia general de otras áreas','900');
COMMIT;
