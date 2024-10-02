<!-- 
    Programmer Name: 06
   2.Allow the user to select one of the specialties and then list 
   all the doctor information about just doctors with this specialty. 
   Database access component - create a list of specialities in radio button
   type to allow user selection
-->
<?php
    $query = "SELECT DISTINCT speciality FROM doctor WHERE speciality <> ''";
    $result = mysqli_query($connection,$query);
    if (!$result) 
    {
        die("databases query failed.");
    }
    echo "</br>";
    echo ' <p class="info">All Specialties </p>';
    while ($row = mysqli_fetch_assoc($result)) 
    {
        if(isset($_POST['speciality']) && $_POST['speciality'] == $row["speciality"])
        {
            echo '<input type="radio" name="speciality" checked ="checked" value="';
        }
        else{
            echo '<input type="radio" name="speciality" value="';
        }
        
        echo $row["speciality"];
        echo '">' . $row["speciality"] . "<br><br>";
    }
     mysqli_free_result($result);
?>