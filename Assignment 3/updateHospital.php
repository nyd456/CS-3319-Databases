<!-- 
    Programmer Name: 06
   8.Allow the user to select a hospital and change (UPDATE) the number of beds at that hospital.
   Database access - validation and update hospital table (numofbed field)
-->
<?php
session_start();
if (isset($_POST["hoscode"]) && isset($_POST["numofbed"])) {
    $numofbed = $_POST["numofbed"];
    $hoscode = $_POST["hoscode"];
    if ($numofbed >= 32767 || $numofbed < 0) {
        // The SMALLINT data type stores small whole numbers that range from –32,767 to 32,767
        $errors['numofbedOver'] = "The data type for this field is SMALLINT. <br> Please input an positive interger(maximum valid value is 32766)<br/>";
    } else {
        /* update the number of bed for the hospital */
        $query = 'UPDATE hospital SET numofbed =' .  $numofbed . ' WHERE hoscode="' . $hoscode . '"';
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("databases query failed.");
        }
        $_SESSION["updateSucc"] = 'The number of bed at the hospital <i>' . $hoscode . '</i> was updated <br> ';
        header('Location:hospitalView.php');
        exit();
        ob_flush();
        mysqli_free_result($result);
    }
}
?>