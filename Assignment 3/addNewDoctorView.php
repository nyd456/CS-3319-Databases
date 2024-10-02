<!-- 
    Programmer Name: 06
    #3.	Insert a new doctor - View - provid UI for user input, 
    do input UI validation and displaying data and messages 
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Add Doctor</title>
</head>

<body>
    <?php
    include 'connectdb.php';
    if (isset($_POST['add'])) {
        /* get data from form submission */
        $licenseNum = $_POST["licenseNum"];
        $fName = $_POST["fName"];
        $lName = $_POST["lName"];
        $birthday = $_POST["birthday"];
        $licenseDate = $_POST["licenseDate"];

        /* mandatory field validation */
        if (
            strlen(trim($licenseNum)) === 0 || strlen(trim($fName)) === 0 || strlen(trim($lName)) === 0 ||
            strlen(trim($licenseDate)) === 0 || strlen(trim($birthday)) === 0 || !isset($_POST['hoscode']) ||
            strlen(trim($licenseNum)) > 4
        ) {
            if (strlen(trim($licenseNum)) === 0) {
                $errors['licenseNum'] = "License Number field is required.<br/>";
            }
            if (strlen($licenseNum) > 4) {
                $errors['licenseNum'] = "Maximum length of License Number is 4.<br/>";
            }
            if (strlen(trim($fName)) === 0) {
                $errors['fName'] = "First Name field is required<br/>";
            }
            if (strlen(trim($lName)) === 0) {
                $errors['lName'] = "Last Name field is required<br/>";
            }
            if (strlen(trim($licenseDate)) === 0) {
                $errors['licenseDate'] = "License Date field is required<br/>";
            }
            if (strlen(trim($birthday)) === 0) {
                $errors['birthday'] = "Birthday field is required<br/>";
            }
            if (!isset($_POST['hoscode'])) {
                $errors['hoscode'] = "Please select a hospital code<br/>";
            }
        } else {
            include 'addNewDoctor.php';
        }
    }
    ?>
    <!--  Add a new doctor Form -->
    <div class="divForm">
        <a href="index.php">Back to Home</a>
        <h2 class="center"> Add a new doctor</h2>
        <?php
        if (isset($errors['duplicatedID'])) {
            echo '<p class="error">' . $errors["duplicatedID"] . '</p>';
        }
        ?>
        <form action="" method="post" id="addDoctForm" enctype="multipart/form-data">
            <label for="licenseNum">*License Number:</label>
            <?php
            if (isset($_POST["licenseNum"])) {
                echo '<input class="textbox"  type="text" id="licenseNum" name="licenseNum" value="' . $_POST["licenseNum"] . '"/>';
            } else {
                echo '<input class="textbox"  type="text" id="licenseNum" name="licenseNum"/>';
            }
            if (isset($errors['licenseNum'])) {
                echo '<p class="validation">' . $errors["licenseNum"] . '</p>';
            }
            ?>
            <label for="fName">*First Name:</label>
            <?php
            if (isset($_POST["fName"])) {
                echo '<input class="textbox"  type="text" id="fName" name="fName" value="' . $_POST["fName"] . '"/>';
            } else {
                echo '<input class="textbox"  type="text" id="fName" name="fName"/>';
            }
            if (isset($errors['fName'])) {
                echo '<p class="validation">' . $errors["fName"] . '</p>';
            }
            ?>
            <label for="lName">*Last Name:</label>
            <?php
            if (isset($_POST["lName"])) {
                echo '<input class="textbox"  type="text" id="lName" name="lName" value="' . $_POST["lName"] . '"/>';
            } else {
                echo '<input class="textbox"  type="text" id="lName" name="lName"/>';
            }
            if (isset($errors['lName'])) {
                echo '<p class="validation">' . $errors["lName"] . '</p>';
            }
            ?>
            <label for="licenseDate">*License Date:</label>
            <?php
            if (isset($_POST["licenseDate"])) {
                echo '<input class="textbox"  type="date" id="licenseDate" name="licenseDate" value="' . $_POST["licenseDate"] . '"/>';
            } else {
                echo '<input class="textbox"  type="date" id="licenseDate" name="licenseDate"/>';
            }
            if (isset($errors['licenseDate'])) {
                echo '<p class="validation">' . $errors["licenseDate"] . '</p>';
            }
            ?>
            <label for="birthday">*Birthday:</label>
            <?php
            if (isset($_POST["birthday"])) {
                echo '<input class="textbox"  type="date" id="birthday" name="birthday" value="' . $_POST["birthday"] . '"/>';
            } else {
                echo '<input class="textbox"  type="date" id="birthday" name="birthday"/>';
            }
            if (isset($errors['birthday'])) {
                echo '<p class="validation">' . $errors["birthday"] . '</p>';
            }
            ?>
            <label for="speciality">Speciality:</label>
            <?php
            if (isset($_POST["speciality"])) {
                echo '<input class="textbox"  type="text" id="speciality" name="speciality" value="' . $_POST["speciality"] . '"/>';
            } else {
                echo '<input class="textbox"  type="text" id="speciality" name="speciality"/>';
            }
            ?>
            <p>Please select hospital work at:</p>
            <?php
            if (isset($errors['hoscode'])) {
                echo '<p class="validation">' . $errors["hoscode"] . '</p>';
            }
            include 'getHospitals.php';
            ?>
            <br>
            <input class="btn" type="button" onclick="resetFormData()" value="Reset Form">
            <input class="btn" type="submit" name="add" value="Add New Doctor">
        </form>
    </div>
    <script>
        function resetFormData() {
            document.getElementById("addDoctForm").reset();
        }
    </script>
    <?php
    mysqli_close($connection);
    ?>
</body>
</html>