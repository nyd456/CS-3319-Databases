<!-- 
    Programmer Name: 06
   2. Allow the user to select one of the specialties and then list all 
   the doctor information about just doctors with this specialty. 
   View - UI validation and data message displaying
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>View Doctor By Specialty</title>
</head>

<body>
    <?php
    include 'connectdb.php';
    if (isset($_POST['submit'])) {
        /*  validation - specialty is selected */
        if (!isset($_POST['speciality'])) {
            $errors['speciality'] = "Please select a speciality<br/>";
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center">View Doctor By Specialty</h2>
        <?php
        if (isset($errors['speciality'])) {
            echo '<p class="error">' . $errors["speciality"] . '</p>';
        }
        ?>
        <form action="" method="post" id="dpViewForm">
            <?php
            include 'getSpecialties.php';
            ?>
            <input class="btn" type="submit" name="submit" value="View Doctor By Specialty">
        </form>
        <table id="doctors">
            <?php
            if (isset($_POST['speciality'])) {
                include 'getDoctors.php';
            }
            ?>
        </table>
    </div>
    <?php
    mysqli_close($connection);
    ?>

</body>

</html>