<?php
session_start();
    include 'database/db.php';
    //Package Insert Query
    if(isset($_SESSION['tourist_id'])){
     $tourist_id = $_SESSION['tourist_id'];}
        if(isset($_POST['contact_us'])){
//            $agency_id          = $agency_id;
            $contact_us_username = htmlentities($_POST['contact_us_username']);
//            var_dump(htmlentities($_POST['contact_us_username']));
            $contact_us_email   = htmlentities($_POST['contact_us_email']);
            $contact_us_phone   = htmlentities($_POST['contact_us_phone']);
            $messages           = htmlentities($_POST['messages']);
            $date               = date("y.m.d");    
            

                $stmt = $pdo->prepare('INSERT INTO contact_us(contact_us_username, contact_us_email,contact_us_phone,messages ,date) VALUES(:contact_us_username, :contact_us_email,:contact_us_phone,:messages ,:date)');

                    $stmt->execute([':contact_us_username' => $contact_us_username,
                                    ':contact_us_email' => $contact_us_email,
                                    ':contact_us_phone' => $contact_us_phone,
                                    ':messages' => $messages,
                                    ':date' => date("y.m.d")]);
                $_SESSION['success'] = 'New Package Added';
                header('Location: contact.php');
                return;
//            }
        }
    
?>
<!--<html lang="en">-->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>contact with us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="resources/css/style.css"> -->
    <link rel="stylesheet" href="resources/css/style2.css">
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
            <li><a class="active-page" href="contact.php">contact Us</a></li>
             <li><a href="agencies.php">Agency</a></li>
            
          </ul>
    </nav>
    <section>
        <div class="container-contact">
            <div class="text-con">
                <h1>Contact Us</h1>
                <p>We ensure hundred percent customer's comfort & satisfiction.
                </p>
            </div>
            <div class="contact">
                <div class="con-full-left">
                    <div class="con-left">
                        <div class="s-top">
                            <i class="fas fa-share"></i>
                            <h3>Social Profiles</h3>
                            <span><i class="fab fa-facebook"></i></span>
                            <span> <i class="fab fa-twitter"></i></span>
                            <span> <i class="fab fa-whatsapp"></i></span>
                            <span><i class="fab fa-linkedin-in"></i></span>
                            <span> <i class="fab fa-instagram-square"></i></span>
                        </div>

                    </div>
                    <div class="con-bottom">
                        <div class="con-b-1">
                            <h4>Email Us</h4>
                            <p>motiur1933@cseku.ac.bd</p>
                        </div>

                        <div class="con-b-2">
                            <h4>24/7 support</h4>
                            <p>+8801714606738</p>
                        </div>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
                <div class="con-full-right">
<!--                    <form action="">-->
                        
                        <div class="group">
                            <input type="text" placeholder="Your name" id="" name="contact_us_username">
                            <input type="email" id="" placeholder="email" id="" name="contact_us_email">
                        </div>
                        <input type="number" placeholder="Mobile" id="" name="contact_us_phone">

                        <textarea cols="30" rows="10" input type="text" placeholder="message" id="" name="messages"></textarea>
                    
                    <button class="btn-c btn-send" style="padding-left: 5px;" input type="submit" value="contact_us" name="contact_us">send</button>
                        
                </div>
                    </form>
            </div>
        </div>
        
    </section>
</body>

