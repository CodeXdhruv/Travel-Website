<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "travel"; 
   
    $con = mysqli_connect($servername, $username, $password, $db);


    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $desc = isset($_POST['desc']) ? $_POST['desc'] : '';

        $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) 
                VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp())";

        if ($con->query($sql) === false) {
            echo "Error: $sql <br> $con->error";
        } 
     
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js">
        let table = new DataTable('#myTable');
    </script>
</head>
<body>
<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <img src="p.jpg" alt="">
    <div class="container">
        <h1>Welcome to ESSER Travels</h1>
        <p style="text-align: center;">Enter your details </p>
        <form action="index.php" method="POST">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="text" name="email" id="email" placeholder="Enter your email">
            <input type="text" name="phone" id="phone" placeholder="Enter your phone no">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other thing you would like to share"></textarea>
            <br>
            <button class="btn" name="save">Submit</button>

        </form>
    </div>
    <hr>
    <table class="table table-dark table-striped" id="myTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM trip";
        $result = mysqli_query($con, $sql);
        $sno=1;

        while ($row = mysqli_fetch_assoc($result)) {
            $sno=$sno+1;
            echo '<tr>
                
                <td>' . $row['name'] . '</td>
                <td>' . $row['age'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>' . $row['other'] . '</td>
                <td><a href="/edit">Edit</a> /<a href="/del">Delete</a></td>
                </tr>';
                
        }
        ?>
    </tbody>
</table>

</body>
</html>
