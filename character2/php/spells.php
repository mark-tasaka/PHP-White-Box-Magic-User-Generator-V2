<?php
/*Magic-User Spells*/


function spellLevels ($level)
{
    
    $spells = array("1", "2", "3", "4", "5", "6");
        
    return $spells;
    
    
}

function spellLine ($level)
{
    
    $line = "_____";

    if($level >= 3 && $level <=4)
    {
        $line = "____________";
    }
    else if($level >= 5 && $level <=6)
    {
        $line = "___________________";
    }
    else if($level >= 7 && $level <=8)
    {
        $line = "________________________";
    }
    else if($level >= 9 && $level <=11)
    {
        $line = "_______________________________";
    }
    else if($level ==12)
    {
        $line = "_____________________________________";
    }
    
    return $line;
    
}


function spellsEachLevel ($level)
{
    $spells = array("", "-", "-", "-", "-", "-");
  
    if($level == 1)
    {
            $spells = array("1", "-", "-", "-", "-", "-");   
    }
    else if($level == 2)
    {
            $spells = array("2", "-", "-", "-", "-", "-");   
    }
    else if($level == 3)
    {
            $spells = array("3", "1", "-", "-", "-", "-");   
    }
    else if($level == 4)
    {
            $spells = array("4", "2", "-", "-", "-", "-");   
    }
    else if($level == 5)
    {
            $spells = array("4", "2", "1", "-", "-", "-");   
    }
    else if($level == 6)
    {
            $spells = array("4", "2", "2", "-", "-", "-");   
    }
    else if($level == 7)
    {
            $spells = array("4", "3", "2", "1", "-", "-");   
    }
    else if($level == 8)
    {
            $spells = array("4", "3", "3", "2", "-", "-");   
    }
    else if($level == 9)
    {
            $spells = array("4", "3", "3", "2", "1", "-");   
    }
    else if($level == 10)
    {
            $spells = array("4", "4", "3", "2", "2", "-");   
    }
    else if($level == 11)
    {
            $spells = array("4", "4", "4", "3", "3", "-");   
    }
    else if($level == 12)
    {
            $spells = array("4", "4", "4", "4", "4", "1");   
    }



    return $spells;
}



?>