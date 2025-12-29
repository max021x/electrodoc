<div class="container my-5">
    <?php if (count($posts) < 1) : ?>
        <div class="my-6 p-5 text-center">
            <p class="lead">No Tutorials Found 😭</p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img class="w-100 img-fluid" src="/uploads/posts/<?= isset($post->image) ? $post->image : '' ?>" class="card-img-top" alt="<?= htmlspecialchars($post->title) ?>">
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-primary"><?= htmlspecialchars($post->category ?? 'Electronics') ?></span>
                            </div>
                            <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($post->content, 0, 150)) ?>...</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Views: <?= $post->views ?></span>
                                <a href="/posts/<?= $post->id ?>" class="btn btn-outline-primary btn-sm">
                                    Read Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <!-- Paginate -->
    <?php require "../app/Views/_partials/pagination.php" ?>
</div>