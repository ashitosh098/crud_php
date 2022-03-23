<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    
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
    $userId="";
    $id="";
    $userId1="";
    $data=[];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $message="connection to database failed";
        die("Connection failed: " . $conn->connect_error);
        
      }
      if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $userId = $_GET['id'];
        $userId1 = base64_decode(urldecode($_GET['id']));
        $getUserQuery = "SELECT * FROM userdetails WHERE id='$userId1'";

        $output = $conn->query($getUserQuery);

        if ($output->num_rows > 0) {

            $data = $output->fetch_assoc();

            $name = $data['name'];
            $email = $data['email'];
            $contactNumber= $data['contact'];
          

        }

    }
        if($_SERVER["REQUEST_METHOD"] == "POST")

        {
            $name=$_POST['name'];
           $email=$_POST['mail'];
           $contactNumber=$_POST['contact'];
           $id=base64_decode(urldecode($_POST['address']));

           $sql = "UPDATE userdetails SET name='$name' , contact='$contactNumber',email='$email' WHERE id='$id'";

           if ($conn->query($sql) === TRUE) {
             $message1= "Record updated successfully";
           } else {
             $message1= "Error while updating record: " . $conn->error;
           }
             
           }
           
    ?>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <h1>Update</h1>
      <div class="formcontainer">
      <div class="container">
      <input type="hidden"  name="address" value = <?php echo $userId?>>
      <label for="name"><strong>Name</strong></label>
        <input type="text"  name="name" required value = <?php echo $name?>>
        <label for="mail"><strong>E-mail</strong></label>
        <input type="email" name="mail" value = <?php echo $email ?>>
        <label for="contact"><strong>Contact Number</strong></label>
        <input type="text"  name="contact" value = <?php echo $contactNumber?> required >
      </div>
      <button type="submit"><strong>Update</strong></button>
      
    </form>
    <a class="button" href="./view.php">view
   </a>
    <?php
    if($message!="")
    {
        echo "</br>".$message;
    }
    else{
        if($message1!="")
        {
            echo '<script type="text/javascript">alert("'.$message1.'");</script>';
            $conn->close();
          
        } 
    }
    ?>
</body>
</html>