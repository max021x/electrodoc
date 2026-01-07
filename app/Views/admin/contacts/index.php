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

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Contact Messages</h1>
            <p class="text-muted mb-0">Manage all contact inquiries</p>
        </div>
    </div>
</div>

<div class="table-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">All Contact Messages</h5>
        <div class="d-flex gap-2">
            <form action="/admin/contacts" method="GET">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search messages...">
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
                    <th>Message</th>
                    <th width="120">Created Date</th>
                    <th width="100">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->id ?></td>
                        <td>
                            <div class="fw-semibold"><?= htmlspecialchars($contact->name) ?></div>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($contact->email) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($contact->email) ?>
                            </a>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($contact->message) ?>">
                                <?= htmlspecialchars(substr($contact->message, 0, 50)) ?>
                                <?php if (strlen($contact->message) > 50): ?>...<?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                <?= date('M j, Y', strtotime($contact->created_at)) ?>
                            </small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Show full message -->
                                <button type="button" class="btn btn-outline-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#messageModal<?= $contact->id ?>"
                                    title="View Message">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Delete Action -->
                                <form class="btn-group" action="/admin/contacts/<?= $contact->id ?>/delete" method="POST">
                                    <?= csrf_token() ?>
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this message?')"
                                        title="Delete Message">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Modal for viewing full message -->
                            <div class="modal fade" id="messageModal<?= $contact->id ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Message from <?= htmlspecialchars($contact->name) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">From:</label>
                                                <p class="mb-2"><?= htmlspecialchars($contact->name) ?></p>
                                                <a href="mailto:<?= htmlspecialchars($contact->email) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($contact->email) ?>
                                                </a>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Date:</label>
                                                <p><?= date('F j, Y \a\t g:i A', strtotime($contact->created_at)) ?></p>
                                            </div>
                                            <div>
                                                <label class="form-label fw-semibold">Message:</label>
                                                <div class="border rounded p-3 bg-light"
                                                    style="max-height: 300px; overflow-y: auto;">
                                                    <div class="lh-lg">
                                                        <?= nl2br(htmlspecialchars($contact->message)) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="mailto:<?= htmlspecialchars($contact->email) ?>" class="btn btn-primary">
                                                <i class="fas fa-reply me-1"></i> Reply
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- paginate -->
    <?php require "../app/Views/_partials/pagination.php" ?>
</div>

<!-- Empty State -->
<?php if (empty($contacts)): ?>
    <div class="text-center py-5">
        <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">No contact messages yet</h4>
        <p class="text-muted mb-0">All contact inquiries will appear here</p>
    </div>
<?php endif; ?>