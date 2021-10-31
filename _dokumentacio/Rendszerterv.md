# 1. A rendszer célja

A rendszer célja egy olyan weboldal létrehozása, ahol a tanuló a tanár által közzétett tananyagot digitális formában sajátíthatja el, egy felhasználóbarát környezetben.
A tanárok gyorsan és egyszerűen hozhatnak létre tananyagokat és feladatokat az oldalon. Minden tananyaghoz kapcsolódhat egy feladat, hogy a tanár megtekinthesse, hogy mennyire sikerült a diákoknak feldolgozni az adott tananyagot. A feladatok a diákok számára is visszanézhetőek, így megtekinthetik, hogy mit tudtak helyesen megoldani és mi volt az amit elrontottak.

Az oldal használatához be kell jelentkezni a megfelelő felhasználói fiókkal. Az első bejelentkezés előtt regisztrálni kell egy új felhasználót a rendszerbe.

Az oldalt négy különböző típusú felhasználóval lehet használni:
- **Vendég felhasználó:** nem kell bejelentkeznie, de nem is csatlakozhat semmilyen kurzushoz, csak megtekintheti azokat.
- **Tanuló:** bejelentkezés után megtekintheti a kurzusokra feltöltött tananyagokat és kitöltheti a tananyagokhoz tartozó feladatokat.
- **Tanár:** bejelentkezés után létrehozhat kurzusokat és feltölthet feladatokat és tananyagokat a már meglévő kurzusokhoz.
- **Adminisztrátor:** minden joga megvan, törölhet felhasználókat, kurzusokat, feladatokat és tananyagokat.

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


User Tábla (A felhasználók adatait leíró tábla):

id: A felhasználó azonosítója int típusú mező.
username: A felhasználó felhasználónevét tároló varchar típusú mező.
password: A felhasználó hashelt jelszavát tároló varchar típusú mező.
created_at: A felhasználó fiókjának készítésének idejét tároló timestamp típusú mező.
permission: A felhasználó jogosultságát tároló tinyiint típusú mező.
ClassID: A felhasználó osztályának azonosítóját tároló int típusú mező.

User_class Tábla (A felhasználóhoz tartozó osztályokat leíró tábla):

ID: Az osztály azonosítóját tároló int típusú mező.
Name: A osztály nevét tároló varchar típusú mező.

# 10. Implementációs terv

A webes felület HTML, CSS, PHP és Java Scipt nyelven fog elkészülni. A különböző technológiákat amennyire lehet, külön fájlokba írva készítjük el, úgy csatoljuk egymáshoz. Így átláthatóbb, könnyebben változtatható és bővíthető lesz. Az oldal felhasználóinak adatait MySQL adatbázisban fogjuk eltárolni. Backend részen a kiszolgáló egy PHP-ban készült szolgáltatás lesz.

Funkciók:

- Regisztráció
- Login
- Logout
- Jelszóváltoztatás
- Tananyagok létrehozása,
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