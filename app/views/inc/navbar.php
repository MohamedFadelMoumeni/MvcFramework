<div class="avbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-3">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong><?php echo SITENAME; ?></strong>
      </a>
     
       <?php if(isset($_SESSION['user_id'])) : ?>
        <ul class="navbar-nav ml-auto">
       <li class="nav-item "><a href="<?php echo URLROOT ?>/users/logout" class="nav-link">Logout</a></li>
       </ul>
       <?php else : ?>
        <ul class="navbar-nav ">
       <li class="nav-item "><a href="<?php echo URLROOT ?>/pages/index" class="nav-link">Home</a></li>
       <li class="nav-item "><a href="<?php echo URLROOT ?>/pages/about" class="nav-link">About</a></li>
       </ul>
       <?php endif; ?>
    </div>
  </div>