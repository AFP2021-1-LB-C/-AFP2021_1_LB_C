# 1. A rendszer célja

...

# 2. Projekt terv

A projekt egy e-learning alkalmazás, ami PHP alapokon nyugszik. E mellett HTML-t, CSS-t és JavaScript-et használunk. Az adatbázis MySQL. Minden részt a fejlesztőcsapat minden tagja fejleszti. 
A feladatok kiosztását és ütemtervét Trelloban vezetjük, a projectet pedig GIT használatával fejlesztjük közösen. A kommunikáció discordon folyik hang és szöveges csatornákon. 

Project ütemterve:

1. Alkalmazásötlet egyztetése
2. A fejlesztőkörnyezetek egyeztetése
3. Ütemterv
4. Követelmény specifikáció
5. Funkcionális specifikáció
6. Rendszerterv
7. Adatbázis kialakítása
8. Backend funkciók elkészítése
9. Frontend design megtervezése
10. Felhasználói felület kialakítása
11. Tesztelés
12. Bemutatás / Átadás

# 3. Üzleti folyamatok modellje

...

# 4. Követelmények

...

# 5. Funkcionális terv

...

# 6. Fizikai környezet

...

# 7. Absztrakt domain modell

...

# 8. Architekturális terv

...

# 9. Adatbázis terv

A szükséges adatokat MySQL adatbázisban tároljuk, itt lesznek a felhasználói és tananyagok adatai, továbbá a teszteléshez szükséges adatok is.

Az adatbázis adattáblái:


**Courses Tábla** (A kurzus adatait leíró tábla)<br>
| Mező        	| Típus   	| Leírás                               	|
|-------------	|---------	|--------------------------------------	|
| id          	| int     	| kurzus azonosítója, elsődleges kulcs 	|
| name        	| varchar 	| kurzus neve                          	|
| user_id     	| int     	|                                      	|
| description 	| text    	|                                      	|


    

**Users Tábla** (A felhasználók adatait leíró tábla)<br>
| Mező              	| Típus  	|        Leírás                	|
|-------------------	|----------	|-----------------------------	|
| name               	| varchar  	|                             	|
| age               	| tinyint  	|                             	|
| role_ide          	| int      	|                             	|
| username          	| varchar  	|                             	|
| email             	| varchar  	| email címet tartalmaző mező 	|
| password          	| varchar  	| jelszót tartalmazó mező     	|
| registration_date 	| datetime 	| regisztráció dátuma         	|
| last_login_date 	    | datetime 	| utolsó bejelentkezés dátuma   |


**Lessons Tábla** (Órák adatait leíró tábla)<br>
| Mező        	| Típus   	| Leírás                              	|
|-------------	|---------	|--------------------------------------	|
| id          	| int     	| kurzus azonosítója, elsődleges kulcs 	|
| topic        	| varchar 	|                                    	|
| course_id     | int     	|                                      	|
| content   	| text    	|                                      	|

**Quiz_questions Tábla** (Kérdéseket leíró tábla)<br>
| Mező          	| Típus   	| Leírás                              	|
|-------------	    |---------	|--------------------------------------	|
| id            	| int     	| kurzus azonosítója, elsődleges kulcs 	|
| question       	| varchar 	| kérdést tároló mező    	            |
| answer_1       	| varchar 	| 1. válasz              	            |
| answer_2       	| varchar 	| 2. válasz                         	|
| answer_3       	| varchar 	| 3. válasz                         	|
| answer_4       	| varchar 	| 4. válasz                         	|
| correct_answer 	| varchar 	| helyes válasz sorszáma 	            |

**Quiz_result Tábla** (AZ eredményeket tartalmazó tábla)<br>
| Mező          	| Típus   	| Leírás                              	|
|-------------	    |---------	|--------------------------------------	|
| id            	| int     	| kurzus azonosítója, elsődleges kulcs 	|
| quiz_result       | varchar 	|    	                                |
| answer       	    | tinyint 	|               	                    |
| user_id       	| int 	    |                                      	|


**Quiz_types Tábla** (Kvízek típusai)<br>
    | Mező          	| Típus   | Leírás                                 	|
    |------------------ |---------|---------------------------------------- |
    | id            	| int     | kurzus azonosítója, elsődleges kulcs 	|
    | name              | varchar |                                         |

**Roles Tábla** (Szerepkörök)<br>
    | Mező          	| Típus   | Leírás                                 	|
    |------------------ |---------|----------------------------------------	|
    | id            	| int     | kurzus azonosítója, elsődleges kulcs 	|
    | name              | varchar |                                         |

**Scheuldes Tábla** (Vizsga menetrend)<br>
    | Mező          	| Típus   | Leírás                                 	|
    |------------------ |---------|----------------------------------------	|
    | id            	| int     | kurzus azonosítója, elsődleges kulcs 	|
    | type              | int     |                                         |
    | date              | datetime|                                         |
    | course_id         | int     |                                         |



# 10. Implementációs terv

A webes felület HTML, CSS, PHP és Java Scipt nyelven fog elkészülni. A különböző technológiákat amennyire lehet, külön fájlokba írva készítjük el, úgy csatoljuk egymáshoz. Így átláthatóbb, könnyebben változtatható és bővíthető lesz. Az oldal felhasználóinak adatait MySQL adatbázisban fogjuk eltárolni. Backend részen a kiszolgáló egy PHP-ban készült szolgáltatás lesz.

Funkciók:

- Regisztráció
- Login
- Logout
- Jelszóváltoztatás
- Tananyagok létrehozása
- olvasás
- új/szerkesztése
- törlése
- Tesztek létrehozása, módosítása
- eredmények megjelenítése (felhasználókra bontva)
- teszt és eredmények törlése
- Jogosultságok kiosztása a tananyag és teszt hozzáférésekhez (tanári és admin fiók)

# 11. Tesztterv

...

# 12. Telepítési terv

...
