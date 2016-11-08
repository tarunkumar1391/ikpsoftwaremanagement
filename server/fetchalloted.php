<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/9/16
 * Time: 7:46 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");

$result = $conn->query("SELECT * FROM allocatedsoftware");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp .= '"selectedSoft":"'  . $rs["selectedSoft"] . '",';
    $outp .= '"nokl":"'  . $rs["nokl"] . '",';
    $outp .= '"nameofRequester":"'   . $rs["nameofRequester"] . '",';
    $outp .= '"email":"'   . $rs["requester_email"] . '",';
    $outp .= '"mac_device":"'   . $rs["mac_device"] . '",';
    $outp .= '"requester_roomNo":"'   . $rs["requester_roomNo"] . '",';
    $outp .= '"requester_groupName":"'   . $rs["requester_groupName"] . '",';
    $outp .= '"dateofAlloc":"'. $rs["dateofAlloc"] . '",';
    $outp .= '"licenseExpiry":"'. $rs["licenseExpiry"] . '",';
    $outp .= '"Comments":"'. $rs["comments"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>
