<div class="container my-8">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="images/electronic-car-1.jpg" class="card-img-top" alt="...">
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

    <!-- Bootstrap 5.3 Pagination -->
    <?php
    $queryParams = $_GET;
    unset($queryParams['page']);
    
    function buildQueryString(array $params, $page): string {
        $params['page'] = $page;
        return htmlspecialchars(http_build_query($params));
    }
    
    // Smart range calculation (show current page ± 2 pages)
    $range = 2;
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    ?>
    
    <?php if($totalPages > 1): ?>
    <nav aria-label="Posts pagination" class="mt-5">
        <ul class="pagination justify-content-center">
            
            <!-- Previous Page Link -->
            <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?<?= buildQueryString($queryParams, $currentPage - 1) ?>" 
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            
            <!-- First Page (with ellipsis if needed) -->
            <?php if($start > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?<?= buildQueryString($queryParams, 1) ?>">1</a>
                </li>
                <?php if($start > 2): ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            
            <!-- Page Range -->
            <?php for($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                    <?php if($i == $currentPage): ?>
                        <span class="page-link" aria-current="page"><?= $i ?></span>
                    <?php else: ?>
                        <a class="page-link" href="?<?= buildQueryString($queryParams, $i) ?>"><?= $i ?></a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <!-- Last Page (with ellipsis if needed) -->
            <?php if($end < $totalPages): ?>
                <?php if($end < $totalPages - 1): ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="?<?= buildQueryString($queryParams, $totalPages) ?>"><?= $totalPages ?></a>
                </li>
            <?php endif; ?>
            
            <!-- Next Page Link -->
            <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" 
                   href="?<?= buildQueryString($queryParams, $currentPage + 1) ?>" 
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            
        </ul>
    </nav>
    <?php endif; ?>
</div>