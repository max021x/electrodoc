<div class="admin-header">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Users Management</h1>
            <p class="text-muted mb-0">Manage all registered users</p>
        </div>
        <a href="/admin/users/create" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> New User
        </a>
    </div>
</div>

<div class="table-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">All Users</h5>
        <div class="d-flex gap-2 align-items-center">
            <!-- Search Form -->
            <form action="/admin/users" method="GET" class="mb-0">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Search users..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>
            </form>

            <!-- Role Filter Form -->
            <form action="/admin/users" method="GET" class="mb-0">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <button class="btn btn-primary"><i class="fas fa-filter"></i></button>
                    <select name="role" class="form-select form-select-sm">
                        <option value="">All Roles</option>
                        <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= (isset($_GET['role']) && $_GET['role'] === 'user') ? 'selected' : '' ?>>User</option>
                        <option value="editor" <?= (isset($_GET['role']) && $_GET['role'] === 'editor') ? 'selected' : '' ?>>Editor</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="120">Registered</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td>
                            <div class="fw-semibold"><?= htmlspecialchars($user->name) ?></div>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($user->email) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($user->email) ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($user->role === 'admin'): ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php elseif ($user->role === 'editor'): ?>
                                <span class="badge bg-warning text-dark">Editor</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">User</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <small class="text-muted">
                                <?= date('M j, Y', strtotime($user->created_at)) ?>
                            </small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Edit Action -->
                                <a href="/admin/users/<?= $user->id ?>/edit" class="btn btn-outline-primary" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Delete Action -->
                                <form action="/admin/users/<?= $user->id ?>/delete" method="POST" class="btn-group">
                                    <?= csrf_token() ?>
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        title="Delete User">
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

    <!-- Empty State -->
    <?php if (empty($users)): ?>
        <div class="text-center py-5">
            <i class="fas fa-users fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No users yet</h4>
            <p class="text-muted mb-0">All registered users will appear here</p>
        </div>
    <?php endif; ?>

    <!-- Paginate -->
    <?php require "../app/Views/_partials/pagination.php" ?>
</div>