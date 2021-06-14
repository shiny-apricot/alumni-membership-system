<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    />
    <link rel="stylesheet" href="home.css" />
    <title>Admins</title>
  </head>
  <body>
    <div id="header">
      <header>
        <section id="profile">
          <img src="image/profilepicture.jpg" alt="Profile Picture" />
          <div id="credentials">
            <h1 id="name">Ahmet Soran</h1>
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
      <ul id="aull">
        <li><a href="home.php">Home</a></li>
        <li><a href="table.php">Detailed Table</a></li>
        <li><a href="bank.html">Bank Information</a></li>
        <li><a style="font-weight: bold" href="users.php">Admins</a></li>
        <li><a href="settings.html">Settings</a></li>
        <li><a href="#">Log Out</a></li>

        <button id="thebtn">Add Admin</button>
      </ul>
      <section id="yadi">
        <table id="dt">
          <thead>
            <tr class="dtr">
              <th>TC</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Email</th>
              <th>Level</th>
            </tr>
          </thead>
          <tbody>
            <tr class="dtr">
              <td>110510102</td>
              <td>Ahmet</td>
              <td>Soran</td>
              <td>Soran@gmail.com</td>
              <td>Admin</td>
              <td>
                <button style="background-color: #e9c46a">Remove</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </body>
</html>
