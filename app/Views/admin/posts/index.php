<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Posts Management</h1>
            <p class="text-muted mb-0">Manage all your blog posts</p>
        </div>
        <a href="/admin/posts/create" class="btn btn-primary">
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
                                <a href="/admin/posts/<?= $post->id?>/edit" class="btn btn-outline-primary" title="Edit Post">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <!-- Delete Action - Trash Bin Icon -->
                                <form class="btn-group" action="/admin/posts/<?= $post->id ?>/delete" method="POST">
                                    <?=csrf_token() ?>
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

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
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