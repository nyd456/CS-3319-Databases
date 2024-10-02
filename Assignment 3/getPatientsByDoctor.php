<!-- 
    Programmer Name: 06
   6.	Allow the user to select a doctor and see the first and 
   last name and ohip number of any patient treated by that doctor. 
   Database access component - get data from db and displaying patient 
   info in a table
-->
<?php
session_start();
if (isset($_POST["licensenum"])) {
    $licenseNum = $_POST["licensenum"];
   
    $query = 'SELECT patient.ohipnum, patient.firstname, patient.lastname FROM looksafter, patient 
                WHERE looksafter.licensenum ="' . $licenseNum . '" and patient. ohipnum = looksafter.ohipnum';
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("databases query failed.");
    }
    if (mysqli_num_rows($result) > 0) {
   echo  '<p class="info">Patient(s) Teated by the Doctor</p>';
     // Table columns
     echo '<tr>';
     echo '<th>OHIP Number</th>';
     echo '<th>First Name</th>';
     echo '<th>Last Name</th>';
     echo '</tr>';
     // List all the information about the doctors 
     while ($row = mysqli_fetch_assoc($result)) 
     {
         echo '<tr>';
         echo '<td> '. $row["ohipnum"] . '</td>';
         echo '<td> '. $row["firstname"] . '</td>';
         echo '<td> '. $row["lastname"] . '</td>';
         echo '</tr>';
     }
    }else{
        echo '<p class=warning> No patient found </p>';
    }
}
mysqli_free_result($result);
?>