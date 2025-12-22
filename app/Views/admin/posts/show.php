<div class="card ">
    <div class=" card-header">
        <p><?= $post->id ?></p>
    </div>
    <div class="card-body">
        <h1><?= $post->title ?></h1>
        <p><?= $post->content ?></p>
    </div>
    <div class="card-footer">
        <p><?= $post->created_at ?></p>
    </div>
</div>