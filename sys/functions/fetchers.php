<?php
require_once 'sys/settings.php';
function fetch_categories(){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query = "SELECT * FROM Categories";
	
	$cats = array();
	
	if($result = $mysqli -> query($query)){
		while($row = $result -> fetch_object()){
			$cats[] = array('id' => $row -> id, 'name' => $row -> name);
		}
		return $cats;
	}
	else {
		return false;
	}
}

function fetch_users(){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query = "SELECT * FROM Users";
	
	$users = array();
	
	if($result = $mysqli -> query($query)){
		while($row = $result -> fetch_object()){
			$users[] = array('id' => $row -> id, 'name' => $row -> name, 'mail' => $row -> mail, 'registered' => $row -> registered, 'isAdmin' => $row -> isAdmin);
		}
		return $users;
	}else{
		return false;
	}
}

function fetch_products ($name = '', $cats = array(), $user = '', $randomOrder = true) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset('UTF8');
	$query  = 'SELECT Products.id, Products.name, Products.description, price, Categories.id AS cat_id, Categories.name AS cat_name, Users.id AS user_id, Users.name AS user_name FROM Products ';
	$query .= 'LEFT JOIN Categories ON Categories.id = cat_id LEFT JOIN Users ON Users.id = user_id';
	
	if (!empty($name) || !empty($cats) || !empty($user)) {
		
		$query .= ' WHERE true ';
		
		if (!empty($name))
			$query .= 'AND Products.name LIKE "%' . $mysqli -> real_escape_string($name) . '%" ';
		
		if (!empty($cats)) {
			$query .= 'AND (';
			
			$a = 0;
			
			foreach($cats as $this_cat) {
				if ($a > 0)
					$query .= 'OR ';
				
				$query .= 'cat_id = "' . $mysqli -> real_escape_string($this_cat) . '" ';
				
				$a ++;
			}
			
			$query .= ') ';
		}
		
		if (!empty($user))
			$query .= 'AND user_id = "' . $mysqli -> real_escape_string($user) . '" ';
		
	}
	
	if ($randomOrder)
		$query .= ' ORDER BY RAND()';
	else
		$query .= ' ORDER BY name';
	
	if ($result = $mysqli -> query($query)) {
		$products = array();
		
		while ($row = $result -> fetch_object()) {
			$products[] = array('id' => $row -> id, 'name' => $row -> name, 'cat_id' => $row -> cat_id, 'cat_name' => $row -> cat_name, 'user_id' => $row -> user_id, 'user_name' => $row -> user_name, 'description' => $row -> description, 'price' => $row -> price, 'sql' => $query);
		}
		return $products;
	}
	else {
		//return false;
		
		$errorresult = array('sql' => $query, 'error' => $mysqli -> error);
		
		return $errorresult;
	}
	
}

function fetch_random_products ($limit) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query  = 'SELECT Products.id, Products.name, Products.description, price, Categories.id AS cat_id, Categories.name AS cat_name, Users.id AS user_id, Users.name AS user_name FROM Products ';
	$query .= 'LEFT JOIN Categories ON Categories.id = cat_id LEFT JOIN Users ON Users.id = user_id ORDER BY RAND() LIMIT ' . $mysqli -> real_escape_string($limit);
	
	if ($result = $mysqli -> query($query)) {
		while ($row = $result -> fetch_object()) {
			$products[] = array('id' => $row -> id, 'name' => $row -> name, 'cat_id' => $row -> cat_id, 'cat_name' => $row -> cat_name, 'user_id' => $row -> user_id, 'user_name' => $row -> user_name, 'description' => $row -> description, 'price' => $row -> price, 'sql' => $query);
		}
		return $products;
	}
	else {
		return false;
	}
}

function fetch_product ($id) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query  = 'SELECT Products.id, Products.name, Products.description, price, Categories.id AS cat_id, Categories.name AS cat_name, Users.id AS user_id, Users.name AS user_name FROM Products ';
	$query .= 'LEFT JOIN Categories ON Categories.id = cat_id LEFT JOIN Users ON Users.id = user_id WHERE Products.id = "' . $mysqli -> real_escape_string($id) . '"';
	
	if ($result = $mysqli -> query($query)) {
		$row = $result -> fetch_array();
		return $row;
	}
	else {
		return false;
	}
}

function fetch_user($id = '', $name = ''){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	if(!empty($id) && !empty($name)){
		return false;	
	}
	if(!empty($id)){
		$query = "SELECT * FROM Users WHERE id=" . $id;
	}
	if(!empty($name)){
		$query = "SELECT * FROM Users WHERE name=" . $id;
	}
	
	if($result = $mysqli -> query($query)){
		$row = $result -> fetch_array();
		return $row;
	}else{
		return false;
	}
}

function fetch_category($id){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query = "SELECT * FROM Categories WHERE id=" . $id;
	
	if($result = $mysqli -> query($query)){
		$row = $result -> fetch_array();
		return $row;
	}else{
		return false;
	}
}

function fetch_products_from_category($id){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query = "SELECT * FROM Products WHERE cat_id=" . $id;
	
	$prods = array();
	
	if($result = $mysqli -> query($query)){
		while($row = $result -> fetch_object()){
			$prods[] = array('id' => $row -> id, 'name' => $row -> name, 'cat_name' => $row -> cat_id, 'user_name' => $row -> user_id, 'description' => $row -> description, 'price' => $row -> price);
		}
		return $prods;
	}
	else {
		return false;
	}
}
?>