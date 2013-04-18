<?php
class db { // MySQLi database driver
	private static $instance = null;
	private static $last_sql;
	private static $link;

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::connect();
            self::db_query("SET NAMES 'utf8'");
        }
        return self::$instance;
    }
    
    /* PUBLIC */
	public static function query($sql){
 		return self::db_query($sql) ? true : false;
    }
    
    public static function query_to_object($sql){
		$result = self::db_query($sql);
		return ($row=self::fetch_object($result)) ? $row : false;
    }
    
    public static function query_to_objects($sql){
		$result = self::db_query($sql);
		$rows = array();
		while ($row=self::fetch_object($result)) $rows[]=$row;
		return $rows;
    }
	
	public static function query_to_JSON($sql){
		$rows = self::query_to_objects($sql);
		return json_encode($rows);
	}
	
	public static function insert_id(){
		return mysqli_insert_id(self::$link);
	}
	
	public static function sqli($value) {
		if(get_magic_quotes_gpc()) $value = stripslashes($value); 
		$value = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string(self::$link,$value) : addslashes($value); 
		return trim($value);
	}
    
    /* PRIVATE */
    private static function db_query($sql){
    	self::$last_sql = $sql;
    	return ($result=mysqli_query(self::$link,$sql)) ? $result : self::db_error();
    }
    
    private static function fetch_object($result){
    	if ($result->num_rows==0) return false;
    	return ($row=mysqli_fetch_object($result)) ? $row : false;
    }
    
    /* CONNECTION */
    private static function connect(){
		self::$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
		if (!self::$link) die("Database connection error (".mysqli_connect_errno()."): ".mysqli_connect_error());
	    if (!mysqli_select_db(self::$link,DB_NAME)) die("Database selection failed: ".mysqli_error(self::$link));
	}
	
	private static function db_error($sql=null){
		$e = new Exception;
		var_dump($e->getTraceAsString());
		die("Database error (".mysqli_errno(self::$link)."): ".mysqli_error(self::$link).';'.self::$last_sql);
	}
}
