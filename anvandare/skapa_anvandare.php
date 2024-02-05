<?php
    require_once('..\db.php');
    require_once('..\funktioner.php');
    $svar=[];
    if(kolla_data('namn','losen','email')){
        $namn = $_REQUEST['namn'];
        $losen = $_REQUEST['losen'];
        $email = $_REQUEST['email'];

        // Om nåt är för långt
        $namn_langd = 100;
        $losen_langd = 100;
        $email_langd = 50;

        if (strlen($namn) > $namn_langd || strlen($losen) > $losen_langd || strlen($email) > $email_langd) {
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
                skriv_ut_svar("Nåt gick fel: $e");
                $db->close();
                return;
            }
            skriv_ut_svar("Anvandare finns redan");
            $db->close();
            return;
        }
        $svar="Anvandare skapad";
    } else {
        $svar.="saknar losen eller namn";
    }
    skriv_ut_svar($svar);
    $db->close();

?>