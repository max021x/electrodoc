<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Edit User</h1>
            <p class="text-muted mb-0">Update user information</p>
        </div>
        <a href="/admin/users" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>
</div>

<!-- Error Alert -->
<?php if (isset($_SESSION['error'])): ?>
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    <?= htmlspecialchars($_SESSION['error']) ?>
    <?php unset($_SESSION['error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Success Alert -->
<?php if (isset($success)): ?>
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    <?= htmlspecialchars($success) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <form action="/admin/users/<?= $user->id ?>/update" method="POST">
            <?= csrf_token() ?>            
            <div class="row g-3">
                <!-- Name Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($user->name) ?>"
                               placeholder="Enter full name" required>
                    </div>
                </div>
                
                <!-- Email Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($user->email) ?>"
                               placeholder="name@example.com" required>
                    </div>
                </div>
                
                <!-- Password Field (Optional) -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Leave blank to keep current password">
                        <small class="text-muted">Leave empty if you don't want to change the password</small>
                    </div>
                </div>
                
                <!-- Confirm Password Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                               placeholder="Confirm new password">
                    </div>
                </div>
                
                <!-- Role Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select a role</option>
                            <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $user->role === 'user' ? 'selected' : '' ?>>User</option>
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
                                       id="status_active" value="1" 
                                       <?= $user->status == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label text-success" for="status_active">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="status_inactive" value="0"
                                       <?= $user->status == 0 ? 'checked' : '' ?>>
                                <label class="form-check-label text-danger" for="status_inactive">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Account Information -->
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    Account Information
                </h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block">User ID</small>
                            <strong><?= $user->id ?></strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block">Registered Date</small>
                            <strong><?= date('F j, Y', strtotime($user->created_at)) ?></strong>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            Password change is optional
                        </small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update User
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete User Section -->
<div class="card shadow-sm border-danger mt-4">
    <div class="card-header bg-white border-danger">
        <h5 class="mb-0 d-flex align-items-center text-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Danger Zone
        </h5>
    </div>
    <div class="card-body">
        <p class="text-danger small mb-3">
            <i class="fas fa-info-circle me-1"></i>
            Deleting a user is permanent and cannot be undone.
        </p>
        <button type="button" class="btn btn-outline-danger w-100" 
                data-bs-toggle="modal" 
                data-bs-target="#deleteUserModal">
            <i class="fas fa-trash me-1"></i> Delete User
        </button>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Delete User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone.
                </div>
                <p>Are you sure you want to delete user <strong><?= htmlspecialchars($user->name) ?></strong>?</p>
                <p class="text-muted">All user data including their account information will be permanently deleted.</p>
                <form action="/admin/users/<?= $user->id ?>" method="POST" id="deleteUserForm">
                    <?= csrf_token() ?>
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteUserForm" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Delete User Permanently
                </button>
            </div>
        </div>
    </div>
</div>