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

- Üzleti szereplők:
  - Felhasználók: Felhasználóvá a felületen történő regisztrációval válhat a látogató. A regisztráció során szerzett jogosultság határozza meg, hogy a felhasználó milyen funkciókhoz férhozzá a felületen. A felhasználóknak 3 csoportját különböztetjük meg:
    - Tanár: A tanár jogosultsággal rendelkező felhasználók képesek kurzusokat létrehozni, tananyagokat feltölteni, teszteket létrehozni. A tanárok hagyják jóvá a diákok kurzusra történő jelentkezését. Továbbá adatlapuk megtekintésére és szerkesztésére is lehetőségük van.
	- Diák: A diák jogosultságal endelkező felhasználők képesek azon kurzusok tananyagát/tesztjeit megtekinteni/kitölteni amelyekhez hozzáférést kaptak. Továbbá megtekinthetik és szerkeszthetik adalapjukat.
	- Adminisztrátor: Az adminidztrátor jogkört nem igényelheti a felhasználó. Azt a rendszer üzemeltetője osztja ki. Teljes hozzáféréssel rendelkeznek az összes funkcióhoz. Képes a tananyagok és tesztek teljeskörű menedzselésére, valamint a hibakezelések is az ő jogkörébe tartoznak.

- Üzleti folyamatok: 
  
  - Felhasználó regisztrációja: A felhasználó egy regisztrációs form kitöltésével tud regisztrálni. A sikeres regisztrációhoz az alábbi adatok megadása szükséges.    
    - Felhasználónév: Egyedinek kell lennie.
	- Jelszó: Legalább 6 karakter hosszúságúnak kell lennie.
	- Jelszó megerősítése: A megadott jelszóval megegyezőnek kell lennie.
	
	A jelszavalók hashelve kerülnek az adatbázisba.
	
  - Felhasználó azonosítása: A felhasználó a bejelentkezés során a megfelelő mezőkbe megadja felhasználónevét és jelszavát, majd a rendszer ellenőrzi, hogy a felhasználó szerepel-e az adatbázisban. Amennyiben szerepel, a jelszóea a megfelelő titkosítási algoritmust alkalmazza és ellenőrzi, hogy a felhasználóhoz tárolt jelszó megegyezik-e a felhasználó által bevittel. Ha az azonosítás sikeres, a felhasználó az e-learnng nyitó oldalára kerül. Amennyiben az azonosítás sikertelen, a rendszer a megfelelő hibaüzenettel értesíti a felhasználót.
  - Jelszó visszaállítása: Ez a funkció lehetőséget biztosít a jelszó visszaállítására, ha a felhasználó elfelejtette azt. Új jelszó beállítása során a felhasználónak meg kell adnia felhasználónevét, az új jelszót és a jelszó megerősítése érdekében újra az új jelszót. Az új jelszónak is legalább 6 karakter hosszúnak kell lennie.
  - Profiladatok módosítása: A felhasználók számára biztosít lehetőséget hogy felhasználónevüket és/vagy jelszavukat módosítsák. Módosítás során az adatoknak a regisztráció során felsorolt tényezőknek kell megfelelni.
  - Tananyag feltöltése: Taná jogosultságú felhasználónak lehetősége van új tananyagokat feltölteni,a feltöltött anyagot módosítani és törölni is. Ezeket a tananyagokat azok a diákok tudják olvasni, akik hozzáférést kaptak a tananyagokhoz.
  - Tesztek feltöltése: A rendszer lehetőséget biztosít a tanárok számára az általuk létrehozott tananyagokhoz tesztek feltöltésére. Ezen tesztek kitöltésével tudják a tnulók tudását ellenőrizni.
  - Hozzáférés igénylése: Diákok számára elérhető funkció, mellyel a számukra szükséges tananyagokhoz igényelhetnek hozzáférést, amit a tananyagot létrehozó tanár tud megadni.
  - Tesztek megírása: Diákok számára lehetséges a tananyag elolvasása után a tananyaghoz tartozó teszteket megírni.
  - Tesztek eredménye: A tesztek megírása után egy értékelés látható a tesztek végeredményével.

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