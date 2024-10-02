<!-- 
    Programmer Name: 06
    7.	Allow the user to select a hospital and display deatils
    Database access component - get head doctor info and list all doctors that work at this hospital
    in the page
-->
<?php
if (isset($_POST["hoscode"])) 
{
    $hoscode = $_POST["hoscode"];
    $query = 'SELECT hosname, city, prov,numofbed, headdoc, firstname, lastname FROM hospital,doctor 
              WHERE hospital.headdoc = doctor.licensenum AND hoscode ="' . $hoscode . '"';

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("databases query failed.");
    }

    // List all the information about the doctors 
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="infolight">';
        echo 'Hospital Name:   ' . $row["hosname"];
        echo '</div>';
        echo '<div class="infolight">';
        echo 'City:            ' . $row["city"];
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Province:        ' . $row["prov"] . '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Number of beds:   ' . $row["numofbed"] . '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Head Doctor First Name:  ' . $row["firstname"] . '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Head Doctor Last Name:  ' . $row["lastname"] . '<br>';
        echo '</div>';
    }
    // List all the doctors that work at this hospital
    $query2 = 'SELECT doctor.licensenum, doctor.firstname, doctor.lastname FROM doctor, hospital
              WHERE doctor.hosworksat = hospital.hoscode AND hoscode ="' . $hoscode . '"';

    $result = mysqli_query($connection, $query2);
    if (!$result) {
        die("databases query failed.");
    }

    if (mysqli_num_rows($result) > 0) {

        echo '<br>';
        echo '<p class="info">Doctors that work at hospital <i>' . $hoscode . '</i>:</p>';
        // Table columns
        echo '<table id="patients">';
        echo '<tr>';
        echo '<th>License Number</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td> ' . $row["licensenum"] . '</td>';
            echo '<td> ' . $row["firstname"] . '</td>';
            echo '<td> ' . $row["lastname"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="warning"> No doctor found </p>';
    }
    mysqli_free_result($result);
}
?>