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
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="home.css" />
    <title>Bank</title>
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
      <ul id="aul">
        <li><a href="home.php">Home</a></li>
        <li><a href="table.html">Detailed Table</a></li>
        <li><a style="font-weight: bold" href="#">Bank Information</a></li>
        <li><a href="admins.html">Admins</a></li>
        <li><a href="settings.html">Settings</a></li>
        <li><a href="#">Log Out</a></li>

        <!-- <button id="thebtn">Edit Table</button> -->
      </ul>
      <section id="bank">
        <div class="fixpos">
          <table id="banktable">
            <thead>
              <tr class="">
                <th>TC</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Receipt Date</th>
                <th>Amount</th>
                <th>Receipt No.</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <td>110510102</td>
                <td>Yasin</td>
                <td>inal</td>
                <td>2021-01-01</td>
                <td>$50</td>
                <td>1</td>
              </tr>
              <tr class="">
                <td>110510102</td>
                <td>Jhon</td>
                <td>Cena</td>
                <td>2020-01-01</td>
                <td>$500</td>
                <td>8</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="divider"></div>
        <div class="fixpos">
          <div id="">
            <label for="start">Select Year:</label>
            <input
              type="month"
              id="start"
              name="start"
              min="2014-01"
              value="2018-05"
            />
          </div>
          <table id="extratable">
            <thead>
              <tr class="">
                <th>TC</th>
                <th>Year</th>
                <th>Annual Dues</th>
                <th>Dues Paid</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <td>110510102</td>
                <td>2021</td>
                <td>$50</td>
                <td>$50</td>
              </tr>
              <tr class="">
                <td>153785432</td>
                <td>2020</td>
                <td>$500</td>
                <td>$77</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </body>
</html>
