<?php
    require_once('db.php');
    require_once('funktioner.php');

    $namn = $_REQUEST["namn"];
    $sql = "SELECT anvandare.anvandare_id,ant_anv.anteckning_id,anteckning.titel FROM anvandare 
    JOIN ant_anv ON anvandare.anvandare_id=ant_anv.anvandare_id  
    JOIN anteckning ON anteckning.anteckning_id = ant_anv.anteckning_id
    WHERE namn = ?";
    // Väljer vilken användare som ska hämtas
    // plockar sedan ut alla anteckningar som användaren har
    // och sedan hämtar titeln på anteckningen

    // Kanske en funktion...
    $stmt = $db->prepare($sql); 
    $stmt->bind_param("s", $namn);
    $stmt->execute();
    $result = $stmt->get_result();
    $svar = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    skriv_ut_svar($svar);
    
    mysqli_close($db);
?>