<div class="admin-header">
    <h1 class="h3 mb-0">Dashboard</h1>
    <p class="text-muted mb-0">Welcome to your weblog admin panel</p>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Admin Routes</h5>
                <p class="card-text">Your current admin routes:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <code>GET /admin/dashboard</code>
                        <span class="badge bg-primary">DashboardController@index</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <code>GET /admin/posts</code>
                        <span class="badge bg-primary">DashboardController@posts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <code>GET /admin/posts/create</code>
                        <span class="badge bg-primary">DashboardController@create</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <code>GET /admin/{post}/edit</code>
                        <span class="badge bg-primary">DashboardController@edit</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <p class="card-text">Navigate to different sections of your admin panel using the sidebar.</p>
                <div class="d-grid gap-2">
                    <a href="/admin/posts" class="btn btn-outline-primary">View All Posts</a>
                    <a href="/admin/posts/create" class="btn btn-primary">Create New Post</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="alert alert-info">
        <h6>Note about the Edit Post route:</h6>
        <p class="mb-0">The <code>/admin/{post}/edit</code> route requires a post ID parameter. You'll need to navigate to this route with a specific post ID (e.g., <code>/admin/5/edit</code>) to edit a post.</p>
    </div>
</div>