<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
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
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
           $name=$_POST['name'];
           $email=$_POST['mail'];
           $contactNumber=$_POST['contact'];

           $sql = "SELECT email FROM userdetails WHERE email='$email'";
           $result = $conn->query($sql);

           if($result->num_rows > 0)
           {
             $message1="Customer with this email already exsist ! Try resgistering with different email";
           }
           else
           {

           $sql = "INSERT INTO userdetails (name,email,contact)
           VALUES ('$name', '$email', '$contactNumber')";

if ($conn->query($sql) === TRUE) {
 $message1="New record created successfully";
} else {
  $message1=$conn->error;
}
    }     
      }
    } 
?>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <h1>Register</h1>
      <div class="formcontainer">
      <div class="container">
        <label for="name"><strong>Name</strong></label>
        <input type="text" placeholder="Enter Username" name="name" required >
        <label for="mail"><strong>E-mail</strong></label>
        <input type="email" placeholder="Enter E-mail" name="mail" requird>
        <label for="contact"><strong>Contact Number</strong></label>
        <input type="text" placeholder="Enter ContactNumber" name="contact" required >
      </div>
      <button type="submit"><strong>Register</strong></button>
      
    </form>
    </br>
    <a class="button" href="view.php">View</a>
    </br>
    
    
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