<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatbázis inicializáló</title>
</head>
<body>
    
    <?php 

        // kapcsolat létrehozása a MySQL szerverrel

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $connection = new mysqli($servername, $username, $password);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        // adatbázis létrehozása

        $query = "CREATE DATABASE tananyagkezelo";
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Adatbázis sikeresen létrehozva<br>";
        } else {
            echo "HIBA az adatbázis létrehozása során: " . $connection->error;
        }

        $connection->close();
        
        // FELHASZNALO tábla létrehozása

        echo "<br>FELHASZNALO TÁBLA<br>";

        $dbname="tananyagkezelo";
        $connection=new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        $query = "CREATE TABLE felhasznalo (
            felhasznalonev VARCHAR(100) NOT NULL PRIMARY KEY,
            email VARCHAR(150) NOT NULL UNIQUE,
            jelszo VARCHAR(150) NOT NULL,
            vezeteknev VARCHAR(100) NOT NULL,
            keresztnev VARCHAR(100) NOT NULL,
            szerepkor VARCHAR(30) NOT NULL,
            online BOOLEAN NOT NULL
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'felhasznalo' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'felhasznalo' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerepkor, online)
            VALUES 
            ('b_kev03', 'b_kev03@gmail.com', '" . password_hash("Kevin123", PASSWORD_DEFAULT) . "', 'Bak', 'Kevin', 'ROLE_ADMIN', 'FALSE'),
            ('admin', 'admin@admin.com', '" . password_hash("admin", PASSWORD_DEFAULT) . "', 'ADMIN', 'ISZTRÁTOR', 'ROLE_ADMIN', 'FALSE'),
            ('kisbela85', 'kbela85@gmail.com', '" . password_hash("Kbela1985", PASSWORD_DEFAULT) . "', 'Kis', 'Béla', 'ROLE_TANAR', 'FALSE'),
            ('kistvan98', 'kistvan98@gmail.com', '" . password_hash("Kistvan98", PASSWORD_DEFAULT) . "', 'Kandó', 'István', 'ROLE_TANAR', 'FALSE'),
            ('petmark89', 'petmark89@gmail.com', '" . password_hash("Petmark89", PASSWORD_DEFAULT) . "', 'Péter', 'Márk', 'ROLE_TANAR', 'TRUE'),
            ('kovacsmiklos03', 'kovmik03@gmail.com', '" . password_hash("Kovmik123", PASSWORD_DEFAULT) . "', 'Kovács', 'Miklós', 'ROLE_HALLGATO', 'FALSE'),
            ('feklaj03', 'feklaj03@gmail.com', '" . password_hash("Feklaj123", PASSWORD_DEFAULT) . "', 'Fekete', 'Lajos', 'ROLE_HALLGATO', 'FALSE'),
            ('hmihaly91', 'hmihaly91@gmail.com', '" . password_hash("Hmihaly91", PASSWORD_DEFAULT) . "', 'Horváth', 'Mihály', 'ROLE_HALLGATO', 'FALSE'),
            ('nandras01', 'nandras01@gmail.com', '" . password_hash("Nandras01", PASSWORD_DEFAULT) . "', 'Nagy', 'András', 'ROLE_HALLGATO', 'FALSE'),
            ('balmos97', 'balmos97@gmail.com', '" . password_hash("Balmos97", PASSWORD_DEFAULT) . "', 'Balogh', 'Álmos', 'ROLE_HALLGATO', 'FALSE'),
            ('fehlev02', 'fehlev02@gmail.com', '" . password_hash("Fehlev02", PASSWORD_DEFAULT) . "', 'Fehér', 'Levente', 'ROLE_HALLGATO', 'FALSE')
            ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'felhasznalo' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'felhasználo' táblába: " . $connection->error;
        }
        
        // KURZUS tábla

        echo "<br>KURZUS TÁBLA<br>";

        $query = "CREATE TABLE kurzus (
            kkod VARCHAR(100) NOT NULL PRIMARY KEY,
            knev VARCHAR(150) NOT NULL,
            felev INT NOT NULL,
            kredit INT NOT NULL
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'kurzus' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'kurzus' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO `kurzus` (`kkod`, `knev`, `felev`, `kredit`) 
        VALUES
        ('PROGALAP-00', 'Programozás Alapjai', '1', '3'),
        ('DIMAT-01', 'Diszkrét Matematika I.', '1', '2'),
        ('SZHALO-01', 'Számítógép Hálózatok', '1', '2'),
        ('SZAMARCH-01', 'Számítógép Architektúrák', '1', '2'),
        ('KALK-01', 'Kalkulus I.', '1', '3'),
        ('PROG-01', 'Programozás I.', '2', '3'),
        ('DIMAT-02', 'Diszkrét Matematika II.', '2', '3'),
        ('OPKUT-01', 'Operációkutatás', '2', '2'),
        ('WEBTERV-01', 'Webtervezés', '2', '2'),
        ('ALGA-01', 'Algoritmusok és adatszerkezetek I.', '3', '3'),
        ('KÖSZI-01', 'Közelítő és szimbolikus számítások', '3', '3'),
        ('PROG-02', 'Programozás II.', '3', '2'),
        ('ADATB-01', 'Adatbázisok', '3', '2')
        ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'kurzus' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'kurzus' táblába: " . $connection->error;
        } 

        // TANANYAG tábla

        echo "<br>TANANYAG TÁBLA<br>";

        $query = "CREATE TABLE tananyag (
            tid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nev VARCHAR(150) NOT NULL,
            letrehozas_datuma DATE NOT NULL,
            kkod VARCHAR(100) NOT NULL,
            tartalom VARCHAR(65535) NOT NULL,
            felhasznalonev VARCHAR(100) NOT NULL,
            FOREIGN KEY (kkod) REFERENCES kurzus(kkod) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE
            )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'tananyag' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'tananyag' tábla létrehozása során: " . $connection->error;
        }

        $jelenlegi_datum = date("Y-m-d");
        $query = "INSERT INTO `tananyag` (`nev`, `letrehozas_datuma`, `kkod`, `tartalom`, `felhasznalonev`) 
        VALUES 
        ('Ismétlés', '2023-11-21', 'KALK-01', '1+1 az mindig 2.', 'kisbela85'),
        ('A C nyelv', '$jelenlegi_datum', 'PROGALAP-00', 'A main függvény a program belépési pontja: int main() {return 0;} a legegyszerűbb C program, amit létrehozhatunk, ám ennek nem sok értelme van. A main függvénynek lehetnek paraméterei is, de erről később beszélünk.', 'kisbela85'),
        ('Pointerek', '$jelenlegi_datum', 'PROGALAP-00', 'Új dinamikus változó létesítése: p = malloc(sizeof(E)). A malloc(S) függvény lefoglal egy S méretű memóriaterületet a program számára. A sizeof(E) megadja, hogy egy E típusú változó mekkora helyet igényel a memóriában. A malloc(sizeof(E)) hatására tehát létrejön egy új E típusú érték tárolására (is) alkalmas változó, és ez a változó lesz a p értéke.', 'b_kev03'),
        ('Vezérlési szerkezetek', '$jelenlegi_datum', 'PROGALAP-00', 'Az if utasítás segítségével valamely tevékenység (utasítás) végrehajtását egy kifejezés (feltétel) értékétől tehetjük függővé. Az if alábbi formájában az utasítás csak akkor hajtódik végre, ha a kifejezés értéke igaz (nem nulla).', 'petmark89'),
        ('Komplex számok', '$jelenlegi_datum', 'DIMAT-01', 'A komplex számok általános alakja ai + b, ahol a és b valós számok, i pedig a -1 négyzetgyöke. Ebből az is következik, hogy i^2 = -1. Így a valós számok halmazán nem megoldható másodfokú egyenleteket is meg fogunk majd a későbbiekben tudni oldani.', 'petmark89'),
        ('Mátrixok', '$jelenlegi_datum', 'DIMAT-01', 'Az (n x m)-es valós mátrix egy táblázat, melynek n sora és m oszlopa van. Elemei R elemei, azaz valós számok. A táblázat elemeit kerekzárójelek közé írjuk.', 'kistvan98'),
        ('Réteges tervezés, OSI modell', '$jelenlegi_datum', 'SZHALO-01', 'A számítógép-hálózatok a fejlődésük során egyre összetettebbek és bonyolultabbak lettek, ezért elengedhetetlen volt valamilyen strukturáltság bevezetése. A minél jobb átláthatóság érdekében a hálózatok feladatait, szerepeit egymásra épülő rétegekre osztották fel.', 'kistvan98'),
        ('Alkalmazási réteg: A HTTP protokoll', '$jelenlegi_datum', 'SZHALO-01', 'A HTTP üzenetváltáshoz egy ún. kliens-szerver architektúra szükséges. A kliens a böngésző segítségével küld egy HTTP kérést (HTTP request) egy objektum iránt a szerver felé. A szerver fogadja a kérést és visszaküld egy HTTP választ, amely tartalmazza a kért objektumot.', 'kisbela85'),
        ('Bevezető', '$jelenlegi_datum', 'SZAMARCH-01', 'A számítógép utasításokat hajt végre, ezeknek sorozatát utasítássorozatoknak nevezzük, melyekkel különböző problémákat is megoldhatunk.', 'b_kev03'),
        ('A Java nyelvről', '$jelenlegi_datum', 'PROG-01', 'Ahhoz, hogy Java programokat tudjunk futtatni, illetve fejleszteni, szükségünk lesz egy fordító- és futtatókörnyezetre, valamint egy fordítóprogramra. A kész programunk futtatásához mindösszesen a JRE (Java Runtime Environment) szükséges, ami biztosítja a Java alkalmazások futtatásának minimális követelményeit, mint például a JVM (Java Virtual Machine) vagy például a böngészők számára a Java beépülő modult és a Java Web Startot is.', 'admin'),
        ('Ismétlés', '$jelenlegi_datum', 'PROG-01', 'Egyszerű (primitív) adattípusok: boolean, char, byte, short, int, long, float, double, ezek nagy része ismerős lehet C-ből. A C-vel ellentétben Javaban nyelvi szinten támogatva van a logikai adattípus, amelyet boolean típusnak nevezünk, és értéke csak true vagy false lehet. További eltérés a C-hez képest, hogy Javaban nincs előjeltelen típus, tehát nem használhatjuk az unsigned kulcsszót, csak és kizárólag előjeles típusokat hozhatunk létre.', 'admin'),
        ('Lineáris kongruenciarendszerek', '$jelenlegi_datum', 'DIMAT-02', 'Lineáris kongruenciarendszer alatt a 2 vagy több lineáris kongruencia egyenletrendszerbe való csoportosítását értjük.', 'kistvan98'),
        ('Gráfok', '$jelenlegi_datum', 'DIMAT-02', 'A gráf a matematikai gráfelmélet és a számítógéptudomány egyik alapvető fogalma. A gráf dolgok (csomópontok, csúcsok) és a rajtuk értelmezett összeköttetések (élek) halmaza.', 'kistvan98'),
        ('Az LP', '$jelenlegi_datum', 'OPKUT-01', 'Lineáris programozási feladat (LP): keressük meg adott lineáris R^n értelmezési tartományú függvény (célfüggvény) szélsőértékét (minimumát vagy maximumát) értelmezési tartományának adoot lineáris korlátokkal (feltételekkel) meghatározott részében.', 'petmark89'),
        ('Szimplex módszer', '$jelenlegi_datum', 'OPKUT-01', 'A szimplex módszer egy algoritmus az LP-k megoldására. Iteratív optimum keresés, ismételt áttérérs más szótárakra.', 'b_kev03'),
        ('HTML bevezető', '$jelenlegi_datum', 'WEBTERV-01', 'A HTML (HyperText Markup Language) egy jelölőnyelv, amelynek segítségével megmondhatjuk, hogy mi az amit egy weboldalon látni szeretnénk (pl. szövegek, képek, hivatkozások, táblázatok, multimédia stb.). A HTML lehetőséget biztosít a weboldalak tartalmának struktúrálására is. Ezt különböző szakaszok, tartalmi egységek (pl. fejléc, menüsor, fő tartalom, lábléc stb.) kialakításával tehetjük meg.', 'b_kev03'),
        ('CSS bevezető', '$jelenlegi_datum', 'WEBTERV-01', 'Az eddigiek során tárgyalt HTML nyelvet a weboldal tartalmának kialakítására és struktúrálására használtuk. Ha a tartalmat formázni is szeretnénk, akkor a CSS-re (Cascading Style Sheets) lesz szükségünk. A szelektor (más néven kijelölő) segítségével megmondjuk, hogy a weboldal mely elemét (vagy elemeit) szeretnénk formázni. Ezután kapcsos zárójelek között, pontosvesszővel elválasztva megadjuk az elvégezendő formázásokat `tulajdonság: érték` formában.', 'kistvan98'),
        ('Algoritmusok bevezető', '$jelenlegi_datum', 'ALGA-01', 'Algoritmuson vagy eljáráson olyan megengedett lépésekből álló módszert, utasítás(sorozatot), részletes útmutatást, receptet értünk, amely valamely felmerült probléma megoldására alkalmas.', 'b_kev03'),
        ('Adatszerkezetek bevezető', '$jelenlegi_datum', 'ALGA-01', 'Adatszerkezetnek nevezzük a (számítógépes adatfeldolgozás céljaira előállított) adatok tárolási célokat szolgáló struktúrális, formai elrendezését.', 'admin'),
        ('Bevezető', '$jelenlegi_datum', 'KÖSZI-01', 'Ez az új tantárgy az elődje, a Numerikus Matematika nyomán valós számokon végzett műveleteket tartalmazó algoritmusok számítógépes megvalósításába és annak használatába ad bevezetést, kitérve a MATLAB és Maple programok használatára.', 'petmark89'),
        ('Hiba típusok', '$jelenlegi_datum', 'KÖSZI-01', 'Az ~x becslés hibája az x-~x érték, abszolút hibája pedig az |x-~x| nemnegatív szám.', 'admin'),
        ('Stringkezelés', '$jelenlegi_datum', 'PROG-02', 'A C++-ban a szövegeknek van egy hatékonyabb, kevésbé körülményes megvalósítása is, a string osztály (osztályokról később lesz szó, most csak azt mutatjuk be, hogyan lehet használni a string-et). A string objektumok dinamikusan változtatják a méretüket a tartalmazott karakterek számától függően. A félév folyamán stringek alatt ezt a reprezentációt értjük, nem pedig a char*-ot. A string objektumok használatához, string műveletekhez szükségünk lesz a string header include-olására is (és nem string.h). Ezt követően kényelmesen használhatjuk a szövegeket, ahogy már Javaban is megszoktuk.', 'kistvan98'),
        ('Operátorok', '$jelenlegi_datum', 'PROG-02', 'Az eddig ismert alap típusokra léteznek operátorok. Egy egész típusú változó operátora lehet pl. összeadás (+), kivonás (-), értékadás (=), inkrementálás (++). Ezeknek a jól megszokott hatásuk van a változó értékére. Az általunk megvalósított osztályokra azonban alapból nem működnek ezek az operátorok. A C++ azonban lehetőséget kínál rá, hogy saját típusra is értelmezzük az operátorokat, csak meg kell mondanunk, hogy mi történjen pl. összeadás esetén. Ezt operátor kiterjesztésnek hívjuk.', 'b_kev03'),
        ('Az egyed-kapcsolat diagram', '$jelenlegi_datum', 'ADATB-01', 'Az adatbázis logikai modelljének elkészítéséhez az alábbi szempontokat kell figyelebe venni: Miről szeretnénk eltárolni adatokat? Milyen adatokat szeretnénk tárolni? Hogyan viszonyulnak egymáshoz a tárolandó az adatok? A fenti kérdésekre adjuk meg a választ az egyed-kapcsolat diagram jelölésrendszere segítségével. Az alábbiakban áttekintjük ezeket a jelöléseket.', 'petmark89'),
        ('Relációsémák', '$jelenlegi_datum', 'ADATB-01', 'Relációs adatbázissémának (vagy relációsémának) nevezünk egy attribútumhalmazt, amelyhez név tartozik: formálisan R(A1,...,An), ahol R a relációséma neve, A1, ... An, pedig az attribútumhalmaza. Minden attribútumhoz tartozik egy értékkészlet, amelyből felveheti értékeit. Az i-edik attribútum értékkészletét dom(Ai) jelöli.', 'petmark89')
        ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'tananyag' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'tananyag' táblába: " . $connection->error;
        }

        // NAPLÓ tábla

        echo "<br>NAPLO TÁBLA<br>";

        $query = "CREATE TABLE naplo (
            nid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            felhasznalonev VARCHAR(100) NOT NULL,
            tid INT NOT NULL,
            muvelet VARCHAR(100) NOT NULL,
            mikor DATETIME NOT NULL,
            eltelt_ido INT,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (tid) REFERENCES tananyag(tid) ON DELETE CASCADE ON UPDATE CASCADE
            )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'naplo' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'naplo' tábla létrehozása során: " . $connection->error;
        }
        
        $connection->close();
    ?>
</body>
</html>