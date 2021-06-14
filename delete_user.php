<?php
//This file removes rows from table
   include('functions.php');
   include('server.php');
   
   $query = "DELETE FROM user_table WHERE id=". $_GET["userid"];
     
     $result = pg_query($query);
     
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
               <input type="text" placeholder="Search" />
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
            <table>
               <tr>
                  <td>
                     <?php
                        if($result){
                             echo "User Deleted Successfully.";
                         }
                         else{
                             echo "Error : " + pg_last_error();
                         }
                        ?>
                     <br/>
                  </td>
               </tr>
               <tr>
                  <td>
                     <a href="table.php">Back To Userlist</a>
                  </td>
               </tr>
            </table>
         </section>
      </main>
   </body>
</html>