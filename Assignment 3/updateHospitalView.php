<!-- 
    Programmer Name: 06
   8.Allow the user to select a hospital and change (UPDATE) the number of beds at that hospital.
   View - Create a UI to let user to select database and input update value
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Update Hospital View</title>
</head>

<body>
    <?php
    include 'connectdb.php';
    if (isset($_POST['select'])) {
        /*  validation - hospital is selected */
        if (!isset($_POST['hoscode'])) {
            $errors['hoscode'] = "Please select a hospital<br/>";
        }
    }
    if (isset($_POST['update'])) {
        /*  validation - hospital is selected */
        if (!isset($_POST['hoscode'])) {
            $errors['hoscode'] = "Please select a hospital<br/>";
        }
        /*  validation - number of bed is input */
        if (!isset($_POST['numofbed']) || strlen($_POST['numofbed']) === 0) {
            $errors['numofbed'] = "Please input the number of bed <br/>";
        }
        if (!isset($errors['hoscode']) && !isset($errors['numofbed'])) {
            include "updateHospital.php";
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center">Select Hospital To Update</h2>
        <?php
        if (isset($errors['hoscode'])) {
            echo '<p class="error">' . $errors["hoscode"] . '</p>';
        }
        if (isset($errors['numofbedOver'])) {
            echo '<p class="error">' . $errors["numofbedOver"] . '</p>';
        }
        ?>
        <form action="" method="post" id="dpViewForm">
            <p class="info">All Hospitals</p>
            <?php
            include 'getHospitals.php';
            ?>
            <input class="btn" type="submit" name="select" value="Select to update">

            <?php
            include 'updateHospitalForm.php'
            ?>
        </form>

    </div>
    <?php
    mysqli_close($connection);
    ?>
</body>

</html>