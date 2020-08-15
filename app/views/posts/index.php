<?php require APPROUTE . "/views/inc/header.php"; ?>


<div class="row mb-3">
  <div class="col-md-6">
  <h1>Posts</h1>
  </div>
  <div class="col-md-6">
  <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary pull-right">
  <i class="fa fa-pencil"></i> Add post
  </a>

  </div>
</div>
<?php flash('post_message'); ?>
<?php foreach($data['posts'] as $posts) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $posts->title;?></h4>
        <div class="bg-light p-2 mb-3">
        written by <?php echo $posts->name; ?> on <?php echo $posts->postCreated; ?>
        </div>
        <p class="card-text">
            <?php echo $posts->body; ?>
        </p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $posts->postId; ?>" class="btn btn-dark">Read More</a>
    </div>
<?php endforeach; ?>
<?php require APPROUTE . "/views/inc/footer.php"; ?>