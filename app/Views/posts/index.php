<div class="container my-8">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(substr($post->content, 0, 150)) ?>...</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Views: <?= $post->views ?></span>
                            <a href="/posts/<?= $post->id ?>" class="btn btn-outline-primary btn-sm">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>