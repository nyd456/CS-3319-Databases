<?php
    /* View doctor order by the Last Name OR by Birthdate  */
    if(isset($_POST["order"]) && isset($_POST["sort"]))
    {
        $order = $_POST["order"];
        $sort = $_POST["sort"];
        $query = 'SELECT * FROM doctor ORDER BY ' . $order . ' ' .  $sort;

    }else if(isset($_POST["order"]))
    {
        $order = $_POST["order"];
        $query = 'SELECT * FROM doctor ORDER BY ' . $order;
    }else
    {
        $query = 'SELECT * FROM doctor';
    }
 
    /* View doctor by speciality */
    if(isset($_POST["speciality"]))
    {
        $speciality = $_POST["speciality"];
        $query = 'SELECT * FROM doctor WHERE speciality ="' . $speciality . '"';
    }
    $result = mysqli_query($connection,$query);
    if (!$result) 
    {
        die("databases query failed.");
    }
    // Table columns
    echo '<tr>';
    echo '<th>License Number</th>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>License Date</th>';
    echo '<th>Birthdate</th>';
    echo '<th>Hospital Work At</th>';
    echo '<th>Speciality</th>';
    echo '</tr>';
    // List all the information about the doctors 
    while ($row = mysqli_fetch_assoc($result)) 
    {
        echo '<tr>';
        echo '<td> '. $row["licensenum"] . '</td>';
        echo '<td> '. $row["firstname"] . '</td>';
        echo '<td> '. $row["lastname"] . '</td>';
        echo '<td> '. $row["licensedate"] . '</td>';
        echo '<td> '. $row["birthdate"] . '</td>';
        echo '<td> '. $row["hosworksat"] . '</td>';
        echo '<td> '. $row["speciality"] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($result);
?>