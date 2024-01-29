<?php
require_once('..\db.php');
require_once('..\funktioner.php');

// Om nåt saknas
if (!(isset($_REQUEST['namn']) && isset($_REQUEST['losen']) && isset($_REQUEST['email']))) {
    echo skriv_ut_svar("Nåt saknas antingen 'namn', 'losen' eller 'email'");
    return;
}

$namn = $_REQUEST['namn'];
$losen = $_REQUEST['losen'];
$email = $_REQUEST['email'];

// Om nåt är för långt
const namn_langd = 100;
const losen_langd = 100;
const email_langd = 50;

if (strlen($namn) > namn_langd || strlen($losen) > losen_langd || strlen($email) > email_langd) {
    echo skriv_ut_svar("Nåt av 'namn', 'losen' eller 'email' är för långt");
    return;
}

//skapa användare
$sql="INSERT INTO anvandare (namn, losen, epost) VALUES (?,?,?)";

// error hantering skall nog vara i funktionen
try {
    hamta_data($db,$sql,"sss", $namn, $losen, $email);
} catch (mysqli_sql_exception $e) {
    if (!str_contains($e, "Duplicate entry")) {
        echo skriv_ut_svar("Nåt gick fel: $e");
        $db->close();
        return;
    }
    echo skriv_ut_svar("Anvandare finns redan");
    $db->close();
    return;
}
echo skriv_ut_svar("Anvandare skapad");

$db->close();

?>