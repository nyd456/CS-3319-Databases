<!-- 
    Programmer Name: 06
    7.	Allow the user to select a hospital and display deatils
    Database access component - get hospital data from db and generate view displayed 
    in the page
-->
<?php
$query = "SELECT DISTINCT hoscode, hosname, city FROM hospital";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("databases query failed.");
}
while ($row = mysqli_fetch_assoc($result)) {
    if (isset($_POST['hoscode']) && $_POST['hoscode'] == $row["hoscode"]) {
        echo '<input type="radio" name="hoscode" checked ="checked" value="';
    } else 
    {
        echo '<input type="radio" name="hoscode" value="';
    }
    echo $row["hoscode"];
    echo '">     ' . $row["hoscode"] . '     (' . $row["hosname"] . ',   ' .  $row["city"] . ")<br>";
}
mysqli_free_result($result);
?>