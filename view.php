<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view</title>
    <link rel="stylesheet" href="style.css">
  
</head>
<body>
    <?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud";
    $name=$email=$contactNumber="";
    $message=$message1="";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $message="connection to database failed";
        die("Connection failed: " . $conn->connect_error);
        
      }
      else{
        
                  
$sql = "SELECT id, name, email,contact FROM userdetails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Update</th><th>Delete</th></tr>";
  // output data of each row
  $i=0;
  while($row = $result->fetch_assoc()) {
    $i++;
    echo "<tr>
    <td>".$i."</td>
    <td>".$row["name"]."</td>
    <td>".$row["email"]."</td>
    <td>".$row["contact"]."</td>"
    ?>

    <td><a  href="update.php?id=<?php echo urlencode(base64_encode($row['id']));?> " >update</a>
    <td><a  href="delete.php?id=<?php echo urlencode(base64_encode($row['id']));?> " onclick="return confirm('Do you want to delete this data? ');">delete</a>

    </tr>
 <?php }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();

    }
    ?>
    <a class='button' href='create.php' >create</a>
  
   
          
</body>
</html>