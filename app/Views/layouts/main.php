<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Shop</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fontawesome.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <!--  -->
    <nav class="navbar navbar-expand-md bg-white fixed-top <?= isset($dnone) ? 'd-none' : ''?>">
        <div class="container-md">

            <a class="navbar-brand" href="#"><img class="img-fluid" alt="">ElectroShop</a>

            <!-- search box in center -->
            <div class="d-none d-lg-flex flex-grow-1 justify-content-center mx-3">
                <div class="input-group w-75">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- sidebar toggle button -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#electroNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- sidebar nav -->
            <div class="offcanvas offcanvas-end" id="electroNav">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link"><i class="fas fa-moon"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link"><i class="fab fa-github" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item d-md-none">
                            <hr>
                            <form action="">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="text" placeholder="Search" class="form-control">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?= $content ?>
    </main>


    <footer class="footer bg-light py-6 <?= isset($dnone) ? 'd-none' : ''?>">
        <div class="container">
            <div class="row">
                <div class="col-md-4 my-3">
                    <h6>About Yavin</h6>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Molestiae, possimus! Similique asperiores aliquid accusantium
                        laudantium.
                    </p>
                </div>
                <div class="col-md-4 my-3">
                    <h6>Links</h6>
                    <ul class="list-unstyled">
                        <li>
                            Important: <a href="#">Terms & Conditions</a>,
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li>
                            Useful: <a href="#">Icon Library</a>,
                            <a href="#">Illustrations</a>
                        </li>
                        <li>
                            Menu: <a href="#">Home</a>, <a href="#details">Details</a>,
                            <a href="#services">Services</a>, <a href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 my-3">
                    <div class="mb-4">
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-facebook fa-3x text-dark mx-2"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-twitter fa-3x text-dark mx-2"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-instagram fa-3x text-dark mx-2"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-pinterest fa-3x text-dark mx-2"></i>
                        </a>
                    </div>
                    <p>
                        We would love to hear from you
                        <a href="mailto:contact@site.com"><strong>contact@site.com</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>