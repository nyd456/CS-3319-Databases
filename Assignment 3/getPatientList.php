<!-- 
    Programmer Name: 06
   Patient list component used by multiply views
-->

<?php
    $query = "SELECT ohipnum, firstname, lastname FROM patient";
    $result = mysqli_query($connection,$query);
    if (!$result) 
    {
        die("databases query failed.");
    }
    echo "</br>";
    while ($row = mysqli_fetch_assoc($result)) 
    {
        if(isset($_POST['ohipnum']) && $_POST['ohipnum'] == $row["ohipnum"])
        {
            echo '<input type="radio" name="ohipnum" checked ="checked" value="';
        }
        else{
            echo '<input type="radio" name="ohipnum" value="';
        }
        
        echo $row["ohipnum"];
        echo '">' . $row["ohipnum"] . ' - '. $row["firstname"] . ' ' . $row["lastname"] . '<br><br>';
    }
     mysqli_free_result($result);
?>