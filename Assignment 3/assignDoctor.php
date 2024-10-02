<!-- 
    Programmer Name: 06
    5.	Assign a doctor to a patient - database access - 
    validation and add insert record to the relation table 
-->
<?php
session_start();
if (isset($_POST["licensenum"]) && isset($_POST["ohipnum"])) {
    $licenseNum = $_POST["licensenum"];
    $ohipnum = $_POST["ohipnum"];
    /* check if doctor was already assigned to the patient */
    $query1 = 'SELECT * FROM looksafter WHERE licensenum ="' . $licenseNum . '" and ohipnum = "' . $ohipnum . '"';
    $result = mysqli_query($connection, $query1);
    if (!$result) {
        die("databases query failed.");
    }
    if (mysqli_num_rows($result) > 0) {
        $errors["aleadyAssigned"] = "Patient already assigned to this doctor";
    }else{
        $query = 'INSERT INTO looksafter VALUES ("' . $licenseNum . '",' . '"' . $ohipnum . '");';
        if (!mysqli_query($connection, $query)) {
            die("Error:delete failed" . mysqli_error($connection));
        }
        $_SESSION['success'] = "Doctor with license number <i>" .  $licenseNum . "</i> was assigned to the patient with ohip number <i>" .  $ohipnum . "</i>";
        header('Location:index.php');
        exit();
        ob_flush();
    }
}
mysqli_free_result($result);
?>