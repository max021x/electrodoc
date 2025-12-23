<div class="card ">
    <div class=" card-header">
        <p><?= $post->id ?></p>
    </div>
    <div class="card-body">
        <form action="/admin/posts/<?= $post->id  ?>/update" method="POST">
            <?=csrf_token() ?>
            <div>
                <label for="title">Title</label>
                <input class="card-title form-control" name="title" value="<?= $post->title ?>"></input>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea class="card-text form-control"><?= $post->content ?></textarea>
            </div>
            <div class="d-grid">
                <button class="btn btn-success mt-3">Update</button>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <p><?= $post->created_at ?></p>
    </div>
</div>