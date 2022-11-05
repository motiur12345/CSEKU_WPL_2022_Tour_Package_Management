<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="resources/css/style2.css" />
    <title>Packages</title>
</head>
    
<body>
    <nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">
                    <li><a href="profile.php">Your profile</a></li>
                    
<!--                    <li><a href="tour-scheme.html">Tour Scheme</a></li>-->
                    <li><a href="transport-hotels.html">Hotels & Transportation</a></li>
<!--                    <li><a href="reserve-ticket.html">Ticket Availability</a></li>-->
                    <li><a href="logout.php">Logout</a></li>
                   
                </ul>
            </li>
            <li><a  href="home.html">Home</a></li>
            <li><a class="active-page" href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.php">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
        
<?php
  session_start();
    error_reporting(0);
  //Agency Read Query ... approved agency
 include 'database/db.php';
    //Tourist Read Query
    if(isset($_GET['agency_id'])){
    $agency_id=$_GET['agency_id'];
    $sql = "SELECT * FROM agencies  where agencies.agency_id= ?";
 $bind=array( $agency_id);
        $stmt = $pdo->prepare($sql);
$stmt->execute($bind);
    
    $pack = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pack[] = $row;
    }
        
        $sql = "SELECT * FROM packages  where packages.agency_id= ?";
        
         $bind=array( $agency_id);
        $stmt = $pdo->prepare($sql);
$stmt->execute($bind);
    }
    else{ 
        $stmt = $pdo->query('SELECT * FROM packages ORDER BY package_name');
         $stmt->execute();
    
    }
        
   
    $packages = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $packages[] = $row;
    }

  if(empty($packages)){
    echo '<h1 class="text-center pt-4">No packages Found</h1>';
  }else{
?>

 <div class="package-con12">
    
    <?php  foreach($pack as $p){  echo '<h1 style="
          margin-left: 200px;
          border-left: 7px solid red;
          padding-left: 10px;
          color: white;
        ">'
            ."Agency Name:" . $p['agency_name'].'</h1>';
         }
    ?>
    
<?php
     echo '<div class="package-con">'; 
      
  foreach($packages as $package){
      
     // echo '<div class="package-con">';
       echo '<div class="package" style="padding: 0; margin: 0;">';
      echo '<a href="order1.php">';
      echo '<div class="img-medium a">';
      echo '<h1 class="h1-text"> Book now '.'</h1>';
      //echo '<h4>Rate us:'.'</h4>';
      echo '<a href="order1.php?package_id='. $package['package_id'] .'"> <img src="resources/images/'. $package['package_images'] .'"  width="370px" height= "250px" alt="'. $package['package_name'] .'"></a>';
      echo '</div>';
          echo '<div class="package-review">';
            echo '<div style="text-align: center; margin-bottom: 10px">';
              echo '<div>';
                echo '<h1>'. $package['package_name'] .'</h1>';
                echo '<h2>'. "BDT: ". $package['budget_price'] .'</h2>';
                echo '<h3>'. "Days: ". $package['num_days'] .";Nights: ". $package['num_nights'] .'</h3>';
                echo '</div>';
                echo '<label for="input">';
                echo '<h4>Rate us:'.'</h4>';
                echo '</label>';
 

              echo '<input type="number" id="rating-place" placeholder="Rating" step="0.1" min="0" max="5" class="form-control" style="padding: 5px 10px; border-radius: 2px" />';
              echo '<div style="display: flex; justify-content: center">';
              echo ' <div style="display: none;" class="rating-inner">';
              echo '</div>';
              echo '</div>';
              echo '<textarea cols="30" rows="2" placeholder="comment"></textarea>';
              echo '</br>';
              echo '<button class="btn-g" style="margin-bottom: 10px">
              <h4>Send</h4>'.'</button>';

      echo '</div>';
    echo '</div>';
            echo '</div>';
    
  }
  }
?>
    </div>

    
    
</body>

    <style>
        .package-con {
            display: inline-block;
            width: 1270px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
        }
        
        .package {
            
            display: inline-block;
            width: 370px;
            background: #e2e4e3;
            margin: 10px !important;
            padding: 10px;
            overflow: hidden;
        }
        
        .package-review {
            text-align: center;
        }
        
        .package-con12 {
            
            padding-top: 80px;
            background: url(resources/images/sign-in2.jpg) no-repeat;
            background-size: cover;
            position: relative;
            background-blend-mode: multiply;
            background-color: rgba(18, 17, 17, 0.623);
            width: 100%;
            height: 1600px;
        }
        
        .img-medium {
            position: relative;
            background-repeat: no-repeat;
            background-blend-mode: multiply;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.623);
            width: 100%;
            height: 270px;
            transition: 0.5s ease-in-out;
            margin-bottom: 10px;
        }
        
        .a {
            background-image: url(resources/images/sajek.jpg);
        }
        
        .b {
            background-image: url(resources/images/saintmartin.jpg);
        }
        
        .c {
            background-image: url(resources/images/coxbazzer.jpg);
        }
        
        .img-medium:hover {
            transform: scale(1.1);
            background-color: rgba(0, 0, 0, 0.76);
        }
        
        .h1-text {
            color: #7f8fa6;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        /* .img-medium img:hover {
            opacity: 0.5;
        } */
    </style>