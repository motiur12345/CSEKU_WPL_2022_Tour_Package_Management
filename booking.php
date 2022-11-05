<?php
    session_start();
    include 'database/db.php';
     
    if($_SESSION['tourist_id']){
        $tourist_id = $_SESSION['tourist_id'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE tourist_id = :tourist_id ORDER BY package_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $bookings = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bookings[] = $row;
        }
    }
  
    if(isset($_GET['delete'])){
        $booking_id = $_GET['delete'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('DELETE FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $_SESSION['success'] = 'Successfully Deleted  Booking Info';
        header('Location: booking.php');
        return;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="resources/css/style2.css">
</head>
<body>
    
        <main>

    
    

<div class="customer-req">

    <?php
        

        if(empty($bookings)){
            echo '<h1 class="text-center pt-4">No Package Found</h1>';
        }else{
    ?>
<!--    <h2 class="c-r">Pending Approval</h2>-->
    <div class="package-cus">
        <table>
            <tr>
                <th>SL.</th>
                <th>Package Id</th>
                <th>Agency Id</th>
<!--                <th>Package name</th>-->
                <th>Name</th>
                <th>Email</th>
                <th>contact</th>
                <th>booking status</th>

                
                <th>Action</th>
<!--                <th colspan="2" >Action</th>-->
            </tr>
        
        <tbody>
            
        <?php
            $i = 1;
            foreach($bookings as $booking){

                    echo "<tr>";
                            
                        echo "<td>". $i++ ."</td>";
                        echo "<td>". $booking['package_id']  ."</td>";
                        echo "<td>". $booking['agency_id']  ."</td>";
                        echo $booking['tourist_firstname'] .' '. $booking['tourist_lastname'];
//                        echo "<td>". ucwords($package['location']) ."</td>";
//                        echo "<td>". ucwords($package['country']) ."</td>";
                        echo "<td>". $booking['tourist_email'] ."</td>";

                        echo "<td>". $booking['tourist_contact'] ."</td>";

                        echo "<td><a href='booking.php?delete=". $booking['booking_id'] ."' class='btn btn-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";

                    }
                    echo "</tr>";
            }
        ?>
        </tbody>
    </table>

    
</div>
            </div> 
    </main></body>
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


        /* table styling */
        table {
            border-collapse: collapse;
            width:800px;
            margin-top: 5px;
            color: white;
        }

        td,
        th {
            /* border: 1px solid gray; */
          
            padding:20px ;
            text-align: center;
            font-size: 18px;
          
          
        }
        tr:nth-child(even)  {
/* background: #1abc9c; */
background-color: #34495e;;

        }
        tr:nth-child(odd){
            /* background-color: #16a085; */
            background-color: rgba(0, 0, 0, 0.377);
        }

        .package-cus {
            width: 300px;
            height: 200px;

        }

        .package-cus img {
            width: 100%;
            height: 100%;

        }

        .customer-req {
            width: 300px;
            margin-left: 30px;
            margin-top: 50px;
        }

        .c-r {
            color: red;
        }
/*
        .con-b{
            padding:10px;
            background: #27ae60;
            outline: none;
            border:none;
            border-radius: 5px;
        }
*/
        /* table styling */
    </style>