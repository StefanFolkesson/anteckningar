<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    // Vi behöver titeln och texten
    // anvandare-id
    // nyckeln
    // Skapa anteckningen
    // 
    $svar="";
    $anvandare_id="";
    $nyckel="";
    if(isset($_REQUEST['anvandare_id'])){
        $anvandare_id = $_REQUEST['anvandare_id'];
    } else {
        $svar=$svar."Du måste ha en användare_id. ";
    }
    if(isset($_REQUEST['nyckel'])){
        $nyckel = $_REQUEST['nyckel'];
    } else {
        $svar=$svar."Du måste ha en nyckel. ";
    }
    if($svar==""){
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            $titel = $_REQUEST['titel'];
            $text = $_REQUEST['text'];
            $sql ="INSERT INTO anteckning (titel,text,skapad_datum) VALUES(?,?,now())";
            hamta_data($db,$sql,"ss", $titel, $text);
            // Error hantering om man inte kan binda den till användaren? 
            $sql ="INSERT INTO ant_anv (anvandare_id,anteckning_id,agare) VALUES(?,(SELECT LAST_INSERT_ID()),?)";
            hamta_data($db,$sql,"ii",$anvandare_id,$anvandare_id);
            $svar="allt är okej!";
        }
        else {
            $svar="ingen instoppning gjord!";
        }
    }
    skriv_ut_svar($svar);
    $db->close();
?>