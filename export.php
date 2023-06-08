<?php

include 'db.php';
$query = "SELECT * FROM customer";
$result = mysqli_query($db_connection, $query);

$html = "<table><tr><td>Name</td></tr>";


while($row = mysqli_fetch_assoc($result)){
    $html .= "<tr><td>".$row['name']."</td></tr>";
};

$html .= "</table>";
//
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=authors_table.xls');
echo $html;
