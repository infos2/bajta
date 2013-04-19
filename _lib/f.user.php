<?php
/* HASHING */ // Slow, even more secure > SQL friendly (dynamic salting)
function md1_password($input){
	usleep(50);
	if (empty($input)) return sha1('');
	$strlen = strlen($input);
	$input_part = str_split($input,(int)ceil($strlen/2));
	$dynamic_salt = substr(MAGIC_SALT,0,$strlen+1);
	return sha1($input_part[0].$dynamic_salt.$input_part[1]);
}

/* LOGIN LOGOUT */
function userLogin($email,$pass){
	$sql="SELECT id FROM ".TBL."korisnici WHERE email='".db::sqli($email)."' AND lozinka='".md1_password($pass)."'";
	$user = db::query_to_object($sql);
	return $user ? $_SESSION["userID"] = $user->id : false;
}

function userLoggedIn(){
	return getUserID()>0;
}

function userLogout(){
	unset($_SESSION["userID"]);
	phpRedirect();
}

/* GET user data */
function getUserID(){
	global $session;
	return $session->userID;
}

function getUser($select='*'){
	return selectUser(getUserID(),$select);
}

/* CRUD */
function selectUser($userID,$select='*'){
	$sql="SELECT ".db::sqli($select)." FROM ".TBL."korisnici WHERE id=".intval($userID);
	return db::query_to_object($sql);
}

function updateUser($userID,$data){
	foreach ((array)$data as $key=>$value) {
		if (is_numeric($value)) $set[]=db::sqli($key)."=".db::sqli($value)."";
		else $set[]=db::sqli($key)."='".db::sqli($value)."'";
	}
	$sql="UPDATE ".TBL."korisnici SET ".implode(',',$set)." WHERE id=".intval($userID);
	return db::query($sql);
}