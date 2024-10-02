<!-- 
    Programmer Name: 06
    Doctor list with license number, first name and last name
    - database access - component used by multiply views
-->
<?php
    $query = "SELECT licensenum, firstname, lastname FROM doctor";
    $result = mysqli_query($connection,$query);
    if (!$result) 
    {
        die("databases query failed.");
    }
    echo "</br>";
    while ($row = mysqli_fetch_assoc($result)) 
    {
        if(isset($_POST['licensenum']) && $_POST['licensenum'] == $row["licensenum"])
        {
            echo '<input type="radio" name="licensenum" checked ="checked" value="';
        }
        else{
            echo '<input type="radio" name="licensenum" value="';
        }
        
        echo $row["licensenum"];
        echo '">' . $row["licensenum"] . ' - '. $row["firstname"] . ' ' . $row["lastname"] . '<br><br>';
    }
     mysqli_free_result($result);
?>