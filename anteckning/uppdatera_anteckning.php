<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $anvandare_id = $_REQUEST['anvandare_id'];
    $nyckel = $_REQUEST['nyckel'];
    $anteckning_id = $_REQUEST['anteckning_id'];
    $titel = $_REQUEST['titel'];
    $text = $_REQUEST['text'];
    if(verifiera_anvandare($db,$anvandare_id,$nyckel) && isset($anvandare_id) && isset($nyckel)){
        if(isset($titel) && isset($text)){
            $sql ="UPDATE anteckning SET titel = ?, text = ? WHERE anteckning_id = ? ";
        } elseif (isset($titel)){
            $sql ="UPDATE anteckning SET titel = ? WHERE anteckning_id = ? ";
        } elseif(isset($text)){
            $sql ="UPDATE anteckning SET text = ? WHERE anteckning_id = ? ";
        } else{
            $svar= "Du skickade inte in någon text eller titel variabel";
        }
        if(isset($titel) && isset($text)){
            hamta_data($db,$sql,"ssi", $titel, $text, $anteckning_id);
        }elseif (isset($titel)){
            hamta_data($db,$sql,"si", $titel, $anteckning_id);
        } elseif(isset($text)){
            hamta_data($db,$sql,"si", $text, $anteckning_id);
        } 
    }
    else
    {
        $svar="Du skicka inte in rätt variabler eller så saknas någon av variablerna";
    }
    $svar ="Din anteckning har blivit uppdaterad";
    $db->close();
?>

