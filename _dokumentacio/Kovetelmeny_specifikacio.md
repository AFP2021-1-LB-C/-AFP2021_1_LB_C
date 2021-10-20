# 1. Bevezetés

A rendszer egy tanulást és oktatást segítő alkalmazást próbál megvalósítani a leendő tanulók és tanárok számára. 
A rendszer lényege az, hogy a felhasználók különböző kurzusokat hozhatnak létre illetve meglévő kurzusokhoz csatlakothatnak. 
Az alkalmazásnak meg kell valósítania a felhasználó rendszert, hogy csak azok a diákok csatlakozhassanak kurzushoz és csak azok a tanárok hozhassanak létre kurzust, akik regisztráltak és be vannak jelentkezve.
Ez azért szükséges, hogy a kurzusokban tárolni tudjuk a tanárok által megosztott új tananyagokat és nyomonkövethessük a diákok előrehaladását és teljesítményét. 
Ezeket az adatokat egy adatbázisban kell tárolnunk, hogy később is lekérdezhetőek és módosíthatóak legyenek. 
Sikeres regisztráció után tudunk létrehozni kurzust illetve jelentkezni kurzusra. 
A felhasználók megtekinthetik, teljesíthetik a kurzusokat valamint lehetőséget kell biztosítani az esetleges kérdések feltevésére a tananyaggal kapcsolatban. 
A felhasználókat jogosultsági szintek alapján 3 csoportba lehet osztani:

- **Tanárok:** létrehozhatnak kurzust, megtekinthetik, szerkeszthetik és törölhetik a már meglévő kurzusaikat.
- **Diákok:** csatlakozhatnak kurzushoz, megtekinthetik illetve leadhatják a már felvett kurzust.
- **Vendég:** csak megtekintheti a kurzusokat, de nem csatlakozhat illetve nem is hozhat létre új kurzust.

A tanárok a kurzusokban létrehozhatnak teszteket, feltölthetnek fájlokat és videókat és válaszolhatnak a diákok által feltett kérdésekre.
A diákok teljesítményét a tesztekre kapott értékelések segítségével lehet nyomon követni. 
A tesztek kitöltése után a diákok megnézhetik, hogy mit rontottak el és azt is megtekinthetik, hogy mi lett volna a helyes válasz. 
A diák láthatja a feladatokat, így nyomon tudja követni, hogy mely feladatok várnak még megoldásra.

# 2. Jelenlegi helyzet

Napjainkban az elearning felületeket az iskolák csak igénybe veszik, de nem az iskola terméke a felület. Emiatt az oktatás felülete, körülményei nem teljes mértékben felelnek meg az tanulók igényeinek. A rendszerek problémája még, hogy nem elég gyakorlat orinentáltak a képzések, sokkal inkább elméleti alapokon nyugszik. A felkészüléshez használt tananyagok esetenként nem vagy nehezen érthetően. Illetve az anyag elsajátítása során felmerülő kérdésekre körülményes a válasz megtalálása, mivel nincs egy gyakorlatvezető, aki a válasz megtalálásában segíthetné a felhasználót. Napjainkban többnyire az elearning oldalak fizetősek további nincs lehetőség arra, hogy kurzus diákjai egymás közt megosszák tapasztalataikat a tananyagról. Továbbá nem igazén felhasználóbarát az elearning anyagok mobil felülete.


# 3. Vágyálomrendszer

A projekt célja egy webes tanulásszervezési rendszer, ahol az elérhető funkciók felhasználói kategóriánként eltérőek, például egy diák számára más funkciók elérhetőek mint egy tanár számára, ezért a funkciók csak sikeres regisztráció és bejelentkezés után használhatóak.
Az alap felhasználókon felül kell egy magasabb rendű felhasználó, egy adminisztrátor, aki teljes hozzáféréssel rendelkezik a rendszerben. Az esetleges hibákat neki jelzik a felhasználók. Az admin korlátlanul módosíthatja, törölheti bármelyik kurzust valamint a felhasználók adatait is módosíthatja vagy adhat hozzá új felhasználót.
A többi felhasználó jelentkezhet a kurzusokra de nem módosíthatja azt, csak a sajátjait. 
Adminisztrátori vagy tanári jogosultsági szinttel a felhasználók létrehozhatnak kurzusokat amelyekben tananyagokat, teszteket, feladatokat tölthetnek fel. A kurzusok létrehozása során, készíthetnek komplexebb vagy szimplább kurzusokat, függően attól, hogy milyen céllal, milyen témával fog rendelkezni.


# 4. Jelenlegi üzleti folyamatok modellje

Az oktatási rendszer jelenleg nem használja ki a már meglévő technológiákat arra, hogy a tanulást hatékonyabbá tegye, azáltal hogy szórakoztatóbbá és interaktívabbá tenné azt. Általánosságban Magyarországon a diákok tankönyvekből tanulnak és papír alapon adnak számot legtöbbször lexikális tudásukról, amely a XXI. században elavultnak számít. Ez egy részt rengeteg nyomdai és nyomtatási költséget jelent, másrészt rengeteg időt és energiát emészt fel amit a mai technológiákkal egyszerűen megspórolhatnának. 
Az oktatók nem tudnak párhuzamosan foglalkozni a diákokkal, sőt rengeteg időt elvesz az idejükből az órák és dolgozatok előkészítése, ezen felül a dolgozatok egyesével való kijavítása. Illetve a dolgozatok megírása papíron is sokkal időigényesebb, mintha különböző alkalmazásokat használnánk a diákok számonkérésére és értékelésére. 


# 5. Igényelt üzleti folyamatok modellje

I. **Bejelentkezés**

II. **Regisztráció**

III. **Kurzusok**

a) vendég felhasználóval:
- Kurzus megtekintése

b) diák felhasználóval:
- Kurzus megtekintése
- Kurzus felvétele
- Kurzus leadása

c) tanár felhasználóval:
- Kurzus létrehozása
- Kurzus megtekintése
- Kurzus szerkesztése
- Kurzus törlése

IV. **Előrehaladás megtekintése**

- Megtekintett tananyagok
- Kitöltött feladatok
- Teljesített feladatok

V. **Beállítások**

- Felhasználónév módosítása
- Jelszó módosítása


# 6. Követelménylista

Név | Kifejtés
--- | ----------------------------------------------------------------------
Regisztrációs felület | A regisztrációs felületen a felhasználó e-mail cím, felhasználónév és jelszó megadásával tud regisztrálni. Amennyiben egy adat hibás, vagy nem felel meg a követelménynek, a felhasználó hibaüzenetet kap.
Bejelentkezési felület | A felhasználó a bejelentkezési felületen jelentkezhet be, felhasználóneve és jelszava segítségével. Hibás adatok esetén a felhasználó hibaüzenetet kap.
Elfelejtett felhasználónév / jelszó | Abban az esetben, ha a felhasználó elfelejtette jelszavát vagy felhasználónevét, az Elfelejtett felhasználónév vagy jelszó funkcióval az adminhoz tud fordulni.
Felhasználónév módosítása | A felhasználó módosítása felületen a felhasználó módosíthatja saját felhasználónevét, a régi és az új felhasználónév, valamint a jelszó megadásával.
Jelszó módosítása | A felhasználónak lehetősége van jelszavának módosítására is. Ehhez a régi és az új jelszó megadása, valamint az új jelszó megerősítése szükséges.
Jogosultsági szintek | -Admin <br> -Tanár <br> -Tanuló
Kurzus létrehozása | Kurzus létrehozása funkció segítségével az admin és tanár jogosultságú felhasználó kurzusokat tud létrehozni.
Kurzus kiválasztása | Kurzus kiválasztásával a diák jogosultságú felhasználó kiválaszthatja azokat a kurzusokat amelyekre szüksége van.
Kurzus szerkesztése | Az admin és tanár felhasználóknak lehetőségük van szerkeszteni saját kurzusaikat.
Kurzus törlése | Az admi és tanár jogosultsággal rendelkező felhasználóknak a kurzusaik törlésére is van lehetőségük.
Adatlap | A felhasználók részletes adatai, kurzusokon elért eredményeik az adatlapon találhatóak.



# 7. Fogalomszótár

- E-learning: Számítógépes hálózaton/Digitálisan elérhető képzési forma
- PHP: programozási nyelv, weboldalak készítésére használják
- Releváns - fontos, lényeges, meghatározó, jelentős
- Corrective Maintenance: A felhasználók által felfedezett és "user reportban" elküldött hibák kijavítása.
- Adaptive Maintenance: A program naprakészen tartása és finomhangolása.
- Perfective Maintenance: A szoftver hosszútávú használata érdekében végzett módosítások, új funkciók, a szoftver teljesítményének és működési megbízhatóságának javítása.
- Preventive Maintenance: Olyan problémák elhárítása, amelyek még nem tűnnek fontosnak, de később komoly problémákat okozhatnak.