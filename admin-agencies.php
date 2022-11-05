<?php
    

?>


<?php
    include 'database/db.php';
    //Tourist Read Query
    $stmt = $pdo->query('SELECT * FROM agencies ORDER BY agency_name');
    $stmt->execute();
    $agencies = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $agencies[] = $row;
    }


    if(isset($_GET['delete'])){
        $agency_id = $_GET['delete'];

        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('DELETE FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $_SESSION['success'] = 'Successfully Deleted  Agency Info';
        header('Location: admin-agencies.php');
        return;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Agencies</title>
    
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
      <div class="suggest-pack col active"><a href="admin-agencies.php" ><h4><i class="fas fa-box k"></i> &nbsp;&nbsp; Agencies</h4></a></div>
    <div class="suggest-pack col "><a href="admin-tourists.php"><i class="fas fa-edit k"></i>  &nbsp;&nbsp;Tourists</a></div>
    <div class="suggest-pack col"><a href="admin-package2.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Packages</a></div>
      <div class="suggest-pack col "><a href="admin-message2.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Messages</a></div>
      <div class="suggest-pack col"><a href="logout.php"><i class="fas fa-wallet k"></i>&nbsp;&nbsp; Log Out</a></div>

    
</div>
</div>
    
    

<div class="customer-req">

    <?php
        

        if(empty($agencies)){
            echo '<h1 class="text-center pt-4">No Tourist Found</h1>';
        }else{
    ?>
<!--    <h2 class="c-r">Pending Approval</h2>-->
    <div class="package-cus">
        <table>
            <tr>
                <th>SL.</th>
                <th>Agency name</th>
                <th>Owner Firstname</th>
                <th>Owner Lastname</th>
                <th>Email</th>
                <th>Cover Picture</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Action</th>
<!--                <th colspan="2" >Action</th>-->
            </tr>
        
        <tbody>
            
        <?php
            $i = 1;
            foreach($agencies as $agency){
//                if($tourist['tourist_status'] == 'unapproved'){
//                    echo "<tr class='table-warning'>";
//                }else{
                    echo "<tr>";
                            
                        echo "<td>". $i++ ."</td>";
                        echo "<td>". $agency['agency_name']  ."</td>";
                        echo "<td>". ucwords($agency['agency_firstname']) ."</td>";
                        echo "<td>". ucwords($agency['agency_lastname']) ."</td>";
                        echo "<td>". $agency['agency_email'] ."</td>";
                        echo "<td><img src='resources/images/". $agency['agency_profile_image'] ."' width='100' height='100' alt='". $agency['agency_name'] ."'></td>";
                        echo "<td>". $agency['agency_contact'] ."</td>";
                        echo "<td>". $agency['agency_address'] ."</td>";
//                        echo "<td>". ucwords($tourist['tourist_status']) ."</td>";
//                        echo "<td>". $tourist['date']. "</td>";

//                    if($tourist['tourist_status'] == 'unapproved'){
//                        echo "<td><a href='tourists.php?approve=". $tourist['tourist_id'] ."' class='btn btn-success mt-1'>Approve</a></td>";
//                        echo "<td><a href='tourists.php?unapprove=". $tourist['tourist_id'] ."' class='btn btn-secondary mt-1'>Unapprove</a></td>";
                        // echo "<td><a href='tourists.php?page=edit_tourist&edit=". $tourist['tourist_id'] ."' class='btn btn-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
                        echo "<td><a href='admin-agencies.php?delete=". $agency['agency_id'] ."' class='btn btn-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
//                    }else {
//                        echo "<td><a href='tourists.php?approve=". $tourist['tourist_id'] ."' class='btn btn-outline-success mt-1'>Approve</a></td>";
//                        echo "<td><a href='tourists.php?unapprove=". $tourist['tourist_id'] ."' class='btn btn-outline-secondary mt-1'>Unapprove</a></td>";
                        // echo "<td><a href='tourists.php?page=edit_tourist&edit=". $tourist['tourist_id'] ."' class='btn btn-outline-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
//                        echo "<td><a href='admin-agencies2.php?delete=". $agency['agency_id'] ."' class='btn btn-outline-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
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