<!DOCTYPE html>
<html>
<head>
<title>White Box RPG Magic-User Character Generator</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="White Box RPG Magic-User Character Generator. Goblinoid Games.">
	<meta name="keywords" content="White Box RPG, Goblinoid Games,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2018">
		

	<link rel="stylesheet" type="text/css" href="css/wb_magicUser.css">
    
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/coins.php';
    include 'php/classDetails.php';
    include 'php/clothing.php';
    include 'php/characterRace.php';
    include 'php/demiHumanLevelLimit.php';
    include 'php/movementRate.php';
    include 'php/thaco.php';
    include 'php/abilityScoreGen.php';
    include 'php/nameSelect.php';
    include 'php/gender.php';
    include 'php/hitPoints.php';
    include 'php/primeReq.php';
    include 'php/classAbilities.php';
    include 'php/addLanguages.php';
    include 'php/spells.php';
    
    
        if(isset($_POST["theCharacterName"]))
        {
            $characterName = $_POST["theCharacterName"];
    
        }
        if(isset($_POST["theGivenName"]))
        {
            $givenName = $_POST["theGivenName"];

        }

        if($givenName == '100')
        {
            $givenName = rand(0, 49);
        }
        else
        {
            $givenName = $givenName;
        }
        


        if(isset($_POST["theSurname"]))
        {
            $surname = $_POST["theSurname"];

        }

        if($surname == '100')
        {
            $surname = rand(0, 37);
        }
        else
        {
            $surname = $surname;
        }

    //    $randomNameVal = 0;



        if(isset($_POST['theCheckBoxRandomName']) && $_POST['theCheckBoxRandomName'] == 1) 
        {
            $givenName = 200;
            $surname = 200;
            
       //     $randomNameVal = 1;
            
        } 
        
        $nameDescript = getNameDescript($givenName, $surname);

        
        if(isset($_POST["theGender"]))
        {
            $gender = $_POST["theGender"];
        }

        $genderName = getGenderName($gender);
        $genderNameIdentifier = genderNameGeneration ($gender);

        $fullName = getName($givenName, $surname, $genderNameIdentifier);

                
        
        if(isset($_POST["thePlayerName"]))
        {
            $playerName = $_POST["thePlayerName"];
    
        }
    

        if(isset($_POST["theCharacterRace"]))
        {
            $characterRace = $_POST["theCharacterRace"];
        }

        //$characterRace = "Human";
    
            
        if(isset($_POST["theAlignment"]))
        {
            $alignment = $_POST["theAlignment"];
        }
    
        if(isset($_POST["theLevel"]))
        {
            $level = $_POST["theLevel"];
        
        } 
    
            $level = levelLimit ($characterRace, $level);
    
    
        if(isset($_POST["theSavingThrows"]))
        {
            $saveThrowOption = $_POST["theSavingThrows"];
        
        } 
    
        
        if(isset($_POST["theAbilityScore"]))
        {
            $abilityScoreGen = $_POST["theAbilityScore"];
        
        } 

        $generationMesssage = generationMesssage($abilityScoreGen);
    
        
        $abilityScoreArray = array();
        
        for($i = 0; $i < 6; ++$i)
        {
            $abilityScore = rollAbilityScores ($abilityScoreGen);

            array_push($abilityScoreArray, $abilityScore);

        }       

        $strength = $abilityScoreArray[0];
        $dexterity = $abilityScoreArray[1];
        $constitution = $abilityScoreArray[2];
        $wisdom = $abilityScoreArray[3];
        $intelligence = $abilityScoreArray[4];
        $charisma = $abilityScoreArray[5];
        
        $strengthMod = getAbilityModifier($strength);
        $dexterityMod = getAbilityModifier($dexterity);
        $constitutionMod = getAbilityModifier($constitution);
        $wisdomMod = getAbilityModifier($wisdom);
        $intelligenceMod = getAbilityModifier($intelligence);
        $charismaMod = getAbilityModifier($charisma);
    
        $exNext = experienceNextLevel($level);

        $hitPoints = getHitPoints($level, $constitutionMod);

        $hitDice = getHitDiceAmount($level);

        $languages = addLanguages($intelligence);
    

    /*
        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        $armourDefense = getArmour($armour)[1];
        $armourWeight = getArmour($armour)[2];
    
    
        $totalArmourWeight =  $armourWeight;
    
        $armourDefense = removeZero($armourDefense);
        $armourWeight = removeZero($armourWeight);

        
       $descendingAc = 9 - $armourDefense - $dexterityMod;
       $ascendingAc = 10 + $armourDefense + $dexterityMod;
    */

    
    $descendingAc = 9 - $dexterityMod;
    $ascendingAc = 10 + $dexterityMod;
    
        if(isset($_POST["theGold"]))
        {
            $coins = $_POST["theGold"];
        }

        $gold = getGold($coins);
        $silver = getSilver($coins);

        $coinWeight = $gold + $silver;
        $coinWeight = (int)($coinWeight/10);
    
         
        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
        $weaponWeight = array();

        //For Random Select weapon
        if(isset($_POST['thecheckBoxRandomWeaponsV2']) && $_POST['thecheckBoxRandomWeaponsV2'] == 1) 
        {
            $weaponArray = getRandomWeapons();

        }
        else
        {
            if(isset($_POST["theWeapons"]))
            {
                foreach($_POST["theWeapons"] as $weapon)
                {
                    array_push($weaponArray, $weapon);
                }
            }
        }


    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
    $totalWeaponWeight = 0;
    
    foreach($weaponArray as $select)
    {
        array_push($weaponWeight, getWeapon($select)[2]);
        $totalWeaponWeight += getWeapon($select)[2];
    }
    
    

        $gearArray = array();
        $gearNames = array();
        $gearWeight = array();
    
        //For Random Select gear
        if(isset($_POST['theCheckBoxRandomGear']) && $_POST['theCheckBoxRandomGear'] == 1) 
        {
            $gearArray = getRandomGear();
    
            $weaponCount = count($weaponArray);
    
    /*
            for($i = 0; $i < $weaponCount; ++$i)
            {
    
                if($weaponArray[$i] == "14" || $weaponArray[$i] == "15" )
                {
                    array_push($gearArray, 33);
                }

                if($weaponArray[$i] == "16" || $weaponArray[$i] == "17" )
                {
                    array_push($gearArray, 35);
                }
    
                if($weaponArray[$i] == "18")
                {
                    array_push($gearArray, 36);
                }
    
            }*/
    
        }
        else
        {
            //For Manually select gear
            if(isset($_POST["theGear"]))
                {
                    foreach($_POST["theGear"] as $gear)
                    {
                        array_push($gearArray, $gear);
                    }
                }
    
        }
    
        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
        
        $totalGearWeightOnly = 0;
    
        foreach($gearArray as $select)
        {
            array_push($gearWeight, getGear($select)[1]);
            $totalGearWeightOnly += getGear($select)[1];
        }

    
    $totalGearWeight = 10;
    
    $totalWeaponArmourWeight = $totalWeaponWeight; 
    
    
    $totalWeightCarried = $totalWeaponArmourWeight + $totalGearWeight + $coinWeight;
    
    $saveMatrix = savingThrowMatrix ($level);

    
   $characterRaceTraits = demiHumanTraits ($characterRace);
    
    $movementRate = moveRate ($totalWeightCarried, $characterRace);
    
    $thaco = thaco($level);

    $meleeHitAC0 = $thaco - ($strengthMod);
    $meleeHitAC1 = $thaco - ($strengthMod) - 1;
    $meleeHitAC2 = $thaco - ($strengthMod) - 2;
    $meleeHitAC3 = $thaco - ($strengthMod) - 3;
    $meleeHitAC4 = $thaco - ($strengthMod) - 4;
    $meleeHitAC5 = $thaco - ($strengthMod) - 5;
    $meleeHitAC6 = $thaco - ($strengthMod) - 6;
    $meleeHitAC7 = $thaco - ($strengthMod) - 7;
    $meleeHitAC8 = $thaco - ($strengthMod) - 8;
    $meleeHitAC9 = $thaco - ($strengthMod) - 9;
    
    $halflingBonus = missileBonusHalfling ($characterRace);

    $missileAttack = $dexterityMod + $halflingBonus;
    
    $dwarfSaveMagic = dwarfSaveMod ($characterRace);

    $intelligencePrime = $intelligence;

    $exBonus = exBonus ($intelligencePrime, $wisdom, $charisma);

    $hirelings = hirelings($charisma);

    $specialAbility = specialAbility();

        
    $spellLevel1 = spellLevels($level)[0];
    $spellLevel2 = spellLevels($level)[1];
    $spellLevel3 = spellLevels($level)[2];
    $spellLevel4 = spellLevels($level)[3];
    $spellLevel5 = spellLevels($level)[4];
    $spellLevel6 = spellLevels($level)[5];
    
    
    $spellsForLevel1 = spellsEachLevel($level)[0];
    $spellsForLevel2 = spellsEachLevel($level)[1];
    $spellsForLevel3 = spellsEachLevel($level)[2];
    $spellsForLevel4 = spellsEachLevel($level)[3];
    $spellsForLevel5 = spellsEachLevel($level)[4];
    $spellsForLevel6 = spellsEachLevel($level)[5];
    
    /*
    $spellLevelTitle = spellHeader1 ($level);
    $spellNumberTitle = spellHeader2 ($level);*/

    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>

       
   <span id="characterName">
           <?php 
           echo $characterName;
           ?>
        </span>

                     
       <span id="characterName2">
           <?php 
            echo $fullName;
           ?>
        </span>

       
   <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
       
        <span id="gender">
           <?php
           echo $genderName;
           ?>
       </span>
       
<span id="strength">
        <?php
            echo $strength;
            ?>
        </span>

        
        <span id="strengthMod">
        <?php
            $strengthMod = getModSign($strengthMod);
            echo $strengthMod;
            ?>
        </span>

		<span id="dexterity">
        <?php
            echo $dexterity;
            ?>
        </span>

          <span id="dexterityMod">
        <?php
            $dexterityMod = getModSign($dexterityMod);
            echo $dexterityMod;
            ?>
        </span>

           
		<span id="constitution">
        <?php
            echo $constitution;
            ?>
        </span>

          <span id="constitutionMod">
        <?php
            $constitutionMod = getModSign($constitutionMod);
            echo $constitutionMod;
            ?>
        </span>

		<span id="wisdom">
        <?php
            echo $wisdom;
            ?>
        </span>

         <span id="wisdomMod">
        <?php
            $wisdomMod = getModSign($wisdomMod);
            echo $wisdomMod;
            ?>
        </span>

		<span id="intelligence">
        <?php
            echo $intelligence;
            ?>
        </span>

         <span id="intelligenceMod">
        <?php
            $intelligenceMod = getModSign($intelligenceMod);
            echo $intelligenceMod;
            ?>
        </span>

		<span id="charisma">
        <?php
            echo $charisma;
            ?>
        </span>

         <span id="charismaMod">
        <?php
            $charismaMod = getModSign($charismaMod);
            echo $charismaMod;
            ?>
        </span>

       
       <span id="race">
           <?php
           echo $characterRace;
           ?>
       </span>
       
       <span id="dieRollMethod">
           <?php
           echo $generationMesssage;
           ?>
       </span>

       <span id="nameDescript">
           <?php
           echo $nameDescript;
           ?>
       </span>

       
       <span id="class">Magic-User</span>
       
       
       
       <span id="exNextLevel">
           <?php
           echo $exNext;
           ?>
       
       </span>
       
       
       <span id="meleeAc0">
           <?php
           echo $meleeHitAC0;
           ?>
       </span>

       <span id="meleeAc1">
           <?php
           echo $meleeHitAC1;
           ?></span>

       <span id="meleeAc2">
           <?php
           echo $meleeHitAC2;
           ?></span>

       <span id="meleeAc3">
       <?php
           echo $meleeHitAC3;
           ?>
       </span>

       <span id="meleeAc4">
           <?php
           echo $meleeHitAC4;
           ?></span>

       <span id="meleeAc5">
           <?php
           echo $meleeHitAC5;
           ?></span>

       <span id="meleeAc6">
           <?php
           echo $meleeHitAC6;
           ?></span>

       <span id="meleeAc7">
           <?php
           echo $meleeHitAC7;
           ?></span>

       <span id="meleeAc8">
           <?php
           echo $meleeHitAC8;
           ?></span>

       <span id="meleeAc9">
           <?php
           echo $meleeHitAC9;
           ?></span>
       
       <span id="missileAttack">
           <?php
           echo 'Missile attack rolls: adjust to-Hit by ' .$missileAttack;
           ?></span>
       
       
       <span id="magicUserAbility"></span>
       

       <span id="descendingAc">
           <?php
           echo $descendingAc;
           ?>
           </span> 

       <span id="ascendingAc">
           <?php
           echo $ascendingAc;
           ?></span>
       
       <span id="addLanguages">
           <?php
           echo 'Common' . $languages;
           ?></span>
       </span>
       
       <span id="hitPoints">
           <?php
           echo $hitPoints;
           ?>
           </span>
       
       <span id="hitDie">
           <?php
           echo $hitDice;
           ?></span>
       
       <span id="singleSave">
           <?php
           
           if($saveThrowOption == 1)
           {
               echo singleSave ($level); 
           }
           else
           {
               echo "";
           }
           
           ?>
       </span>
       
       
              
       <span id="saveMatrix">
           <?php
           
           if($saveThrowOption == 1)
           {
               echo ""; 
           }
           else
           {
               echo $saveMatrix[0];
               echo "<br/>";
               echo $saveMatrix[1] - $dwarfSaveMagic;
               echo "<br/>";
               echo $saveMatrix[2];
               echo "<br/>";
               echo $saveMatrix[3];
               echo "<br/>";
               echo $saveMatrix[4] - $dwarfSaveMagic;
           }
           
           ?>
       </span>
       
              <span id="saveMatrixDes">
           <?php
           
           if($saveThrowOption == 1)
           {
               echo ""; 
           }
           else
           {
               echo "vs. Death/Poison";
               echo "<br/>";
               echo "vs. Wands/Rays";
               echo "<br/>";
               echo "vs. Paralyze/Stone";
               echo "<br/>";
               echo "vs. Dragon Breath";
               echo "<br/>";
               echo "vs. Spells/Staffs";
           }
           
           ?>
       </span>
       
        <span id="saveMatrixTitle">
           <?php
           
           if($saveThrowOption == 1)
           {
               echo ""; 
           }
           else
           {
               echo "Saving Throws";
           }
           
           ?>
       </span>
       
       <span id="level">
           <?php
                echo $level;
           ?>
        </span>
       

              
         <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
       
       <span id="exBonus">
           <?php
                echo $exBonus . '%';
           ?>
       </span>
              
              
       <span id="totalWeaponWeight">
            <?php
                echo "Weapon weight: " . $totalWeaponWeight . " lb.";
            ?>
       </span>


       <span id="weaponsList">
           <?php
           $val1 = 0;
           $val2 = 0;
           $val3 = 0;

           $count = count($weaponNames);
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               if($count > 2)
               {
                echo ", ";
               }
               else if($count === 2)
               {
                echo " & ";
               }
               else
               {
                echo ".";
               }


               --$count;
               $val1 = isWeaponTwoHanded($theWeapon, $val1);
               $val2 = isWeaponBastardSword($theWeapon, $val2);
           }
           
           $val3 = $val1 + $val2;
           
           $weaponNotes = weaponNotes($val3);
           
           ?>  
        </span>
       
       <span id="weaponNotes">
           <?php
                echo $weaponNotes;
           ?>
        </span>
            
       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

       <span id="gearList">
           <?php
           
            $count = count($gearNames);
                    
            foreach($gearNames as $theGear)
            {
                echo $theGear;
                if($count > 2)
                {
                echo ", ";
                }
                else if($count === 2)
                {
                echo " & ";
                }
                else
                {
                echo ".";
                }

                --$count;

            }
           
           ?>
       </span>
           


       
       <span id="totalWeightCarried">
           <?php
           echo "Weight carried: " . $totalWeightCarried . " lbs / Movement Rate: " . $movementRate;
           ?>
       </span>

              
       <span id="specialAbility">
           <?php
           echo $specialAbility;
           echo $characterRaceTraits;
           echo '<br/><br/>' . $hirelings;
           ?>
       </span>
              
              
       
       <span id="wealth">
           <?php

           echo $gold . ' gold & ' . $silver . ' silver pieces';
           
           ?>
       </span>
       
       <span id="coinWeight">
           <?php
               echo 'Coin weight: ' . $coinWeight . ' lb.';
           ?>
       </span>
       

       
       <span id="abilityScoreGeneration">
            <?php
         //  echo $generationMessage;
           ?>
       </span>
       
       
       <span id="spellTitle">SPELLS PER LEVEL:</span>
       

       <span id=spellLevelTitle>
           <?php
           echo 'Level';
           ?>
       </span>
       
       
       <span id=spellNumberTitle>
           <?php
           echo 'Spells';
           ?>
       </span>
       
   
       <span id="spellsLevel1">
           <?php
           echo $spellLevel1;
           ?>
       </span>
       
       <span id="spellsLevel2">
           <?php
           echo $spellLevel2;
           ?>
       </span> 
       
       <span id="spellsLevel3">
           <?php
           echo $spellLevel3;
           ?>
       </span>       
       
       <span id="spellsLevel4">
           <?php
           echo $spellLevel4;
           ?>
       </span>       
       
       <span id="spellsLevel5">
           <?php
           echo $spellLevel5;
           ?>
       </span>       

       <span id="spellsLevel6">
           <?php
           echo $spellLevel6;
           ?>
       </span>       
       
       
       
       
       <span id="spellsForLevel1">
       <?php
           echo $spellsForLevel1;
           ?>
       </span>
       
       <span id="spellsForLevel2">
       <?php
           echo $spellsForLevel2;
           ?>
       </span>
       
       <span id="spellsForLevel3">
       <?php
           echo $spellsForLevel3;
           ?>
       </span>
       
       <span id="spellsForLevel4">
       <?php
           echo $spellsForLevel4;
           ?>
       </span>
       
       <span id="spellsForLevel5">
       <?php
           echo $spellsForLevel5;
           ?>
       </span>
       
       <span id="spellsForLevel6">
       <?php
           echo $spellsForLevel6;
           ?>
       </span>

     
       <span id="spellLine">
       
       <?php
           echo "________________________________________";
           ?>
       </span>
       
       

       
	</section>
	

		
  <script>
  

  
       let imgData = "images/magicUser_character_sheet.png";
      
        $("#character_sheet").attr("src", imgData);
      

	 
  </script>
		
	
    
</body>
</html>