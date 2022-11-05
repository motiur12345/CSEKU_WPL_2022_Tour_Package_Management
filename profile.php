<?php 
session_start();


 ?>
<?php
    include 'database/db.php';
    include 'includes/functions.php';

    if(empty($_SESSION['tourist_login']) || $_SESSION['tourist_login'] == ''){
        header('Location: login2.php');
        return;
    }

    if(isset($_SESSION['tourist_id'])){
        $tourist_id = $_SESSION['tourist_id'];

        $tourist = readTourist($tourist_id);
    }
?>
<?php
    
    if(isset($_SESSION['tourist_id'])){
        $tourist_id = $_SESSION['tourist_id'];
        

        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resources/css/style2.css" />
    <title>Profile</title>
</head>


<body>
    

<nav>
        <ul>
            <li class="drop-menu">
                <a href="#">Menu</a>
                <ul class="drop">
<!--                    <li><a href="profile.html">Your profile</a></li>-->
                    
<!--                    <li><a href="tour-scheme.html">Tour Scheme</a></li>-->
                    <li><a href="transport-hotels.html">Hotels & Transportation</a></li>
<!--                    <li><a href="reserve-ticket.html">Ticket Availability</a></li>-->
                    <li><a href="logout.php">Logout</a></li>
                   
                </ul>
            </li>
            <li><a  href="home.html">Home</a></li>
            <li><a href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.html">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
 <div class="con-profile">
      <div class="card-d profile-1">
          <h2 class="mt">Tourist Profile</h2>
    <?php
        $profile_img = '';
        if(!empty($tourist['profile_image'])){
            $profile_img = $tourist['profile_image'];
        }else{
            $profile_img = 'bg-1.jpg';
        }
    ?>
     <img src="resources/images/<?php echo $profile_img; ?>" width="200" class="img-profile" alt="<?php echo $tourist['tourist_username']; ?>">     
    
<div class="mt" style="font-size: 20px">
<?php
        include 'includes/flash_msg.php';
    ?>
    <p><strong>Username:</strong><?php echo $tourist['tourist_username']; ?></p> 
    <p><strong>Name:</strong><?php echo $tourist['tourist_firstname'] .' '. $tourist['tourist_lastname']; ?></p> 
    <p><strong>Email:</strong><?php echo $tourist['tourist_email']; ?></p>       
    <p><strong>Contact:</strong><?php echo $tourist['tourist_contact']; ?></p>      
    <p><strong>Address:</strong><?php echo $tourist['tourist_address']; ?></p>
        
        </div>     
    <h4><a style="color: red;" href="edit-profile2.php" >Edit Profile</a></h4>
       
    </div>
</div>
    </body>
    
    
    <style>
        .table-1 {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        table {
            border-collapse: collapse;
            font-family: arial, sans-serif;
            background-color: rgba(41, 49, 42, 0.7);
        }
        
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            width: 250px;
            height: 20px;
            padding: 10px;
            color: white;
        }
        /* td,
        th {
           
        } */
        
        tr:nth-child(odd) {
            background-color: rgba(41, 49, 42, 0.7);
        }
        
        .profile-1 {
            background: rgba(41, 49, 42, 0.7);
            color: white;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px 15px;
        }
        
        .con-profile {
            background: url(resources/images/sajek-bg2.jpg) no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
            background-color: rgba(18, 17, 17, 0.623);
            width: 100%;
            height: 780px;
        }
        .img-profile {
    height: 100px;
    width: 100px;
    margin: auto;
    border-radius: 50%;
}
    </style>