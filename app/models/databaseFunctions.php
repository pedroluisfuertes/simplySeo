<?php

function getConnection(): PDO
{
    $credentials = parse_ini_file("./app/config/database.config.php");
    try { 
        //echo "$this->dbType:host=$this->host;dbname=$this->name;charset=utf8";
        $connection = new PDO("mysql:host=".$credentials['host'].";dbname=".$credentials['name'].";charset=utf8", $credentials['user'], $credentials['password']); 
        $connection->setAttribute( PDO::ATTR_PERSISTENT, true ); //Keep alive the db connection
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) { 
        throw new Exception("DataBaseMySQL connection fail: " . $e->getMessage());
    }
    return $connection; 
}

function prepare(string $sql): PDOStatement
{
	return getConnection()->prepare( $sql );
}

function addSite(string $name, string $domain, string $repo = "", string $googleAnalitics = "")
{
    $sql = "INSERT INTO `sites`(`title`, `domain`, `gitRepo`, `analytics`) VALUES (:name, :domain, :gitRepo, :analytics)";
	try {
		$st = prepare($sql);
		$st->bindValue( ":title", $title, PDO::PARAM_STR );
		$st->bindValue( ":domain", $domain, PDO::PARAM_STR );
		$st->bindValue( ":gitRepo", $gitRepo, PDO::PARAM_STR );
		$st->bindValue( ":analytics", $analytics, PDO::PARAM_STR );
		$st->execute();
		return $st->fetch(PDO::FETCH_ASSOC);  
	}catch ( PDOException $e ) {
		die( "PDO query fail: " . $e->getMessage() );
    }

}

function getSiteById(int $id):array
{
    $sql = "SELECT * FROM sites WHERE id = :id"; 
	try {
		$st = prepare($sql);
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $aux = $st->fetch(PDO::FETCH_ASSOC);
        if(is_array($aux)){
            return $aux;
        }else{
            return [];
        }
	}catch ( PDOException $e ) {
		die( "PDO query fail: " . $e->getMessage() );
    }
            
}

function getSites():array
{
    $sql = "SELECT id, name, domain FROM sites"; 
	try {
		$st = prepare($sql);
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		return $st->fetchAll(PDO::FETCH_ASSOC);  
	}catch ( PDOException $e ) {
		die( "PDO query fail: " . $e->getMessage() );
    }
            
}