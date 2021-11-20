<?php
/*Magic-User*/

function thaco($level)
{
    $toHit = 19;
    
    if($level >= 5 && $level <= 6)
    {
        $toHit = 18;
    }
    else if($level >= 7 && $level <= 8)
    {
        $toHit = 17;
    }
    else if($level >= 9 && $level >=10)
    {
        $toHit = 16;
    }
    else if($level >= 11 && $level >=12)
    {
        $toHit = 15;
    }
    
    return $toHit;
}



?>