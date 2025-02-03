<h1>Here is the post</h1>




<div class="border border-dark">
    <h3><?= $post->getTitle() ?></h3>
    <p><?= $post->getContent() ?></p>
    <a href="?type=post&action=index" class="btn btn-primary">Return</a>
    <a href="?type=post&action=delete&id=<?=$post->getId() ?>" class="btn btn-danger">Delete</a>
    <a href="?type=post&action=edit&id=<?=$post->getId() ?>" class="btn btn-warning">Edit</a>
</div>




