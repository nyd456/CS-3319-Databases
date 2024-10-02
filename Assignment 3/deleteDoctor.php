<!-- 
    Programmer Name: 06
    4.	Delete an existing doctor - database access - validation and delete doctor rercord 
-->
<?php
session_start();
if (isset($_POST["licensenum"])) {
    $licenseNum = $_POST["licensenum"];

    /* check if doctor is the head of a hospital */
    $query1 = 'SELECT * FROM hospital WHERE headdoc ="' . $licenseNum . '"';
    $result = mysqli_query($connection, $query1);
    if (!$result) {
        die("databases query failed.");
    }
    if (mysqli_num_rows($result) > 0) {
        $errors["headOfHos"] = "The selected doctor is the head of a hospital.";
    }
    /* check if doctor is the head of a hospital */
    $query2 = 'SELECT * FROM looksafter WHERE licensenum ="' . $licenseNum . '"';
    $result = mysqli_query($connection, $query2);
    if (mysqli_num_rows($result) > 0) {
        $errors["treatPatient"] = "The selected doctor is treating patients";
    }

    // the selected doctor is not the head of a hospital also not treating patients
    if (!isset($errors["headOfHos"]) && !isset($errors["treatPatient"])) {

        $query = 'DELETE FROM doctor WHERE licensenum ="' . $licenseNum . '"';
        if (!mysqli_query($connection, $query)) {
            die("Error:delete failed" . mysqli_error($connection));
        }

        $_SESSION['success'] = "Doctor with license number <i>" .  $licenseNum . "</i> was deleted";
        header('Location:index.php');
        exit();
        ob_flush();
    }
    mysqli_free_result($result);
}
?>