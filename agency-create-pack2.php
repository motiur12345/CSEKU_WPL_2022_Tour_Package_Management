<?php
session_start();
    include 'database/db.php';
    //Package Insert Query
    if(isset($_SESSION['agency_id'])){
     $agency_id = $_SESSION['agency_id'];}
        if(isset($_POST['create_package'])){
            $agency_id          = $agency_id;
            $package_name       = htmlentities($_POST['package_name']);
            $location           = htmlentities($_POST['location']);
            $country            = htmlentities($_POST['country']);
            $package_details      = htmlentities($_POST['package_details']);
            $num_days           = htmlentities($_POST['num_days']);
            $num_nights         = htmlentities($_POST['num_nights']);
            $budget_price       = htmlentities($_POST['budget_price']);

        
          $package_images = $_FILES['package_images']['name'];
          $package_images_temp = $_FILES['package_images']['tmp_name'];
          move_uploaded_file($package_images_temp, "resources/images/$package_images");
            
            

            //Empty Field Validation
            if($package_name == '' || $location == '' || $country == '' || $budget_price == ''){
                $_SESSION['error'] = 'Please Fill the Form';
                header('Location: agency-create-pack2.php?page=create_package');
                return;
            }else{
                $stmt = $pdo->prepare('INSERT INTO packages(agency_id, package_name, location, country, package_details, package_images, num_days, num_nights, budget_price, package_status, package_date) VALUES(:agency_id, :package_name, :location, :country, :package_details, :package_images, :num_days, :num_nights,  :budget_price, :package_status, :package_date)');

                    $stmt->execute([':agency_id'            => $agency_id,
                                ':package_name'         => $package_name,
                                ':location'             => $location,
                                ':country'              => $country,
                                ':budget_price'         => $budget_price,
                                ':num_days'             => $num_days,
                                ':num_nights'           => $num_nights,
                                ':package_details'      => $package_details,
                                ':package_images'       => $package_images,
                                ':package_status'       => 'available',
                                ':package_date'         => date("y.m.d")]);
                $_SESSION['success'] = 'New Package Added';
                header('Location: package2.php');
                return;
            }
        }
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="resources/css/style2.css">
</head>

<body>
    <div class="dashboard">
  <div class="container-dash">
    <h2 class="heading">Dashboard</h2>
    <div class="ad-prof col">
        <img src="resources/images/motiur.jpg" alt="">
        <p>Agency</p>
    </div>
      <!--      here &nbsp;&nbsp is used to prevent automatic line break-->
      <div class="suggest-pack col active"><a href="agency-create-pack2.php" ><h4><i class="fas fa-box k"></i> &nbsp;&nbsp; Create package</h4></a></div>
      <div class="suggest-pack col "><a href="agency-package.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Packages</a></div>
    <div class="suggest-pack col "><a href="agency-payment.php" ><h4><i class="fas fa-box k"></i> &nbsp;&nbsp; Payments</h4></a></div>
       <div class="suggest-pack col"><a href="logout.php"><i class="fas fa-edit k"></i>  &nbsp;&nbsp;Log Out</a></div>
    
     </div>
</div>

    
<div class="box">
    <h1 style="text-align: center">Add Package</h1>
    <div class="f-group">



    <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
        <div class="f-group">
            <label for="package_name"><span class="f-size">Package Name</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter your package name..." id="" name="package_name">
        </div>
        <div class="f-group">
            <label for="location"><span class="f-size">Location</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter location..." id="" name="location">
        </div>
        <div class="f-group">
            <label for="country"><span class="f-size">Country</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter country name..." id="" name="country">
        </div>
       
        <div class="f-group">
            <label for="num_days"><span class="f-size">days</span></label>
            <input type="number" class="inp-w-h1" placeholder="Enter days..." id="" name="num_days">
        </div>
        <div class="f-group">
            <label for="num_nights"><span class="f-size">nights</span></label>
            <input type="number" class="inp-w-h1" placeholder="Enter nights..." id="" name="num_nights">
        </div>
<!--
        <div class="f-group">
            <label for="package_details"><span class="f-size">Details</span></label>
            <input type="text" class="inp-w-h1" placeholder="Enter package type..." id="" name="package_details" >
        </div>
-->
        <div class="f-group">
            <label for="budget_price"><span class="f-size">Price</span></label>
            <input type="number" class="inp-w-h1" placeholder="Enter package price..." id="" name="budget_price" placeholder="Budget">
        </div>
         <div class="f-group">
            <label for="package_details"><span class="f-size">Place Details</span></label>
            <textarea name="package_details" class="inp-w-h1" placeholder="Enter place details..." id="body" cols="30" rows="5"></textarea>
        </div>
         <div class="f-group">
             <label for="package_images"><span class="f-size">Image</span></label>
            <input type="file" name="package_images">
        </div>
        <div class="f-group">
            <button style="margin: 10px;" input type="submit" value="create_package" name="create_package" class="btn">Submit</button>
        </div>
    </form>
</div>
    </div>
   
</body>

 <style>
        .suggest-pack{
            background: rgba(0, 0, 0, 0.212);
            height: 60px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;

        }
       .active, .suggest-pack:hover{
            background: rgb(24, 21, 21);
        }
        main{
            min-height: 100vh;
            min-width: 100vh;
            background:#2c3e50;
            display: flex;
            
         /* justify-content: center; */

        }
        .dashboard{
            width: 20%;
            min-height: 90vh;
            background:#34495e;
            /* border-radius: 2rem; */
            padding-top: 20px;


        }
        .col{
            margin: 20px 0;
            width: 200px;
         
        }
        .container-dash{
            display: flex;
            flex-direction: column;
           align-items: center;
           text-align: left;
           color:white;
          
            
        }
        .dashboard .heading{
            color: white;
            margin: 30px;

        }
        .ad-prof{
           
           text-align: center;
        }
        .ad-prof img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid rgb(248, 244, 244);
        }
        .k{
            color: #0962bb;
            font-size: 20px;
        }
        a{
            color: white;
            text-decoration: none;
        }
        a:hover{
            color: red;
        }
.box{
    color:black;
}

       
    </style>