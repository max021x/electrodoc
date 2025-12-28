<div class="card shadow-sm">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Post ID: <span class="badge bg-secondary"><?= $post->id ?></span></h5>
            <small class="text-muted">Post Details</small>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Category Badge -->
        <div class="mb-3">
            <?php if (!empty($post->category)): ?>
                <span class="badge bg-primary px-3 py-2">
                    <i class="fas fa-tag me-1"></i>
                    <?= htmlspecialchars($post->category) ?>
                </span>
            <?php else: ?>
                <span class="badge bg-secondary px-3 py-2">
                    <i class="fas fa-tag me-1"></i>
                    No Category
                </span>
            <?php endif; ?>
        </div>
        
        <h2 class="card-title mb-4"><?= htmlspecialchars($post->title) ?></h2>
        
        <?php if (!empty($post->image)): ?>
        <div class="mb-4">
            <div class="text-center">
                <img src="/uploads/posts/<?= htmlspecialchars($post->image) ?>" 
                     alt="<?= htmlspecialchars($post->title) ?>" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 300px;">
            </div>
        </div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0">Content</h6>
            </div>
            <div class="card-body">
                <div class="lh-lg">
                    <?= nl2br(htmlspecialchars($post->content)) ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                            Created
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <?= date('F j, Y', strtotime($post->created_at)) ?>
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            <?= date('g:i A', strtotime($post->created_at)) ?>
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-eye me-2 text-muted"></i>
                            Views
                        </h6>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0"><?= number_format($post->views ?? 0) ?></h4>
                        <small class="text-muted">Total views</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-image me-2 text-muted"></i>
                            Image Info
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($post->image)): ?>
                            <p class="mb-2">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Image attached
                            </p>
                            <small class="text-muted d-block">
                                <?= htmlspecialchars(basename($post->image)) ?>
                            </small>
                        <?php else: ?>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-times-circle me-2"></i>
                                No image
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
                <a href="/admin/posts" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Posts
                </a>
                <a href="/admin/posts/<?= $post->id ?>/edit" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit Post
                </a>
            </div>
            <div class="text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Last updated: 
                <?php if (isset($post->updated_at) && $post->updated_at): ?>
                    <?= date('M j, Y', strtotime($post->updated_at)) ?>
                <?php else: ?>
                    Never
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>