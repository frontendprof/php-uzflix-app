
<?php
    
    require_once("includes/config.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");

    require_once("includes/classes/Account.php");

        $account=new Account($con);

    if(isset($_POST['submitBtn'])){
        // echo "Form is submitted";
        $firstName=FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName=FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username=FormSanitizer::sanitizeUsername($_POST["username"]);
        $email=FormSanitizer::sanitizeFormString($_POST["email"]);
        $email2=FormSanitizer::sanitizeFormString($_POST["email2"]);
        $password=FormSanitizer::sanitizePassword($_POST["pass"]);
        $password2=FormSanitizer::sanitizePassword($_POST["pass2"]);


        $success=$account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);
        if($success){
            header("Location: index.php");
        }
    }

    
    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Uz-flix</title>
</head>
<body>

<div class="container">
    <div class="column">

        <div class="header">
            <img src="assets/images/uzflix_logo2.png" title="Uzflix Logo" alt="Site logo">
            <h3>Sign up</h3>
            <span>to continue to Uzflix</span>
        </.>

        <form action="" method="POST">

            <?php echo $account->getError(Constants::$firstNameCharacters);  ?>
            <input type="text" placeholder="First name" name="firstName" value="<?php getInputValue('firstName'); ?>" required>

            <?php echo $account->getError(Constants::$lastNameCharacters);  ?>
            <input type="text" placeholder="Last name" name="lastName" value="<?php getInputValue('lastName'); ?>" required>

            <?php echo $account->getError(Constants::$usernameCharacters);  ?>
            <?php echo $account->getError(Constants::$usernameTaken);  ?>
            <input type="text" placeholder="Username" name="username" value="<?php getInputValue('username'); ?>" required>

            <?php echo $account->getError(Constants::$emailsDontMatch);  ?>
            <?php echo $account->getError(Constants::$emailInvalid);  ?>
            <?php echo $account->getError(Constants::$emailTaken);  ?>
            <input type="email" placeholder="Email" name="email" value="<?php getInputValue('email'); ?>" required>            
            <input type="email" placeholder="Confirm email" name="email2" value="<?php getInputValue('email2'); ?>" required>

            <?php echo $account->getError(Constants::$passwordsDontMatch);  ?>
            <?php echo $account->getError(Constants::$passwordCharacters);  ?>
            <input type="password" placeholder="Password" name="pass" required>

            <input type="password" placeholder="Confirm password" name="pass2" required>
            <input type="submit" value="Submit" name="submitBtn">



        </form>
        <a href="login.php" class="loginMsg">Already have an account? Sign in here</a>
    </div>
</div>


    
</body>
</html>