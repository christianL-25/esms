<?php
// Include the database connection file
require_once "db/db_connection.php";

// Initialize variables for modal messages
$showSuccessModal = false;
$showErrorModal = false;
$errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['createFirstName'];
    $lastName = $_POST['createLastName'];
    $email = $_POST['exampleInputEmail'];
    $password = $_POST['exampleInputPassword'];
    $repeatPassword = $_POST['exampleRepeatPassword'];
    $accountType = $_POST['accountType'];
    $designation = $_POST['designation'];
    $companyId = $_POST['idCompany'];
    $employeeId = $_POST['idEmployee'];
    $areaId = $_POST['idArea'];

    // Check if passwords match
    if ($password === $repeatPassword) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into database
        $sql = "INSERT INTO tbl_users (first_name, last_name, account_type, email_address, password, designation, id_company, id_employee, id_area) 
                VALUES ('$firstName', '$lastName', '$accountType', '$email', '$hashedPassword', '$designation', '$companyId', '$employeeId', '$areaId')";

        if ($conn->query($sql) === TRUE) {
            $showSuccessModal = true;
        } else {
            $showErrorModal = true;
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $showErrorModal = true;
        $errorMessage = "Passwords do not match.";
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>EMICORP - Register</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image">
            <img src="img/logo.png" style="margin: 15%;">
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="register.php">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="createFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="createLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="accountType" placeholder="Account Type">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="designation" placeholder="Designation">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="idCompany" placeholder="Company ID">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="idEmployee" placeholder="Employee ID">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="idArea" placeholder="Area ID">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Registration Success</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Your account has been successfully created.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Error Modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Registration Error</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo $errorMessage; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>



<?php if ($showSuccessModal): ?>
  <script>
    $(document).ready(function(){
      $('#successModal').modal('show');
    });
  </script>
  <?php elseif ($showErrorModal): ?>
  <script>
    $(document).ready(function(){
      $('#errorModal').modal('show');
    });
  </script>
  <?php endif; ?>



</body>
</html>
