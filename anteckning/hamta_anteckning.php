<?php
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $anvandare_id = $_REQUEST["anvandare_id"];
    $nyckel = $_REQUEST["nyckel"];
    if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
        $sql = "SELECT anvandare.anvandare_id,ant_anv.anteckning_id,anteckning.titel FROM anvandare 
        JOIN ant_anv ON anvandare.anvandare_id=ant_anv.anvandare_id  
        JOIN anteckning ON anteckning.anteckning_id = ant_anv.anteckning_id
        WHERE anvandare.anvandare_id = ?";
        // Väljer vilken användare som ska hämtas
        // plockar sedan ut alla anteckningar som användaren har
        // och sedan hämtar titeln på anteckningen
    
        // Kanske en funktion...
        $stmt = $db->prepare($sql); 
        $stmt->bind_param("i", $anvandare_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $svar = $result->fetch_assoc();
        
        skriv_ut_svar($svar);
        
        $db->close();
    };

?>