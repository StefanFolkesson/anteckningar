<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!

// Vi behöver titeln och texten
// anvandare-id
// nyckeln
// Skapa anteckningen
// 
    $anvandare_id = $_REQUEST['anvandare_id'];
    $nyckel = $_REQUEST['nyckel'];
    $svar ="";
    if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
        $titel = $_REQUEST['titel'];
        $text = $_REQUEST['text'];
        $sql ="INSERT INTO anteckning (titel,text) VALUES(?,?)";
        $stmt = $db->prepare($sql); 
        $stmt->bind_param("ss", $titel,$text);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        // KOppla mot användare!
        $svar="allt är okej!";
    }
    else {
        $svar="ingen instoppning gjord!";
    }
    skriv_ut_svar($svar);
    $db->close();
?>