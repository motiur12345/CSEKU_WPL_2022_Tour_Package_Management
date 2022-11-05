<?php
session_start();
    include 'database/db.php';
//    //Package Insert Query
  if(empty($_SESSION['tourist_id']) || $_SESSION['tourist_id'] == ''){
        header('Location: login2.php');
        return;
    }
    if(isset($_SESSION['tourist_id'])){
     $tourist_id = $_SESSION['tourist_id'];} 

        if(isset($_GET['package_id'])){
             
//            if(isset($_GET['agency_id'])){
//                $agency_id=$_GET['agency_id'];}
            
        if(isset($_POST['order1'])){
            
            $tourist_id          = $tourist_id;
            
//            $tourist_id     = $_SESSION['tourist_id'];
            
            $package_id     = $_GET['package_id'];

            
//            $agncy_id   = $_GET['agency_id'];
             
            $tourist_firstname = htmlentities($_POST['tourist_firstname']);
            $tourist_lastname = htmlentities($_POST['tourist_lastname']);
            
            $tourist_email   = htmlentities($_POST['tourist_email']);
            $tourist_contact   = htmlentities($_POST['tourist_contact']);
//            $messages           = htmlentities($_POST['messages']);
            $date               = date("y.m.d");    
            

   
                $stmt = $pdo->prepare('INSERT INTO bookings(package_id, tourist_id, agency_id, tourist_firstname, tourist_lastname, tourist_email,tourist_contact,booking_status,date)VALUES(:package_id,:tourist_id,:agency_id,:tourist_firstname,:tourist_lastname,:tourist_email ,:tourist_contact ,:booking_status,:date)'); 

                    $stmt->execute([':package_id' => $package_id,
                                    ':tourist_id' => $tourist_id,
//                                    ':agency_id' => $agency_id,
                                    ':agency_id' => '14',
                                    ':tourist_firstname' => $tourist_firstname,
                                    ':tourist_lastname' => $tourist_lastname,
                                    ':tourist_email' => $tourist_email,
                                    ':tourist_contact' => $tourist_contact,
                                    ':booking_status'       => 'pending',
                                    ':date' => date("y.m.d")]);
                $_SESSION['success'] = 'New booking Added';
                header('Location: order1.php');
                return;
//            }
        }
        }
     
 
?>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resources/css/style2.css" />

    <title>order</title>
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
            <li><a href="package2.php">tour package</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="hotels-quality.html">Services</a></li>
            <li><a href="contact.php">contact Us</a></li>
            <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
    <div class="con-order">
        <div class="container order-1">
            <div class="order">
                <h2>Order summary</h2>
                <hr />
                <table style="width: 100%">
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>
                            saint martin <br /> 5 days
                        </td>
                        <td>5000k</td>
                    </tr>
                    <tr>
                        <td class="l">Quantity</td>
                        <td class="l">1</td>
                    </tr>
                    <tr>
                        <td>total</td>
                        <td>5000/=</td>
                    </tr>
                </table>
            </div>
             <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
            <div class="payment-method">
                <h3>Enter your personal info for booking</h3>
                <label for="tourist_firstname"> Firstname:</label> <br />
                <input type="text"  placeholder="firstname" id="" name="tourist_firstname" /> <br />
                <label for="tourist_lastname"> Phone:</label> <br />
                <input type="text"  placeholder="lastname" id="" name="tourist_lastname" /> <br />
                <label for="tourist_email"> Email:</label> <br />
                <input type="email"  placeholder="email" id="" name="tourist_email" /> <br />
                <label for="tourist_contact"> Phone:</label> <br />
                <input type="number"  placeholder="phone" id="" name="tourist_contact" /> <br />

                <br />
                <button class="log" input type="submit" value="order1" name="order1">Order</button>
            </div>
            </form>
        </div>
    </div>
</body>
    <style>
        .log {
            padding: 10px 30px;
            background: rgb(9, 170, 71);
            border: none;
            border-radius: 3px;
        }
        
        .payment-method {
            width: 500px;
            line-height: 1.7;
        }
        
        .payment-method input[type="email"],
        input[type="password"] {
            width: 300px;
            padding: 7px;
            border: 1px solid red;
            border-radius: 4px;
        }
        
        .order-1 {
            background: rgba(35, 52, 63, 0.63);
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px 15px;
        }
        
        .con-order {
            background: url(resources/images/sajek-bg2.jpg) no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
            background-color: rgba(18, 17, 17, 0.623);
            width: 100%;
            height: 780px;
        }
        
        th,
        .l {
            /* border: 1px solid red; */
            /* border-collapse: collapse;
        margin: 0; */
            border-bottom: 2px solid black;
        }
        
        th,
        td {
            padding: 8px;
        }
        
        .order {
            width: 250px;
            margin-right: 50px;
            border: 2px solid rgb(32, 30, 30);
            border-radius: 5px;
            /* padding: 10px; */
            text-align: center;
            background: rgba(63, 61, 61, 0.699);
        }
        
        .container {
            display: flex;
            margin: auto;
            justify-content: center;
            margin-top: 50px;
        }
        
        body {
            font-size: 20px;
        }
    </style>


