<?php require APPROUTE . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/posts/index" class="btn btn-light m-4"><i class="fas fa-backward m-1"></i>Back</a>

     <div class="card card-body bg-light mt-4">

     <h2 class="text-center">Add Post</h2>
    
     <p class="text-center">Create a new Post .</p>
     <form action="<?php echo URLROOT; ?>/posts/add" method="post">

     <div class="form-group">
         <label for="title">Title : <sup>*</sup></label>
         <input type="text" name="title" id="" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['title']; ?>">
         <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
     </div>
     <div class="form-group">
         <label for="body">Body : <sup>*</sup></label>
         <textarea type="text" name="body" id="" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"> <?php echo $data['body']; ?></textarea>
         <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
     </div>
     <input type="submit" value="submit" class="btn btn-success">
    
    </form>
   
    </div>

<?php require APPROUTE . "/views/inc/footer.php"; ?>