<?php 
   include('functions.php');
   include('server.php');
   $result = pg_query($db,"SELECT * FROM user_table");
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link
         rel="stylesheet"
         href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
         /> 
      <link rel="stylesheet" href="home.css" />
      <title>Alumni List</title>
   </head>
   <body>
      <div id="header">
         <header>
            <section id="profile">
               <img src="image/profilepicture.jpg" alt="Profile Picture" />
               <div id="credentials">
                  <h1 id="name"><?php echo $_SESSION['username']; ?></h1>
                  <h2 id="role">Admin</h2>
               </div>
            </section>
            <form action="#" id="toolbar">
               <i class="fas fa-search" id="search"></i>
               <input type="text" placeholder="Search Bar" />
            </form>
            <!-- <div id="toolbar">
               <i class="fas fa-search" id="search"></i>
               </div> -->
            <img id="logo" src="image/logo.png" alt="Logo" />
         </header>
      </div>
      <main>
         <?php 
		   include('menu.php'); 
		   ?>
         <section id="detailedTable">
            <table class="table table-dark">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Username</th>
                     <th scope="col">Password</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i=0;
                     while($row=pg_fetch_assoc($result)) {
                     ?>
                  <tr>
                     <th scope="row"><?php echo $row["id"]; ?></th>
                     <td><?php echo $row["username"]; ?></td>
                     <td><?php echo $row["password"]; ?></td>
                     <td>
                        <?php if($row["username"] == "admin")
                           {
                           	echo "admin can not be deleted";
                           }
                           else
                           { 
                           
                           ?>
                        <a href="delete_user.php?userid=<?php echo $row["id"]; ?>"><td>
                <button style="background-color: #e9c46a">DELETE</button> </td></a>
                        <?php } ?>
                     </td>
                  </tr>
                  <?php
                     $i++;
                     }
                     ?> 
               </tbody>
            </table>
         </section>
      </main>
   </body>
</html>