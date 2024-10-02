<!-- 
    Programmer Name: 06
    #3.	Insert a new doctor - database access - validation and add new doctor rercord 
-->

<?php
session_start();
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $birthday = $_POST["birthday"];
    $licenseNum = $_POST["licenseNum"];
    $licenseDate = $_POST["licenseDate"];
    $speciality = $_POST["speciality"];
    $hoscode = $_POST["hoscode"];

    /* check if doctor license number alreay exists */
    $query1 = 'SELECT * FROM doctor WHERE licenseNum ="' . $licenseNum . '"';
    $result = mysqli_query($connection,$query1);
    if (!$result) 
    {
        die("databases query failed.");
    }

    if(mysqli_num_rows($result) > 0)  //duplicated license number is found
    {
        $errors["duplicatedID"] = "Doctor with input license number already exists.";
        
     }else // insert a doctor only if license number doesn't exist
     {
        $query = 'INSERT INTO doctor values("' . $licenseNum . '","' .  $fName . '","' .  $lName 
        . '","' . $licenseDate . '","' . $birthday 
        . '","' . $hoscode . '","' . $speciality . '")';
        if (!mysqli_query($connection, $query)) {
            die("Error:insert failed" . mysqli_error($connection));
        }

        $_SESSION['success'] = "Doctor <i>" . $licenseNum . " - " .  $fName .  " " . $lName . "</i> was added";
        header('Location:index.php');
        exit();
        ob_flush();
     }
     mysqli_free_result($result);
     ?>