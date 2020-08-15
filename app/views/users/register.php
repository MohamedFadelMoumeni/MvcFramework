<?php require APPROUTE . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
     <div class="card card-body bg-light mt-4">
     <?php flash('register_success'); ?>
     <h2 class="text-center">Register Page</h2>
     <p class="text-center">Please fill out this form to register with us.</p>
     <form action="<?php echo URLROOT; ?>/users/register" method="post">
     <div class="form-group">
         <label for="name">Name : <sup>*</sup></label>
         <input type="text" name="name" id="" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['name']; ?>">
         <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
     </div>
     <div class="form-group">
         <label for="email">Email : <sup>*</sup></label>
         <input type="email" name="email" id="" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email']; ?>">
         <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
     </div>
     <div class="form-group">
         <label for="password">Password : <sup>*</sup></label>
         <input type="password" name="password" id="" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password']; ?>">
         <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
     </div>
     <div class="form-group">
         <label for="confirm_password">Confirm password : <sup>*</sup></label>
         <input type="password" name="confirm_password" id="" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['confirm_password']; ?>">
         <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
     </div>
     <div class="row">
         <div class="col">
             <input type="submit" value="submit" class="btn btn-success btn-block">
         </div>
         <div class="col">
             <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Login</a>
         </div>
     </div>
    </form>
     </div>
    </div>
</div>
<?php require APPROUTE . "/views/inc/footer.php"; ?>