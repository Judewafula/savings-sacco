<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dropdown Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-success">
        <div class="container">
            <a class="navbar-brand text-white" href="#">My App</a>

            <ul class="navbar-nav ms-auto">
                <!-- Menu Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="menuDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuDropdown">
                        <li><a class="dropdown-item" href="#">Sales List</a></li>
                        <li><a class="dropdown-item" href="#">Create Sale</a></li>
                        <li><a class="dropdown-item" href="#">Assets Inventory</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h1>Hello, dropdown test page!</h1>
    </div>

    <!-- Bootstrap JS (no defer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
