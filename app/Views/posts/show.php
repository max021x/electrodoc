<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-9">

            <!-- Back Navigation -->
            <div class="mb-4">
                <a href="/posts" class="btn btn-outline-secondary btn-sm px-3 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to Posts
                </a>
            </div>

            <!-- Main Post Content Card -->
            <div class="card shadow-lg mb-5">
                <!-- Post Header -->
                <div class="card-header bg-white border-bottom py-4 px-4 px-md-5">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <?php if (isset($post->category_name)): ?>
                            <span class="badge bg-primary px-3 py-2 mb-2">
                                <i class="fas fa-tag me-1"></i>
                                <?= htmlspecialchars($post->category_name) ?>
                            </span>
                        <?php endif; ?>
                        
                        <div class="text-muted d-flex align-items-center gap-3">
                            <?php if (isset($post->created_at)): ?>
                                <span class="d-flex align-items-center fs-6 fs-md-base">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?= date('F j, Y', strtotime($post->created_at)) ?>
                                </span>
                            <?php endif; ?>
                            <span class="d-flex align-items-center fs-6 fs-md-base">
                                <i class="fas fa-eye me-2"></i>
                                <?= number_format($post->views) ?> views
                            </span>
                        </div>
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-0 fs-3 fs-md-2 fs-lg-1"><?= htmlspecialchars($post->title) ?></h1>
                </div>

                <!-- Featured Image -->
                <?php if (isset($post->image_url) && $post->image_url): ?>
                    <div class="p-4 p-md-5">
                        <img src="<?= htmlspecialchars($post->image_url) ?>"
                            alt="<?= htmlspecialchars($post->title) ?>"
                            class="img-fluid rounded w-100 shadow"
                            style="max-height: 500px; object-fit: cover;">
                        <div class="text-center mt-3 text-muted">
                            <small class="fs-6"><i class="fas fa-image me-1"></i>Featured image</small>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Post Content -->
                <div class="card-body px-4 px-md-5 py-4 py-md-5">
                    <div class="post-content fs-6 fs-md-5 lh-lg">
                        <?= nl2br(htmlspecialchars($post->content)) ?>
                    </div>
                </div>

                <!-- Post Footer Actions -->
                <div class="card-footer bg-light py-4 px-4 px-md-5">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm px-3 fs-6">
                                <i class="fas fa-thumbs-up me-1"></i> Like
                            </button>
                            <button class="btn btn-outline-success btn-sm px-3 fs-6">
                                <i class="fas fa-share-alt me-1"></i> Share
                            </button>
                            <button class="btn btn-outline-info btn-sm px-3 fs-6">
                                <i class="fas fa-bookmark me-1"></i> Save
                            </button>
                        </div>
                        
                        <!-- Author Info -->
                        <?php if (isset($author_name)): ?>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-circle fa-2x fa-lg fa-md-2x text-secondary"></i>
                                </div>
                                <div class="fs-6 fs-md-base">
                                    <small class="text-muted d-block">Written by</small>
                                    <strong><?= htmlspecialchars($author_name) ?></strong>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Comment Section -->
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-white py-4 px-4 px-md-5">
                    <h3 class="mb-0 d-flex align-items-center fs-4 fs-md-3">
                        <i class="fas fa-comments me-3 text-primary"></i>
                        Comments
                        <span class="badge bg-primary ms-3 px-3 py-2 fs-6"><?= count($comments) ?></span>
                    </h3>
                </div>

                <!-- Comment Form -->
                <div class="card-body px-4 px-md-5 py-4 py-md-5">
                    <h5 class="mb-4 fs-5 fs-md-4">Add your comment</h5>
                    <form action="/posts/<?= $post->id ?>/comments" method="POST">
                        <?= csrf_token() ?>
                        <div class="mb-4">
                            <textarea class="form-control p-3 fs-6" 
                                      id="commentContent" 
                                      name="content" 
                                      rows="4" 
                                      placeholder="Share your thoughts about this post..." 
                                      required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 fs-6">
                                <i class="fas fa-paper-plane me-2"></i>Post Comment
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Comments List -->
                <div class="px-4 px-md-5 pb-4 pb-md-5">
                    <h5 class="mb-4 border-bottom pb-3 fs-5 fs-md-4">Recent Comments</h5>
                    
                    <?php if (empty($comments)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-comment-slash fa-3x fa-2x fa-md-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0 fs-6">No comments yet. Be the first to comment!</p>
                        </div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach($comments as $comment): ?>
                                <div class="col-12">
                                    <div class="card border-light shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="me-3">
                                                    <div class="bg-light rounded-circle p-2">
                                                        <i class="fas fa-user-circle fa-lg fa-md-lg text-secondary"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <div>
                                                            <h6 class="mb-0 fs-6"><?=$comment->name?></h6>
                                                            <small class="text-muted fs-6">
                                                                <i class="fas fa-clock me-1"></i>
                                                                <?= date('M j, Y \a\t g:i A', strtotime($comment->created_at)) ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 fs-6">
                                                        <?= nl2br(htmlspecialchars($comment->content)) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Actions -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
                <a href="/posts" class="btn btn-outline-secondary px-4 py-2 mb-2 fs-6">
                    <i class="fas fa-list me-2"></i>View All Posts
                </a>
                
                <div class="d-flex gap-2 mb-2">
                    <button class="btn btn-outline-dark px-3 py-2 fs-6">
                        <i class="fas fa-print me-1"></i> Print
                    </button>
                    <button class="btn btn-outline-dark px-3 py-2 fs-6">
                        <i class="fas fa-envelope me-1"></i> Email
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>