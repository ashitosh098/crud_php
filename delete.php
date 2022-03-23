<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud";
    $userId="";
    $message=$message1="";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $message="connection to database failed";
        die("Connection failed: " . $conn->connect_error);
        
      }
    
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
           $userId = base64_decode(urldecode($_GET['id']));
          
            $sql = "DELETE FROM userdetails WHERE id='$userId'";

            if ($conn->query($sql) === TRUE) {
              $message1= "Record deleted successfully";
            } else {
              $message1= "Error deleting record: " . $conn->error;
            }
                    }
               
                
         header('location:view.php') ; 
         
    ?>





   <?php
    if($message!="")
    {
        echo "</br>".$message;
    }
    else{
        if($message1!="")
        {
            echo '<script type="text/javascript">alert("'.$message1.'");</script>';
        }
    }
    $conn->close();
    
    ?>
</body>
</html>