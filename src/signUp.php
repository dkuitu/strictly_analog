<?php
   //This php File loads the customer signup form, it is opened when a user clicks the "signup" button in the view/header.php file
   //it calls the db 
   ini_set('display_startup_errors', 1);
   ini_set('display_errors', 1);
   error_reporting(-1);
   require_once 'model/db_connect.php';
   require_once 'model/db_functions.php';
   require_once 'view/header.php';
   //session_start();
   ?>
<?php
   $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
   if (isset($firstname)) {
       if ($firstname === false) {
           $error_message .= 'invalid first name.';
       } else {
           $_POST['firstname'] = $firstname;
       }
   } else {
       if (isset($_POST['firstname'])) {
           $firstname = $_POST['firstname'];
       } else {
           $_POST['firstname'] = '';
           $firstname = $_POST['firstname'];
       }
   }
   
   $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
   if (isset($lastname)) {
       if ($lastname === false) {
           $error_message .= 'invalid last name.';
       } else {
           $_POST['lastname'] = $lastname;
       }
   } else {
       if (isset($_POST['lastname'])) {
           $lastname = $_POST['lastname'];
       } else {
           $_POST['lastname'] = '';
           $lastname = $_POST['lastname'];
       }
   }
   
   $email = filter_input(INPUT_POST, 'useremail', FILTER_SANITIZE_SPECIAL_CHARS);
   
   if (isset($email)) {
       if ($email === false) {
           $error_message .= 'invalid email.';
       } else {
           $_POST['useremail'] = $email;
       }
   } else {
       if (isset($_POST['useremail'])) {
           $email = $_POST['useremail'];
       } else {
           $_POST['useremail'] = '';
           $email = $_POST['useremail'];
       }
   }
   
   $password = filter_input(INPUT_POST, 'userpassword', FILTER_SANITIZE_SPECIAL_CHARS);
   
   if (isset($password)) {
       if ($password === false) {
           $error_message .= 'invalid password.';
       } else {
           $_POST['userpassword'] = $password;
       }
   } else {
       if (isset($_POST['userpassword'])) {
           $password = $_POST['userpassword'];
       } else {
           $_POST['userpassword'] = '';
           $password = $_POST['userpassword'];
       }
   }
   
   if (!($firstname == '' || $lastname == '' || $email == '' || $password == '')) {
       $confirm = newClient($firstname, $lastname, $email, $password);
       if (count($confirm) != 0) { ?>
<div class="flex items-center justify-center pa2 bg-gold hover-bg-green white ">
   <p class="f6 fw9 ttu tracked lh-title mt0 mb3 avenir">Welcome, <?php echo $confirm[0]['first_name']; ?> you're now a Strictly Analog member, <br> your user id is <?php echo $confirm[0]['user_id']; ?> <br> please login to shop!</p>
</div>
<?php };
   }
   else { 
   	if (!isset($_SESSION['user_id'])) {?>
<div class="flex items-center justify-center pa2 bg-gold blue ">
   <p class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Become a Strictly Analog member today!</p>
</div>
<div class="flex items-center justify-center pa2 bg-gold white ">
   <article>
      <form action="signUp.php" method="post">
         <input type="text" name="firstname" required id="firstname" placeholder="First Name:"><br><br>
         <input type="text" name="lastname" required id="lastname" placeholder="Last Name:"><br><br>
         <input type="email" name="useremail" required id="email" placeholder="Email:"><br><br>
         <input type="password" name="userpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required id="password" placeholder="Create a password:">
         <p>(<b>Note:</b> Password must be 8+ characters, 1 uppercase and lowercase letter, & 1 number)</p>
         <!-- <label for="marketing">How did you hear about Strictly Analog?</label><br>
            <select id="socialmedia" name="socialmedia">
                <option value=""></option>
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="twitter">Twitter</option>
                <option value="other">Other</option>
            </select><br><br> 
            this input data isn't handled in data base yet so I commented it out for now :)
            -->
         <input type="submit" value="Submit">
      </form>
   </article>
</div>
<?php
   } else { ?>
<div class="flex items-center justify-center pa2 bg-gold hover-bg-green white ">
   <p class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Music for the aurally inclined</p>
</div>
<?php }
   };
   require 'randomAlbums.php';
   require 'view/footer.php';
   ?>