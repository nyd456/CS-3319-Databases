<!-- 
    Programmer Name: 06
    4.	Delete an existing doctor - View - UI validation data, message displaying 
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Delete Doctor</title>
</head>

<body>

    <?php
    include 'connectdb.php';
    if (isset($_POST['delete'])) {
        /*  validation - doctor is selected */
        if (!isset($_POST['licensenum'])) {
            $errors['licensenum'] = "Please select a doctor<br/>";
        } else {
            include 'deleteDoctor.php';
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center"> Delete a doctor</h2>
        <p class="info">All doctors:</p>
        <?php
        if (isset($errors['licensenum'])) {
            echo '<p class="error">' . $errors["licensenum"] . '</p>';
        }
        if (isset($errors['headOfHos']) || isset($errors['treatPatient'])) {
            echo '<p class="error">Doctor is not deleted:</p>';
            if (isset($errors['headOfHos'])) {
                echo '<p class="error">' . $errors["headOfHos"] . '</p>';
            }
            if (isset($errors['treatPatient'])) {
                echo '<p class="error">' . $errors["treatPatient"] . '</p>';
            }
        }
        ?>
        <form action="" method="post" id="deleteDoctForm">
            <?php
            include 'getDoctorList.php';
            ?>
            <input class="btn" type="submit" name="delete" value="Delete Doctor" onclick="return confirm('Are you sure you want to delete this doctor?');">
        </form>
    </div>
    <?php
    mysqli_close($connection);
    ?>
</body>

</html>