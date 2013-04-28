<?php
#NOTE tu idu CRUD funkcije za bazu koje ne smiju biti dostupne nigdje drugdje nego u adminu

function navigation(){
	return empty($html) ? false : wrap($html,'ul','action');
}