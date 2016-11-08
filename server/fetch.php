<?php
/**
 * Created by PhpStorm.
 * User: Haus-IT
 * Date: 7/6/2016
 * Time: 11:20 AM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");

$result = $conn->query("SELECT * FROM software");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["Sno"] . '",';
    $outp .= '"Sname":"'  . $rs["Sname"] . '",';
    $outp .= '"Dop":"'  . $rs["Dop"] . '",';
    $outp .= '"Tol":"'   . $rs["Tol"] . '",';
    $outp .= '"Price":"'. $rs["Price"] . '",';
    $outp .= '"Vname":"'. $rs["Vname"] . '",';
    $outp .= '"Nok":"'. $rs["Nok"] . '",';
    $outp .= '"Ordernum":"'. $rs["Ordernum"] . '",';
    $outp .= '"kostenstelle":"'. $rs["kostenstelle"] . '",';
    $outp .= '"Description":"'. $rs["Description"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>



