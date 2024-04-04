<?php

$conn = mysqli_connect('localhost','root','','urbancrew_db');

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:Index.html');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>
   
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css\style1.css">
      <title>Login</title>
      <script type="text/javascript">
          (function validate() {
              "use strict";


              $('.input100').each(function() {
                  $(this).on('blur', function() {
                      if ($(this).val().trim() != "") {
                          $(this).addClass('has-val');
                      } else {
                          $(this).removeClass('has-val');
                      }
                  })
              })



              $('.validate-input .input100').each(function() {
                  $(this).on('blur', function() {
                      if (validate(this) == false) {
                          showValidate(this);
                      } else {
                          $(this).parent().addClass('true-validate');
                      }
                  })
              })



              var input = $('.validate-input .input100');

              $('.validate-form').on('submit', function() {
                  var check = true;

                  for (var i = 0; i < input.length; i++) {
                      if (validate(input[i]) == false) {
                          showValidate(input[i]);
                          check = false;
                      }
                  }

                  return check;
              });


              $('.validate-form .input100').each(function() {
                  $(this).focus(function() {
                      hideValidate(this);
                      $(this).parent().removeClass('true-validate');
                  });
              });

              function validate(input) {
                  if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                      if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                          return false;
                      }
                  } else {
                      if ($(input).val().trim() == '') {
                          return false;
                      }
                  }
              }

              function showValidate(input) {
                  var thisAlert = $(input).parent();

                  $(thisAlert).addClass('alert-validate');
              }

              function hideValidate(input) {
                  var thisAlert = $(input).parent();

                  $(thisAlert).removeClass('alert-validate');
              }



          })(jQuery);
      </script>

  </head>

  <body>
      <div class="form-container">
          <form action="login.php" method="post">
              <h3>login now</h3>

              <input type="email" name="email" required placeholder="enter your email">
              <input type="password" name="password" required placeholder="enter your password">
              <input type="submit" name="submit" value="login now" class="form-btn">
              <p>don't have an account? <a href="register.html">register now</a></p>
          </form>
  </body>

  </html>