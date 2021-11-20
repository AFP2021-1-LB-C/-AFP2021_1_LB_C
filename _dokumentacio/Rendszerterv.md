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
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    name | varchar típusú mező | a kurzus neve.
    user_id | int típusú mező  
    description | text típusú mező  
    

**Users Tábla** (A felhasználók adatait leíró tábla)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    name | varchar típusú mező 
    age | tinyint típusú mező 
    role_ide | int típusú mező 
    username | varchar típusú mező 
    email | varchar típusú mező | email címet tartalmaző mező
    password | varchar típusú mező | jelszót tartalmaző mező
    registration_date | datetime típusú mező | regisztráció dátuma
    last_login_date | datetime típusú mező | utolsó bejelentkezés dátuma

**Lessons Tábla** (Órák adatait leíró tábla)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    topic | varchar típusú mező 
    course_id | int típusú mező 
    content | text típusú mező

**Quiz_questions Tábla** (Kérdéseket leíró tábla)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    question | varchar típusú mező | a kérdést tároló mező
    answer_1 | varchar típusú mező | az első választ tároló mező
    answer_2 | varchar típusú mező | a máasodik választ tároló mező
    answer_3 | varchar típusú mező | a harmadik választ tároló mező
    answer_4 | varchar típusú mező | a nagyedik választ tároló mező
    correct_answer | tinyint típusú mező | a helyes válasz sorszáma

**Quiz_result Tábla** (AZ eredményeket tartalmazó tábla)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    quiz_result | int típusú mező 
    answer | tinyint típusú mező 
    user_id | int típusú mező 

**Quiz_types Tábla** (Kvízek típusai)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    name | varchar típusú mező 

**Roles Tábla** (Szerepkörök)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    name | varchar típusú mező 

**Scheuldes Tábla** (Vizsga menetrend)<br>
    id | int típusú mező | a kurzus azonosítója,ELSŐDLEGES KULCS.
    type | int típusú mező 
    date | datetime típusú mező 
    course_id | int típusú mező 



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
