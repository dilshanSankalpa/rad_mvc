<?php
//(A)databse connectin
require "../model/model.php";
$DB = new DB();

// (B) serch ofr users 
$results = $DB->select(
    "SELECT * FROM `games` WHERE `game` LIKE ? ",
    ["%{$_POST['search']}%"]
);

//(C)output results
echo json_encode(count($results) == 0 ? null : $results);
?>