<?php
    include 'database/db.php';
    //Tourist Read Query
    $stmt = $pdo->query('SELECT * FROM tourists ORDER BY tourist_username');
    $stmt->execute();
    $tourists = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tourists[] = $row;
    }

   
    if(isset($_GET['delete'])){
        $tourist_id = $_GET['delete'];

        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('DELETE FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $_SESSION['success'] = 'Successfully Deleted  Tourist Info';
        header('Location: admin-tourists.php');
        return;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-tourists</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="resources/css/style2.css">
</head>
<body>
    
        <main>
<div class="dashboard">
  <div class="container-dash">
    <h2 class="heading">Dashboard</h2>
    <div class="ad-prof col">
        <img src="resources/images/motiur.jpg" alt="">
        <p>Admin</p>
    </div>
<!--      here &nbsp;&nbsp is used to prevent automatic line break-->
      <div class="suggest-pack col "><a href="admin-agencies.php" ><h4><i class="fas fa-box k"></i> &nbsp;&nbsp; Agencies</h4></a></div>
    <div class="suggest-pack col active"><a href="admin-tourists.php"><i class="fas fa-edit k"></i>  &nbsp;&nbsp;Tourists</a></div>
    <div class="suggest-pack col"><a href="admin-package2.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Packages</a></div>
      <div class="suggest-pack col "><a href="admin-message2.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Messages</a></div>
      <div class="suggest-pack col"><a href="logout.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Log Out</a></div>

    
</div>
</div>
    
    

<div class="customer-req">

    <?php
        

        if(empty($tourists)){
            echo '<h1 class="text-center pt-4">No Tourist Found</h1>';
        }else{
    ?>

    <div class="package-cus">
        <table>
            <tr>
                <th>ID</th>
                <th>Usename</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Profile Picture</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        
        <tbody>
            
        <?php
            $i = 1;
            foreach($tourists as $tourist){
//                if($tourist['tourist_status'] == 'unapproved'){
//                    echo "<tr class='table-warning'>";
//                }else{
                    echo "<tr>";
                            
                        echo "<td>". $i++ ."</td>";
                        echo "<td>". $tourist['tourist_username']  ."</td>";
                        echo "<td>". ucwords($tourist['tourist_firstname']) ."</td>";
                        echo "<td>". ucwords($tourist['tourist_lastname']) ."</td>";
                        echo "<td>". $tourist['tourist_email'] ."</td>";
                        echo "<td><img src='resources/images/". $tourist['profile_image'] ."' width='100' height='100' alt='". $tourist['tourist_username'] ."'></td>";
                        echo "<td>". $tourist['tourist_contact'] ."</td>";
                        echo "<td>". $tourist['tourist_address'] ."</td>";
                        echo "<td><a href='admin-tourists.php?delete=". $tourist['tourist_id'] ."' class='btn btn-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";

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
            margin-top: 50px;
            color: white;
        }

        td,
        th {
            /* border: 1px solid gray; */
          
            padding:20px ;
            text-align: center;
            font-size: 18px;
          
          
        }
        td:nth-child(even),  th:nth-child(even){
/* background: #1abc9c; */
background-color: #34495e;;

        }
        td:nth-child(odd), th:nth-child(odd){
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
            margin-left: 10px;
            margin-top: 50px;
        }

        .c-r {
            color: red;
        }
        .con-b{
            padding:10px;
            background: #27ae60;
            outline: none;
            border:none;
            border-radius: 5px;
        }
        /* table styling */
    </style>