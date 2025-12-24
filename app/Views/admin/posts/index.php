<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Posts Management</h1>
            <p class="text-muted mb-0">Manage all your blog posts</p>
        </div>
        <a href="/admin/posts/create" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i> New Post
        </a>
    </div>
</div>

<div class="table-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">All Posts</h5>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm" style="width: 200px;">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control form-control-sm" placeholder="Search posts...">
            </div>
            <select class="form-select form-select-sm" style="width: 150px;">
                <option>All Status</option>
                <option>Published</option>
                <option>Draft</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th>Title</th>
                    <th width="120">Created Date</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample data - replace with dynamic content -->
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= $post->id ?></td>
                        <td>
                            <div class="fw-semibold"><?= $post->title ?></div>
                            <!-- <small class="text-muted">PHP, Web Development</small> -->
                        </td>
                        <!-- <td><span class="badge bg-success">Published</span></td> -->
                        <td><?= $post->created_at ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Show Action - Magnet Icon -->
                                <a href="/admin/posts/<?= $post->id ?>/show" class="btn btn-outline-info" title="View Post">
                                    <i class="fas fa-search"></i>
                                </a>
                                <!-- Edit Action - Pen Icon -->
                                <a href="/admin/posts/<?= $post->id ?>/edit" class="btn btn-outline-primary" title="Edit Post">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <!-- Delete Action - Trash Bin Icon -->
                                <form class="btn-group" action="/admin/posts/<?= $post->id ?>/delete" method="POST">
                                    <?= csrf_token() ?>
                                    <button href="#" class="btn btn-outline-danger btn-delete" title="Delete Post">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


    <!-- Bootstrap 5.3 Pagination -->
    <?php
    $queryParams = $_GET;
    unset($queryParams['page']);

    function buildQueryString(array $params, $page): string
    {
        $params['page'] = $page;
        return htmlspecialchars(http_build_query($params));
    }

    // Smart range calculation (show current page ± 2 pages)
    $range = 2;
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    ?>

    <?php if ($totalPages > 1): ?>
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
                <?php if ($start > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= buildQueryString($queryParams, 1) ?>">1</a>
                    </li>
                    <?php if ($start > 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Page Range -->
                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <?php if ($i == $currentPage): ?>
                            <span class="page-link" aria-current="page"><?= $i ?></span>
                        <?php else: ?>
                            <a class="page-link" href="?<?= buildQueryString($queryParams, $i) ?>"><?= $i ?></a>
                        <?php endif; ?>
                    </li>
                <?php endfor; ?>

                <!-- Last Page (with ellipsis if needed) -->
                <?php if ($end < $totalPages): ?>
                    <?php if ($end < $totalPages - 1): ?>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this post?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>