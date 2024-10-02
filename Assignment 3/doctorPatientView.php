<!-- 
    Programmer Name: 06
   6.	Allow the user to select a doctor and see the first and last name 
   and ohip number of any patient treated by that doctor. 
   View - UI validation and data message displaying
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Doctor Patient View</title>
</head>

<body>
    <?php
    include 'connectdb.php';
    if (isset($_POST['submit'])) {
        /*  validation - doctor is selected */
        if (!isset($_POST['licensenum'])) {
            $errors['licensenum'] = "Please select a doctor<br/>";
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center">View Doctor Patient Information</h2>
        <?php
        if (isset($errors['licensenum'])) {
            echo '<p class="error">' . $errors["licensenum"] . '</p>';
        }
        ?>
        <form action="" method="post" id="dpViewForm">
            <p class="info">All Doctors</p>
            <?php
            include 'getDoctorList.php';
            ?>
            <input class="btn" type="submit" name="submit" value="View Doctor Patient Info">
        </form>
    </div>

    <div class="divForm">
        <table id="patients">
            <?php
            if (isset($_POST['licensenum'])) {
                include 'getPatientsByDoctor.php';
            }
            ?>
        </table>
    </div>

    <?php
    mysqli_close($connection);
    ?>
</body>

</html>