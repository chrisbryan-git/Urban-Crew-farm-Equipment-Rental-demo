<?php

$conn = mysqli_connect('localhost', 'root', '', 'urbancrew_db');

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
  
      $error[] = 'user already exist!';
      } 
   else {

      if ($pass != $cpass) {
         $error[] = 'password not matched!';
      } else {
         $insert = "INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
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
   <title>register form</title>
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

      <form onsubmit="validate()" action="" method="post">
         <h3>register now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
         }
         ?>
         <input type="text" name="name" required placeholder="enter your name">
         <input type="email" name="email" required placeholder="enter your email">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="password" name="cpassword" required placeholder="confirm your password">
         <select name="user_type">
            <option value="admin">admin</option>
            <option value="user">user</option>
         </select>
         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>Already have an account? <a href="login.php">login now</a></p>
      </form>

   </div>

</body>

</html>