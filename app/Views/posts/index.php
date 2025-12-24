<div class="container my-6">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="images/electronic-car-1.jpg" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                        <p class="card-text text-muted"><?= htmlspecialchars(substr($post->content, 0, 150)) ?>...</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i><?= $post->views ?>
                            </small>
                            <a href="/posts/<?= $post->id ?>" class="btn btn-outline-primary btn-sm">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    $queryParams = $_GET;
    unset($queryParams['page']);

    function buildQueryString(array $params, $page): string
    {
        $params['page'] = $page;
        return htmlspecialchars(http_build_query($params));
    }

    $range = 2; 
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    ?>

    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > $range + 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= buildQueryString($queryParams, 1) ?>">1</a>
                    </li>
                    <?php if ($currentPage > $range + 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <?php if ($i == $currentPage): ?>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link"><?= $i ?></span>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="?<?= buildQueryString($queryParams, $i) ?>"><?= $i ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>