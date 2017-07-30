<?php
$data = "";

if($_POST['id'] == "1"){
	$data .= "Strength – Increases damage for the Fighter Class<br />Dexterity – Increases chance to hit and speed for Fighter Class<br />Endurance – Amount of hit points your character has<br />Intelligence – Increases mana for both classes and increases damage for Mage Class<br />Concentration – Increases chance to hit and speed for Mage Class";
}elseif($_POST['id'] == "2"){
	$data .= "In order to gain levels you need to get experience by killing mobs in the attack bar. For a Mage class, you will need Intelligence and Concentration in order to move up to higher level mobs while as a Fighter class you will need Strength and Dexterity in order to move up. Each mob gives a certain amount of experience and gold per kill. While leveling you always want to stick to a mob you can kill in one hit and does not hit you at any time.";
}elseif($_POST['id'] == "3"){
	$data .= "Yes, go to the Training Facility which is located from the Navigate drop down and it will show you what is needed in order to move up your class. You will need a certain level, amount of blood, and gold in order to level up your class. When you level up your class it adds more stat points each level to the stats your class uses. <br /><br />Example: <br />Mage Class II – Your Endurance, Intelligence, and Concentration have +1 stat per level added to them";
}elseif($_POST['id'] == "4"){
	$data .= "At the Training Facility there is an option to switch from the class you are playing to a different class. This costs 100million gold and requires you to be level 5000. When switching your class, you keep your current base stats, or your stats without any items equipped. You also keep your items and gold but do not get access to the current blood that you have. That blood will stay with your previous class and can be accessed again if you switch back to that class. The bonus to switching classes is that you get to start the new class at level 1 but will have higher stats then players who begin with that class.";
}elseif($_POST['id'] == "5"){
	$data .= "At any time a random drop of gold, blood, cash, demons, or mana regeneration can happen. Mana regeneration will regenerate your base stat and moves your mana bar down to your base stat level. The gold, blood, and cash are random drops and can be many different numbers of it.";
}elseif($_POST['id'] == "6"){
	$data .= "Items can be dropped by monsters that you kill or bought in the Shop. The Shop is located from the Navigate drop down menu. Items will require a certain level in order to use. The weapons that are highlighted in Red are too high of level for you and you will not be able to equip the item until its level requirements are met.<br /><br /> Example:<br /> Shining Staff – Weapon – Level 16<br />In order to use the shining staff you need to be level 16. As you level higher the items will have better stats and cost more.";
}elseif($_POST['id'] == "7"){
	$data .= "Trade skill changes how much an item in the shop will cost you and also how much money you will get when you sell it back to the shop. With a 100% Trade Skill you will get the exact price you paid for it while with a lower Trade Skill you will get slightly less than what you paid for it. The Trade Skill only works on items that are bought in the shop and sold to the shop.";
}elseif($_POST['id'] == "8"){
	$data .="Spells can be purchased through Divination which is located from the Navigate drop down menu. Each spell requires a certain amount of gold, blood, and base Intelligcnce. Base Intelligence is your Intelligence without any items equipped.<br /><br />Example:<br />Might level 1 spell – 1,000 Intelligence, 10,000 blood, 1 million gold<br /><br />In order to be able to get the Might level 1 spell you need to have 1,000 base Intelligence along with 10,000 blood and 1million gold. Each increase in spell level costs more stat, blood, and gold. Each level of the spell adds 10% bonus to that stat. So Might level 1 would add 10% bonus to your strength. This bonus includes the strength you have from items. The stat point requirements are not taken from your current stats.";
}elseif($_POST['id'] == "9"){
	$data .="Affinity slots are what spells are cast onto. When a player starts the game they have three affinity slots available. There is a total of nine affinity slots possible and each extra affinity slot costs 20 Cash.";
}elseif($_POST['id'] == "10"){
	$data .="From the Navigate drop down menu, you will be able to add your statpoints to any stat that you would like to increase. If you wait till you have 10 statpoints when you increase the stat it will give you a 10% bonus to the stats you receive.<br /><br />Example:<br />Fighter class has 10 or more stat points and increase Strength by 10. The bonus would make it so that you actually get 11 stats added to your Strength";
}elseif($_POST['id'] == "11"){
	$data .="When you click on the Temple link from the Navigate drop down menu, you will be able to donate to the Temple. When a player donates 250,000 gold or more they have a chance of getting spells cast on them. Sometimes it will cast spells sometimes it will not, it is random. It can cast any level of spell and any type of spell.<br /><br />Example:<br />Mercerdemarco donates 250,000 gold to temple<br />Temple casts Strength II on Mercerdemarco";
}elseif($_POST['id'] == "12"){
	$data .="The Bank is a place where you can store gold so that other players can't steal it from you with Voodoo. Each deposit will cost 5% of the gold you are depositing in order to pay the bank to hold it. Gold, when withdrawn, does not have any fee taken from it. You can reduce your bank fee by 1% for 5 Cash.";
}elseif($_POST['id'] == "13"){
	$data .="Voodoo is located from the Navigate drop down menu and will give you the option to steal gold or blood from another player. Stealing gold only works 15% of the time and it costs the players level that you are trying to steal from times 10. So the higher level the player, the more it costs in gold to attempt to steal gold from the player. The gold is only taken off of what the player has on him and not what is located in the bank. When stealing gold, if successful, you will get 1-25% of the players gold. Stealing blood works around 10% of the time and costs 15 times the players level. When stealing blood you get 1-100 ounces of their blood.";
}elseif($_POST['id'] == "14"){
	$data .="Guilds are where a group of players work together to level, get items, and bonuses. Since players can cast spells on each other often times in guilds, members are willing to cast higher level spells on others to help level faster and hit higher mobs.<br /><br />Bonuses:<br />Exp bonus – can upgrade to give more percentage of xp per kill<br />Gold bonus – Can upgrade to give more percentage of gold dropped per kill<br />Item Drop – Upgraded it gives a percentage more of a chance for an item to drop<br />Item Boost – Upgraded gives a boost to stats from items used";
}elseif($_POST['id'] == "15"){
	$data .="After a person votes they have the choice of choosing to get 5,000 gold, 100 blood, or 10 stats to spend. A person can vote once per every 24 hours. Vote for 14 days in a row and get 1 Cash! Voting helps get the game higher on the game pages so more people see the game and that means they may try it out. Voting is very important to help the game progress and get more players.";
}elseif($_POST['id'] == "16"){
	$data .="The trade link is where players can put items up for sale. They can sell any item that drops and even cash on the trade screen. This is a good place to look for upgrades to items so you can get a higher bonus to stats.";
}elseif($_POST['id'] == "17"){
	$data .="Cash is an ingame currency that can be purchased through the cash link at the top right side of the screen. Cash is a way to increase options for your character or get gold, blood, and stats. To spend your Cash, click on the Cash button in the top right of your screen. The button is outlined in purple. Cash can also be sold in the trade area to other players for gold.";
}elseif($_POST['id'] == "18"){
	$data .="Demons are random spawns, as in they are summoned randomly as people click the attack buttons, and can drop gold, blood, stats, and even cash. There are two different levels of demons. The regular level and the overlords. The regular level demons drop lower amounts of the items that are dropped while the overlords drop more. Overlords have more life and are for players over 5,000 levels while the regular ones are for players below 5,000 levels. Attacking a Demon are off your base stats/2. Base stats are your stats without any items equipped.<br /><br />Incubus (1,500,000 gold/10mil)<br />Barbatos (250 stats/1000 stats)<br />Gula (1 cash/3 cash)<br />Eurynome (300 blood/1200 Blood)<br />";
}elseif($_POST['id'] == "19"){
	$data .="Scavenges can be accepted from the Scavenger. This is located from the Navigate drop down menu. Scavenges are quests that you can take to earn gold, blood, stats, and if you are lucky, Cash.  You can pick which monster you want to take the Scavenge for by choosing it from the drop down and clicking on Begin Adventure. Each Scavenge will require a certain amount of items to be collected from the monster at a particular coordinate. The drops for Scavenges are random.";
}elseif($_POST['id'] == "21"){
	$data .="When you click on the Travel button in the bottom right corner of the screen, it will bring up the map. From here, you will need to click on the arrows near the top to the next coordinate. You can also use the arrow keys to move around the map. You can also fight Demons and pick up Bags on the map. For quicker traveling, you can buy a Teleporter for 25 Cash and teleporter to a coordinate instantly! The Teleporter has a 7 minute cooldown.";
}else{
	$data .= "Im sorry. We were unable to find an answer for you, NERD!";
}

print("fillDiv('answer','".$data."');");
?>