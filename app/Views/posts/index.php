<div class="container my-5">
    <!-- Category Filter Buttons -->
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-2 mb-3 justify-content-center">
            <a href="/posts" class="btn btn-outline-primary <?= !isset($_GET['category']) ? 'active' : '' ?>">
                All Tutorials
            </a>
            <a href="/posts?category=Sensors" class="btn btn-outline-primary <?= isset($_GET['category']) && $_GET['category'] == 'Sensors' ? 'active' : '' ?>">
                Sensors
            </a>
            <a href="/posts?category=MicroController" class="btn btn-outline-primary <?= isset($_GET['category']) && $_GET['category'] == 'MicroController' ? 'active' : '' ?>">
                MicroController
            </a>
            <a href="/posts?category=Resistor" class="btn btn-outline-primary <?= isset($_GET['category']) && $_GET['category'] == 'Resistor' ? 'active' : '' ?>">
                Resistor
            </a>
            <a href="/posts?category=Capacitor" class="btn btn-outline-primary <?= isset($_GET['category']) && $_GET['category'] == 'Capacitor' ? 'active' : '' ?>">
                Capacitor
            </a>
        </div>
        
        <?php if (isset($_GET['category'])): ?>
            <div class="alert alert-info d-flex align-items-center">
                <i class="fas fa-filter me-2"></i>
                Showing tutorials in category: <strong class="ms-2"><?= htmlspecialchars($_GET['category']) ?></strong>
                <a href="/posts" class="btn btn-sm btn-outline-info ms-auto">
                    <i class="fas fa-times me-1"></i> Clear Filter
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if (count($posts) < 1) : ?>
        <div class="my-6 p-5 text-center">
            <p class="lead">
                <?php if (isset($_GET['category'])): ?>
                    No tutorials found in <strong><?= htmlspecialchars($_GET['category']) ?></strong> category 😭
                <?php else: ?>
                    No Tutorials Found 😭
                <?php endif; ?>
            </p>
            <?php if (isset($_GET['category'])): ?>
                <a href="/posts" class="btn btn-primary mt-2">
                    <i class="fas fa-arrow-left me-1"></i> View All Tutorials
                </a>
            <?php endif; ?>
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