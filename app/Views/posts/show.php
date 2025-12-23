<div class="container py-4 my-7">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <!-- Title Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h1 class="card-title mb-3"><?= htmlspecialchars($post->title) ?></h1>

                    <!-- Meta Information -->
                    <div class="d-flex flex-wrap gap-3 text-muted mb-0">
                        <?php if (isset($post->created_at)): ?>
                            <div>
                                <i class="fas fa-calendar-alt me-1"></i>
                                <?= date('M j, Y', strtotime($post->created_at)) ?>
                            </div>
                        <?php endif; ?>

                        <div>
                            <i class="fas fa-eye me-1"></i>
                            <?= number_format($post->views) ?> views
                        </div>

                        <?php if (isset($post->category_name)): ?>
                            <div>
                                <span class="badge bg-secondary">
                                    <?= htmlspecialchars($post->category_name) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Featured Image Card -->
            <?php if (isset($post->image_url) && $post->image_url): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <img src="/images/electronic-car-2.jpg"
                            alt="<?= htmlspecialchars($post->title) ?>"
                            class="img-fluid rounded-top w-100">
                    </div>
                </div>
            <?php endif; ?>

            <!-- Content Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="lead">
                        <?= nl2br(htmlspecialchars($post->content)) ?>
                    </div>
                </div>
            </div>

            <!-- Optional: Author Card -->
            <?php if (isset($author_name)): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Author</h6>
                                <p class="mb-0 text-muted"><?= htmlspecialchars($author_name) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Comment Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Comments (<?= count($comments) ?>)</h5>
                    
                    <!-- Comment Form -->
                    <div class="mb-5">
                        <form action="/posts/<?= $post->id ?>/comments" method="POST">
                            <?=csrf_token() ?>
                            <div class="mb-3">
                                <label for="commentContent" class="form-label fw-semibold">Leave a Comment</label>
                                <textarea class="form-control" id="commentContent" name="content" rows="4" 
                                          placeholder="Write your comment here..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Comment
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Comments List -->
                    <div class="mt-4">
                        <h6 class="border-bottom pb-2 mb-4">Recent Comments</h6>
                        
                        <?php if (empty($comments)): ?>
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-comment-slash fa-2x mb-3"></i>
                                <p class="mb-0">No comments yet. Be the first to comment!</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-3" id="comments">
                                <?php foreach($comments as $comment): ?>
                                    <div class="col-12">
                                        <div class="card border-light shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <i class="fas fa-user-circle fa-lg text-secondary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Anonymous User</h6>
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock me-1"></i>
                                                                <?= date('M j, Y \a\t g:i A', strtotime($comment->created_at)) ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="card-text mt-3 mb-0">
                                                    <?= nl2br(htmlspecialchars($comment->content)) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Navigation Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <a href="/posts" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Posts
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>