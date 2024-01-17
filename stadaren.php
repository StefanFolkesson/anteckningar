<?php
    // Ta bort användare som inte har loggat in på XX dagar
    // Om användaren är ägare till en anteckning så ska dess 
    // ägandeskap flyttas till en annan användare som också 
    // har tillgång till anteckningen sedan skall relationen 
    // till anteckninen tas bort
    // annars skall anteckningen tas bort
    // Vi har ett problem med bilder... Vi kanske måste lägga 
    // vilken anteckning bilden tillhör i DB annars vet vi inte 
    // om den skall tas bort eller ej.

?>