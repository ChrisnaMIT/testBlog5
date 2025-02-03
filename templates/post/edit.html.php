<h1>Here is the post</h1>




<div class="border border-dark">

    <form action="?type=post&action=create&id=<?= $post->getId() ?>" method="post" class="form-control">

        <input type="text" name="title" value="<?= $post->getTitle() ?>">
        <textarea name="content" id="" cols="30" rows="10"><?= $post->getContent() ?></textarea>
        <button type="submit" class="btn btn-success">edit</button>

    </form>


</div>




