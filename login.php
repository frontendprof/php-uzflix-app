
<?php


require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

require_once("includes/classes/Account.php");

$account=new Account($con);

  

    if(isset($_POST['loginBtn'])){
        
        $username=FormSanitizer::sanitizeUsername($_POST["username"]);
        $password=FormSanitizer::sanitizePassword($_POST["pass"]);


        $success=$account->login($username,$password);
        if($success){
            $_SESSION['userLoggedIn']=$username;
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
            <h3>Sign in</h3>
            <span>to continue to Uzflix</span>
        </.>

        <form action="" method="POST">
            
            <?php echo $account->getError(Constants::$loginFailed);  ?>
            <input type="text" placeholder="Username" name="username" value="<?php getInputValue('username'); ?>" required>         
            <input type="password" placeholder="Password" name="pass" required>
            <input type="submit" value="Login" name="loginBtn">



        </form>
        <a href="register.php" class="loginMsg">Need an account? Sign up here</a>
    </div>
</div>


    
</body>
</html>