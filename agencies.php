<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resources/css/style2.css" />
    <title>Agencies</title>
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
            <li><a href="home.html">Home</a></li>
            <li><a href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.php">contact Us</a></li>
            <li><a class="active-page" href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
    
    
<?php
  
  //Agency Read Query ... approved agency
 include 'database/db.php';
    //Tourist Read Query
    $stmt = $pdo->query('SELECT * FROM agencies ORDER BY agency_name');
    $stmt->execute();
    $agencies = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $agencies[] = $row;
    }

  if(empty($agencies)){
    echo '<h1 class="text-center pt-4">No Agency Found</h1>';
  }else{
?>

<div class="package-con12">
    <div class="main">

<?php
  foreach($agencies as $agency){
    echo '<div class="card">';
      echo '<div class="image" >';
//        echo '<div class="row no-gutters">';
//          echo '<div class="col-md-4">';
            echo '<a href="package2.php?agency_id='. $agency['agency_id'] .'"><img src="resources/images/'. $agency['agency_profile_image'] .'" class="card-img" height="180" alt="'. $agency['agency_name'] .'"></a>';
          echo '</div>';
          echo '<div class="title">';
//            echo '<div class="card-body">';
//              echo '<div>';
                echo '<h1 class="card-title">'. $agency['agency_name'] .'</h1>';
                echo '</div>';
              echo '<div class="des">';
              echo '<p>We have multuple packages of good quality...'.'</p>';
              echo '<p>Total Packages:3'.'</p>';
              echo '<button>View Packages'.'</button>';

      echo '</div>';
    echo '</div>';
  }
?>
    </div>
</div>

<?php
  }
?>

    
    
</body>
    <style type="text/css">


*{
 margin: 0px;
 padding: 0px;
}
body{
 font-family: arial;
}
.main{

 margin: 2%;
}

.card{
     width: 20%;
     display: inline-block;
     box-shadow: 2px 2px 20px black;
     border-radius: 5px; 
     margin: 2%;
    }

.image img{
  width: 100%;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  

 
 }

.title{
  background-color: greenyellow;
  text-align: center;
  padding: 10px;
  
 }

h1{
  font-size: 20px;
 }

.des{
  padding: 3px;
  text-align: center;
   background-color: green;
  padding-top: 10px;
        border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}
button{
  margin-top: 40px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
  padding:10px;
}
button:hover{
  background-color: black;
  color: white;
  transition: .5s;
  cursor: pointer;
}
    .package-con12 {
            padding-top: 80px;
            background: url(resources/images/sign-in2.jpg) no-repeat;
            background-size: cover;
            position: relative;
            background-blend-mode: multiply;
            background-color: rgba(18, 17, 17, 0.623);
            width: 100%;
            height: 780px;
        }

</style>    
    



