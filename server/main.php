<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$Sname = $Dop = $Tol = $Price = $Vname = $Nok = $Order = $kostenstelle = $Description = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO software (Sname, Dop, Tol, Price, Vname, Nok, Ordernum, kostenstelle, Description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisisss", $Sname, $Dop, $Tol, $Price, $Vname, $Nok, $Order,$kostenstelle, $Description);

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $Sname = isset($_POST['sname']) ? input($_POST['sname']) : "0";
    $Dop = isset($_POST['dop']) ? input($_POST['dop']) : "0";
    $Tol = isset($_POST['tol']) ? input($_POST['tol']) : "0";
    $Price = isset($_POST['price']) ? input($_POST['price']) : "0";
    $Vname = isset($_POST['vname']) ? input($_POST['vname']) : "0";
    $Nok = isset($_POST['nok']) ? input($_POST['nok']) : "0";
    $Order = isset($_POST['ordernum']) ? input($_POST['ordernum']) : "0";
    $kostenstelle = isset($_POST['kostenstelle']) ? input($_POST['kostenstelle']) : "0";
    $Description = isset($_POST['desc']) ? input($_POST['desc']) : "0";



}


if ($stmt->execute()) {
   echo "A new entry has been created successfully!! ".'\n' ;
    echo '<a href="../www/index.html">click here to return!!</a>';
//    header("Location: ../www/index.html");
    
} else {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

//if( true === $stmt){
//    die('execute() failed: ' . htmlspecialchars($stmt->error));
//}
    //

//printf ("New records created successfully", $stmt->error);


$stmt->close();
$conn->close();
?>