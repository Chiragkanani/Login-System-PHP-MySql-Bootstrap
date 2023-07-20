
<?php
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "chiragphp";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = $_POST['username'];
  $password = $_POST['password'];

          $sql="SELECT * FROM `signup` WHERE `username` = '$username' ";
          $result = mysqli_query($conn, $sql);
          $num=mysqli_num_rows($result);
          if($num>0)
          {

          
                  $row=mysqli_fetch_assoc($result);
                  if(password_verify($password,$row['password'] ))
                  {
                      session_start();
                      $_SESSION['username']="$username";
                      $_SESSION['loggedin']=true;
                      header('location:welcome.php');
                    }else{
                      $error="invalid password";
                  }
           }else{
            $error="invalid username";
           }
}

?>






<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="login.php">iSecure</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="welcome.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="login.php">Login</a>
        </li>
      
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="signup.php">Signup</a>
        </li>
         
<?php
      session_start();
      if(isset($_SESSION['loggedin'])){
       echo  '<li class="nav-item">
        <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
        </li>';
      }
?>
        
</ul>
          
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<?php
if( isset($error)){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>sorry!!!....</strong>' .$error.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
?>


<div class="container mt-4">
<h2 class="text-center">First Login to our website</h2>
<p class="text-center">if you have not acconut?<a href="signup.php">signup</a></p>

<form action="login.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username"  name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name ="password" id="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Login</button>
</form>




</div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>