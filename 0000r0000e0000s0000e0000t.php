<?php

include('db.php');



$gettemple = mysqli_query("SELECT * FROM temple");

$temple = mysqli_fetch_assoc($gettemple);

$update1 = mysqli_query("UPDATE characters SET temple='0'");



$getUsers = mysqli_query("SELECT * FROM characters");

while($userMana = mysqli_fetch_array($getUsers)){

    $getchar = mysqli_query("SELECT * FROM characters WHERE id='".$userMana['id']."'");

    $char = mysqli_fetch_assoc($getchar);

    $getequip = mysqli_query("SELECT * FROM inventory WHERE username='".$char['username']."' AND equipped='Yes'");

    if(mysqli_num_rows($getequip) > "0")

    {

    	$eqintbon = 0;

        while($equip = mysqli_fetch_array($getequip))

        {

            $eqintbon += $equip['intelligence'];

        }

    }



    $charint = $char['intelligence'] + $eqintbon;

    

    $updateMana = mysqli_query("UPDATE characters SET mana='".$charint."' WHERE username='".$char['username']."'");

}



$addAttempt = mysqli_query("UPDATE characters SET vodooattempt='0'");

$addlogin = mysqli_query("UPDATE characters SET dailylogin='0'");





$updatedBlessings1 = "None, Buy, Buy, Buy, Buy, Buy, Buy, Buy, Buy"; 

$runblessingReset1 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings1."' WHERE affinitys='1'");

$updatedBlessings2 = "None, None, Buy, Buy, Buy, Buy, Buy, Buy, Buy"; 

$runblessingReset2 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings2."' WHERE affinitys='2'");

$updatedBlessings3 = "None, None, None, Buy, Buy, Buy, Buy, Buy, Buy"; 

$runblessingReset3 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings3."' WHERE affinitys='3'");

$updatedBlessings4 = "None, None, None, None, Buy, Buy, Buy, Buy, Buy"; 

$runblessingReset4 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings4."' WHERE affinitys='4'");

$updatedBlessings5 = "None, None, None, None, None, Buy, Buy, Buy, Buy"; 

$runblessingReset5 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings5."' WHERE affinitys='5'");

$updatedBlessings6 = "None, None, None, None, None, None, Buy, Buy, Buy"; 

$runblessingReset6 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings6."' WHERE affinitys='6'");

$updatedBlessings7 = "None, None, None, None, None, None, None, Buy, Buy"; 

$runblessingReset7 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings7."' WHERE affinitys='7'");

$updatedBlessings8 = "None, None, None, None, None, None, None, None, Buy"; 

$runblessingReset8 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings8."' WHERE affinitys='8'");

$updatedBlessings9 = "None, None, None, None, None, None, None, None, None"; 

$runblessingReset9 = mysqli_query("UPDATE characters SET blessing='".$updatedBlessings9."' WHERE affinitys='9'");





$messagechat = "<strong><font color=\'#00FF00\'>(System): Daily reset occured. Blessings reset, Temple reset, Mana rejuvinated.</font></strong><br />";

$query = mysqli_query("INSERT INTO chatroom (`date`, `userlevel`, `message`, `to`) VALUES ('".$date."', '3', '".$messagechat."', 'Chatroom')");

?>
