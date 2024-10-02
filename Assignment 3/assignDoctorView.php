<!-- 
    Programmer Name: 06
    5.	Assign a doctor to a patient - View - 
    input UI validation and handled data and message displaying
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Assign Doctor</title>
</head>

<body>
    <?php
    include 'connectdb.php';
    if (isset($_POST['assign'])) {
        /*  validation - doctor is selected */
        if (!isset($_POST['licensenum'])) {
            $errors['licensenum'] = "Please select a doctor to assign<br/>";
        }
        if (!isset($_POST['ohipnum'])) {
            $errors['ohipnum'] = "Please select a patient to be assigned<br/>";
        }

        if (isset($_POST['licensenum']) && isset($_POST['ohipnum'])) {
            include 'assignDoctor.php';
        }
    }
    ?>
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center">Assign a doctor to a patient</h2>
        <?php
        if (isset($errors['licensenum'])) {
            echo '<p class="error">' . $errors["licensenum"] . '</p>';
        }

        if (isset($errors['ohipnum'])) {
            echo '<p class="error">' . $errors["ohipnum"] . '</p>';
        }

        if (isset($errors['aleadyAssigned'])) {
            echo '<p class="error">' . $errors["aleadyAssigned"] . '</p>';
        }
        ?>
        <form action="" method="post" id="dpForm">
            <table class="tblNoBorder">
                <tbody>
                    <tr>
                        <?php
                        echo ' <td> <p class="info">All Doctors</p>';
                        include 'getDoctorList.php';
                        echo '</td>';
                        echo ' <td> <p class="info">All Patients</p>';
                        include 'getPatientList.php';
                        echo '</td>';
                        ?>
                    </tr>
                </tbody>
            </table>

            <input class="btn" type="submit" name="assign" value="Assign a doctor to a patient">
        </form>
    </div>
    <?php
    mysqli_close($connection);
    ?>
</body>

</html>