<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Create New User</h1>
            <p class="text-muted mb-0">Add a new user to the system</p>
        </div>
        <a href="/admin/users" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-lg-10 col-xl-9">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <form action="/admin/users/store" method="POST">
            <?= csrf_token() ?>

            <div class="row g-3">
                <!-- Name Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter full name" required>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter password" required>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm password" required>
                    </div>
                </div>

                <!-- Role Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>
                </div>

                <!-- Status Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Account Status <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    id="status_active" value="1" checked>
                                <label class="form-check-label text-success" for="status_active">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    id="status_inactive" value="0">
                                <label class="form-check-label text-danger" for="status_inactive">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-redo me-1"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Create User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Help Information -->
<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h6 class="card-title mb-3">
            <i class="fas fa-info-circle text-primary me-2"></i>
            About User Roles & Status
        </h6>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h6 class="fw-bold">User Roles</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-danger me-2">Admin</span>
                            <small>Full access to admin panel and all features</small>
                        </li>
                        <li>
                            <span class="badge bg-secondary me-2">User</span>
                            <small>Standard user with limited access</small>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h6 class="fw-bold">Account Status</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-success me-2">Active</span>
                            <small>User can login and use the system</small>
                        </li>
                        <li>
                            <span class="badge bg-danger me-2">Inactive</span>
                            <small>User cannot login (account disabled)</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>