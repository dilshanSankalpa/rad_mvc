<?php
//(A)databse connectin
require "../model/model.php";
$DB = new DB();

//get json values
$data = json_decode(file_get_contents('php://input'), true);


// (B) serch ofr users 
$DB->insert("INSERT INTO user_reg(f_name, l_name, password) VALUES (?,?,?)",$data);

//(C)output results
$publisher_id = $pdo->lastInsertId();

echo 'The publisher id ' . $publisher_id . ' was inserted';
?>