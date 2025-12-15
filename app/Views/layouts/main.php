<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Shop</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <!--  -->
    <nav class="navbar navbar-expand-md bg-body-tertiary fixed-top">
        <div class="container-md">

            <a class="navbar-brand" href="#">Logo</a>

            <!-- search box in center -->
            <div class="d-none d-lg-flex flex-grow-1 justify-content-center mx-3">
                <div class="input-group w-50">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <!-- sidebar toggle button -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#electroNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <!-- sidebar nav -->
        <div class="offcanvas offcanvas-end" id="electroNav">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Feedback</a>
                        </li>
                        <li class="nav-item d-md-none">
                            <hr>
                            <form action="">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="text" placeholder="Search" class="form-control">
                                    <button class="btn btn-primary"><span class="bi bi-search"></span></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <header class="hero">



    
    </header>



    <main>
        <?= $content ?>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>