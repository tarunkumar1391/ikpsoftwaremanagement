<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/9/16
 * Time: 5:55 PM

 **/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$sno2 = $finNok = $origNok = $sas = $nokl = $softreq = $dalloc = $lexpiry = $comm = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO allocatedsoftware (	selectedSoft, nokl, nameofRequester, dateofAlloc, licenseExpiry, comments) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissss", $sas, $nokl, $softreq, $dalloc, $lexpiry, $comm);

$stmt2 = $conn->prepare("UPDATE software SET Nok=? WHERE Sno=?");
$stmt2->bind_param("ii", $finNok,$sno2);

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $sas = isset($_POST['sas']) ? $_POST['sas'] : "0";
    $sno2 = isset($_POST['softid']) ? $_POST['softid'] : "0";
    $origNok = isset($_POST['origkeys']) ? $_POST['origkeys'] : "0";
    $nokl = isset($_POST['nokl']) ? $_POST['nokl'] : "0";
    $softreq = isset($_POST['softreq']) ? $_POST['softreq'] : "0";
    $dalloc = isset($_POST['dalloc']) ? $_POST['dalloc'] : "0";
    $lexpiry = isset($_POST['lexpiry']) ? $_POST['lexpiry'] : "0";
    $comm = isset($_POST['comm']) ? $_POST['comm'] : "0";

    if($nokl <= $origNok && $nokl > 0){
        $finNok = $origNok - $nokl;
    } else {
        echo"<h4>The chosen no. of licenses are more than what is present in the repository!!! Please enter valid no. of licenses and try again!!!</h4>";
    }
}





if ($stmt2->execute()) {
//    echo "Software db has been updated" ;
    if($stmt->execute()){
        echo "A new entry has been created successfully and the license database has been updated accordingly!! ".'\n' ;
        echo '<a href="../www/index.html">click here to return!!</a>';
//    header("Location: ../www/index.html");
    }else {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

} else {
die('execute() failed: ' . htmlspecialchars($stmt->error));
}


$stmt2->close();

//if( true === $stmt){
//    die('execute() failed: ' . htmlspecialchars($stmt->error));
//}
//

//printf ("New records created successfully", $stmt->error);



$stmt->close();
$conn->close();
?>