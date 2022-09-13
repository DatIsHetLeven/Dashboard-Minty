<?php  

$servername ="localhost";
$database ="mintymedia_dashboard";
$username ="minty_dash";
$password ="B3ea3k&91";


try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }


  $conn = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  
  echo "Connected successfully";
  
  mysqli_close($conn);








?>


<?php
    $drivers = PDO::getAvailableDrivers ();
    echo '<pre>' . print_r ($drivers, true) . '</pre>';
?>








  



        <!-- //     $sql = "SELECT * FROM 'user'";
        //     $stmt = $this->connect()->prepare($sql);
        //     $stmtp->execute();
        //     echo "testtt";

        //     $results = $stmt->fetchAll();
        //     return $results;



        // $results = $this->getAll();

        // echo $results[0];
        // print_r($results); -->





      ?>

