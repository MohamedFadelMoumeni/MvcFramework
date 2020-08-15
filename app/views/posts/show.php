<?php require APPROUTE . "/views/inc/header.php"; ?>
<br>


<a href="<?php echo URLROOT; ?>/posts/index" class="btn btn-light m-4"><i class="fas fa-backward m-1"></i>Back</a>

 <h1><?php echo $data['posts']->title; ?></h1>
 <div class="bg-secondary text-white p-2 mb-3">
 Written by <?php echo $data['user']->name; ?> on <?php echo $data['posts']->created_at; ?>
 </div>
 <p><?php echo $data['posts']->body;?></p>
 <?php if($data['posts']->user_id == $_SESSION['user_id']) : ?>
 <hr>
 <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['posts']->id; ?>" class="btn btn-dark">Edit</a>
 <form action="<?php echo URLROOT;?>/posts/delete/<?php echo $data['posts']->id; ?>" method="post" class="pull-right">
 <input type="submit" class="btn btn-danger text-white" value='delete'>
 </form>
 <?php endif ?>

<?php require APPROUTE . "/views/inc/footer.php"; ?> 