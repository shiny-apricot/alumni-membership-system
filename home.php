<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    />
    <link rel="stylesheet" href="home.css" />
    <title>Home</title>
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
        <li><a style="font-weight: bold" href="#">Home</a></li>
        <li><a href="table.html">Detailed Table</a></li>
        <li><a href="bank.html">Bank Information</a></li>
        <li><a href="admins.html">Admins</a></li>
        <li><a href="settings.html">Settings</a></li>
        <li><a href="#">Log Out</a></li>
      </ul>
      <section id="statistics">
        <div id="ms">
          <article>
            <p>TOTAL INCOME</p>
            <div class="data">
              <i class="fas fa-donate"></i>
              <p>$50.000</p>
            </div>
          </article>
          <article>
            <p>DONATIONS</p>
            <div class="data">
              <i class="fas fa-hand-holding-usd"></i>
              <p>$40.250</p>
            </div>
          </article>
          <article>
            <p>BALANCE</p>
            <div class="data">
              <i class="fas fa-balance-scale"></i>
              <p>+25.600</p>
            </div>
          </article>
        </div>
        <div id="gs">
          <section id="beside">
            <div id="beforefancy">
              <section class="stats">
                <p>TOP DONATIONS</p>
                <div class="data">
                  <i class="fas fa-arrow-up"></i>
                  <p>$12.560</p>
                </div>
                <div class="profilo">
                  <img src="image/person.jpg" alt="person" />
                  <div class="iden">
                    <p>Yasin inal</p>
                    <p>11051010</p>
                  </div>
                </div>
              </section>
              <section class="stats">
                <p>LAST DONATIONS</p>
                <div class="data">
                  <i class="fas fa-arrow-up"></i>
                  <p>$12.560</p>
                </div>
                <div class="profilo">
                  <img src="image/person.jpg" alt="person" />
                  <div class="iden">
                    <p>Yasin inal</p>
                    <p>11051010</p>
                  </div>
                </div>
              </section>
              <section class="stats">
                <p>LOWEST FEE</p>
                <div class="data">
                  <i class="fas fa-arrow-down"></i>
                  <p>$12.560</p>
                </div>
                <div class="profilo">
                  <img src="image/person.jpg" alt="person" />
                  <div class="iden">
                    <p>Yasin inal</p>
                    <p>11051010</p>
                  </div>
                </div>
              </section>
            </div>


            <div id="fancyfigures">
              <!-- 
                you may add the pie chart here
               -->
               <?php include('donut_chart.php') ?>
               
            </div>
          </section>
          <aside id="list">
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Fee</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Yasin</td>
                  <td>inal</td>
                  <td>$12.560</td>
                </tr>
                <tr>
                  <td>Jhon</td>
                  <td>Cena</td>
                  <td>$100</td>
                </tr>
              </tbody>
            </table>
          </aside>
        </div>
      </section>
    </main>
  </body>
</html>
