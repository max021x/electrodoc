<div class="card shadow-sm">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Post ID: <span class="badge bg-secondary"><?= $post->id ?></span></h5>
            <small class="text-muted">Post Details</small>
        </div>
    </div>
    
    <div class="card-body">
        <h2 class="card-title mb-4"><?= htmlspecialchars($post->title) ?></h2>
        
        <?php if (!empty($post->image)): ?>
        <div class="mb-4">
            <div class="text-center">
                <img src="/uploads/posts/<?= isset($post->image) ? $post->image : ''?>" 
                     alt="<?= htmlspecialchars($post->title) ?>" 
                     class="img-fluid rounded" 
                     style="max-height: 300px;">
            </div>
        </div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0">Content</h6>
            </div>
            <div class="card-body">
                <p class="card-text mb-0"><?= nl2br(htmlspecialchars($post->content)) ?></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Created</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                            <?= date('F j, Y', strtotime($post->created_at)) ?>
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            <?= date('g:i A', strtotime($post->created_at)) ?>
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Image Info</h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($post->image)): ?>
                            <p class="mb-2">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Image attached
                            </p>
                            <small class="text-muted d-block">
                                <i class="fas fa-image me-1"></i>
                                Path: /uploads/posts/<?= htmlspecialchars($post->image) ?>
                            </small>
                        <?php else: ?>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-times-circle me-2"></i>
                                No image attached
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <a href="/admin/posts?page=1" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="/admin/posts/<?= $post->id ?>/edit" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>
            <small class="text-muted">
                Showing post details
            </small>
        </div>
    </div>
</div>