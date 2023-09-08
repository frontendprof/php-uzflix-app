<?php

 require_once("includes/header.php");

 $preview=new PreviewProvider($con,$userLoggedIn);

 $preview->createPreviewVideo(null);



 $containers=new CategoryContainers($con,$userLoggedIn);

 $containers->showAllCategories();

?>



   