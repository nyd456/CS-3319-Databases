<!-- 
    Programmer Name: 06
   8.Allow the user to select a hospital and change (UPDATE) the number of beds at that hospital.
   Database access - Create a hospital form with retrived data from database
-->
<?php
if (isset($_POST["hoscode"])) {
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
        echo 'Province:        ' . $row["prov"]. '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Head Doctor First Name:  ' . $row["firstname"]. '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo 'Head Doctor Last Name:  ' . $row["lastname"]. '<br>';
        echo '</div>';
        echo '<div class="infolight">';
        echo '<label for="numofbed">Number of beds:</label>';
        echo '<input type="text" id="numofbed" name="numofbed" value="' . $row["numofbed"].  '"><br>';
        echo '</div>';
        echo ' <input class="btn" type="submit" name="update" value="update">';
    }
    mysqli_free_result($result);
}
?>


