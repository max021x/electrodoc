<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Create New Post</h1>
            <p class="text-muted mb-0">Add a new blog post to your website</p>
        </div>
        <a href="/admin/posts" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Posts
        </a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form id="createPostForm" action="/admin/posts/store" method="POST" enctype="multipart/form-data">
            <!-- Title Field -->
            <div class="mb-3">
                <label for="postTitle" class="form-label fw-semibold">Post Title *</label>
                <input type="text" class="form-control" id="postTitle" name="title"
                       placeholder="Enter post title here..." required>
                <div class="form-text">The main title of your blog post</div>
            </div>

            <!-- Image Upload - Compact Version -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Featured Image</label>
                <div class="border rounded p-3 text-center bg-light">
                    <div id="imagePreview" class="d-none">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 80px; max-width: 120px;">
                                <div class="ms-3 text-start">
                                    <small class="text-muted d-block">Selected image</small>
                                    <small id="fileName"></small>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div id="imageUploadArea">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-image text-muted me-2"></i>
                            <div class="text-start">
                                <p class="mb-1 small">Upload featured image (optional)</p>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.getElementById('imageFile').click()">
                                    <i class="bi bi-upload"></i> Choose Image
                                </button>
                                <input type="file" id="imageFile" name="image" class="d-none" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-text small">Recommended size: 1200×600px</div>
            </div>

            <!-- Content Field - Smaller -->
            <div class="mb-3">
                <label for="postContent" class="form-label fw-semibold">Post Content *</label>
                <textarea class="form-control" id="postContent" name="content" rows="4" 
                          placeholder="Write your post content here..." required></textarea>
                <div class="form-text small">
                    Write your content clearly and engagingly
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="/admin/posts" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Publish Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview function
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            const fileName = document.getElementById('fileName');
            
            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreview');
                const imageUploadArea = document.getElementById('imageUploadArea');
                const img = imagePreview.querySelector('img');
                
                img.src = reader.result;
                fileName.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
                imagePreview.classList.remove('d-none');
                imageUploadArea.classList.add('d-none');
            };
            
            reader.readAsDataURL(file);
        }
    }

    // Remove image function
    function removeImage() {
        const imagePreview = document.getElementById('imagePreview');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const fileInput = document.getElementById('imageFile');
        
        imagePreview.classList.add('d-none');
        imageUploadArea.classList.remove('d-none');
        fileInput.value = '';
    }

    // Form submission with validation
    document.getElementById('createPostForm').addEventListener('submit', function(e) {
        const title = document.getElementById('postTitle').value.trim();
        const content = document.getElementById('postContent').value.trim();
        
        if (!title) {
            e.preventDefault();
            alert('Please enter a post title');
            document.getElementById('postTitle').focus();
            return;
        }
        
        if (!content) {
            e.preventDefault();
            alert('Please enter post content');
            document.getElementById('postContent').focus();
            return;
        }
        
        // Show loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Publishing...';
        submitBtn.disabled = true;
    });
</script>