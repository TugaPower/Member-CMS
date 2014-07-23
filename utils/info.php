<?php
/**
 * Class used to store useful information that will be used all over the place
 */

$version = "0.7";

#######################
### DATABASE ACCESS ###
#######################
/**
 * Database Format
 *
 * "Members" Table = ID, username (text), password (text), email (text), isMojangAccount (text), isAdmin (text), joined (timestamp)
 *      - The "username" should the identical to the Minecraft one
 *      - The "password" NEEDS to be encrypted
 *      - If the player has a Mojang account, the "email" should be identical. If that isn't the case, it can be whatever email the player wishes
 *      - The "isMojangAccount" field will be true if the player
 *      - The "isAdmin" field will be true if the player is an admin
 *      - The "joined" field will have the player's register timestamp
 *
 * "Tokens" table = ID, token (text), canBeUsed (int), timesUsed (int), created (timestamp), expires (timestamp)
 * (used to store the security tokens needed to registration)
 *      - The "token" field contains the token code
 *      - The "canBeUsed" field contains the times that the token can be used
 *      - The "timesUsed" field contains the times that the tokes was been used
 *      - The "created" field contains the token's creation timestamp
 *      - The "expires" field contains the token's expiration timestamp
 *
 * "ES_Frequencies" table = ID, type (text), color1(text), color2(text), color3(text), description(text), owner(text), registered (timestamp)
 * (used to store the Ender Storage frequencies (Ender Chests and Ender Tanks))
 *      - The "type" field contains the type of storage (Ender Chest or Ender Tank)
 *      - The "color1", "color2 and "color3" fields contains the frequency
 *      - The "description" field contains the use of that frequency
 *      - The "owner" field contains the username of the frequency's owner
 *      - The "registered" field contains the timestamp of when the frequency was registered
 */

$db_host = "localhost";
$db_username = "tugapower";
$db_password = "G*9znlLZ2H71";
$db_database = "tugapower";

###################
### CREEPER API ###
###################
$creeper_key = "NDc4-NTYzMDUw-NTUyNDM5-MTIyMTc3-NzYzMjEx-Njg0MTA4";