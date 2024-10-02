<!-- 
    Programmer Name: 06
   1.	List all the information about the doctors. 
   Home page with a table of doctor info, user can sort the table by 
   radio button selection
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Hospital Database Management System</title>
</head>

<body>
    <?php
    session_start();
    include 'connectdb.php';
    ?>
    <p class="title">Welcome to the Hospital Database Management System</p>
    <!--  List all the information about the doctors. 
    Allow the user to order the data by Last Name OR by Birthdate in ascending or descending  -->
    <p class="subTitle">Our Doctors</p>
    <?php
    if (isset($_SESSION['success'])) {
        echo '<p class="success">' . $_SESSION['success'] . '</p>';
        $_SESSION['success'] = "";
    }
    ?>
    <table id="doctors">
        <?php
        include 'getDoctors.php';
        ?>
    </table>
    <form action="" method="post" class="">
        <!-- keep the radio button check status -->
        <table class="tblNoBorder">
            <tr>
                <td>
                    <?php
                    if (isset($_POST['order']) && $_POST['order'] == "lastname") {
                        echo '<input type="radio" name="order" value="lastname" checked="checked">' . ' Order by last name';
                    } else {
                        echo '<input type="radio" name="order" value="lastname"">' . ' Order by last name';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (isset($_POST['order']) && $_POST['order'] == "birthdate") {
                        echo '<input type="radio" name="order" value="birthdate" checked ="checked">' . ' Order by birthdate ';
                    } else {
                        echo '<input type="radio" name="order" value="birthdate">' . ' Order by birthdate ';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    if (isset($_POST['sort']) && $_POST['sort'] == "ASC") {
                        echo '<input type="radio" name="sort" value="ASC" checked="checked">' . ' Ascending';
                    } else {
                        echo '<input type="radio" name="sort" value="ASC">' . ' Ascending';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (isset($_POST['sort']) && $_POST['sort'] == "DESC") {
                        echo '<input type="radio" name="sort" value="DESC"  checked="checked">' . ' Descending';
                    } else {
                        echo '<input type="radio" name="sort" value="DESC" >' . ' Descending';
                    }
                    ?>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <!-- 1.	List all the information about the doctors -->
                    <input class="btn" type="submit" value="View Doctor Info">
                    <!--  2.	Allow the user to select one of the specialties and then list all the doctor information about just doctors with this specialty.  -->
                    <input class="btn" type="submit" formaction="doctorSpecialtyView.php" value="View Doctor By Specialty">
                    <!-- 3.	Insert a new doctor. -->
                    <input class="btn" type="submit" formaction="addNewDoctorView.php" value="Add Doctor">
                    <!-- 4.	Delete an existing doctor.  -->
                    <input class="btn" type="submit" formaction="deleteDoctorView.php" value="Delete Doctor">
                    <!-- 5.	Assign a doctor to a patient. -->
                    <input class="btn" type="submit" formaction="assignDoctorView.php" value="Assign Doctor">
                    <!-- 6.	Allow the user to select a doctor and see the first and last name and ohip number of any patient treated by that doctor.  -->
                    <input class="btn" type="submit" formaction="doctorPatientView.php" value="View Doctor Patient Info">
                    <!-- 7.	Allow the user to select a hospital and display hospital deatils -->
                    <input class="btn" type="submit" formaction="hospitalView.php" value="View Hospital Details">
                    <!-- 8.	Allow the user to select a hospital and change (UPDATE) the number of beds at that hospital. -->
                    <input class="btn" type="submit" formaction="updateHospitalView.php" value="Update Hospital Info">
                </td>
            </tr>
        </table>
        <br />
        <!--  <table border="1" class="">
            <?php
            include 'getdoctors.php';
            ?>
        </table> -->
    </form>
    <!-- close database connection -->
    <?php
    unset($_SESSION["success"]);
    mysqli_close($connection);
    ?>
</body>

</html>