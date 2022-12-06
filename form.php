<!DOCTYPE HTML>  
<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
<style>
.error {color: #FF0000;}
</style>
</head>
<body class="body" style="padding: 30px">  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container" style="width: 400px; height: auto; background-color: rgba(0,0,255,.1); box-shadow:0px 0px 80px">
<h2>Log In to Register</h2>
<p><span class="error">* required field</span></p>
<div class="form">
  <div class="form1">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<legend>Name</legend> 
  <input type="text" required placeholder="Enter your name"name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <legend>Email</legend>
   <input type="text" required placeholder="Enter your Email Address"name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <legend>Website</legend>
   <input type="text" required placeholder="Enter your link" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  <legend>Comment</legend>
  <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  </div>
  <div class="gender">
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  </div>
  <br><br>
  <button>Register!</button>
  <br><br>
  <div class="output">
<?php
echo "<h2>Details:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
</div>
</form>
</div>

</div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>