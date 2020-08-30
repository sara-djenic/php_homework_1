<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "raf_cloud";

//$host = "192.168.10.10";
//$user = "homestead";
//$pass = "secret";
//$database = "termin3";

// Pristup bazi podataka vrsimo preko PDO objekta, koji kao parametar trazi nacin i mesto pristupa
//// kao i kredencijale
// Ovaj deo ce vam biti mnogo jasniji kada krenemo OOP da radimo

$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

// setAttribute je metoda PDO koja vam omogucava konfigrusanje vase konekcije : https://secure.php.net/manual/en/pdo.setattribute.php
// Setujemo default format vraćanja podataka iz baze u assoc, da ne bismo morali u svakom fetch() da stavljamo
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

