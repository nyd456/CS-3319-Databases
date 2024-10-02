<!-- 
    Programmer Name: 06
   7.	Allow the user to select a hospital and display 
   View - display a list of hospitals and the details of 
   the selected hospital
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Hospital View</title>
</head>

<body>
    <?php
    session_start();
    include 'connectdb.php';
    if (isset($_POST['submit'])) {
        /*  validation - hospital is selected */
        if (!isset($_POST['hoscode'])) {
            $errors['hoscode'] = "Please select a hospital<br/>";
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center">View Hospital Deatils</h2>
        <?php
        if (isset($_SESSION['updateSucc'])) {
            echo '<p class="success">' . $_SESSION['updateSucc'] . '</p>';
            $_SESSION['updateSucc'] = "";
        }
        ?>
        <?php
        if (isset($errors['hoscode'])) {
            echo '<p class="error">' . $errors["hoscode"] . '</p>';
        }
        ?>
        <form action="" method="post" id="dpViewForm">
            <p class="info">All Hospitals</p>
            <?php
             include 'getHospitals.php';
            ?>
            <input class="btn" type="submit" name="submit" value="View Hospital Details">
        </form>
        <?php
        include 'getHospitalDetails.php'
        ?>
    </div>
    <?php
    unset($_SESSION["updateSucc"]);
    mysqli_close($connection);
    ?>
</body>

</html>