<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin-dashboard.css')}}">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            width: 250px;
            background-color: #343a40;
            overflow-x: hidden;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content.full-width {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .menu-toggle {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 101;
        }
    </style>

    <body>
        <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 bg-dark sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#dashboard">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#members">
                                <span data-feather="users"></span>
                                Manage Members
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#books">
                                <span data-feather="book"></span>
                                Manage Books
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#loans">
                                <span data-feather="file"></span>
                                Manage Loans
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#returns">
                                <span data-feather="check-circle"></span>
                                Manage Returns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#categories">
                                <span data-feather="tag"></span>
                                Manage Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#staff">
                                <span data-feather="user"></span>
                                Manage Staff
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                <button class="btn btn-primary d-md-none menu-toggle">☰</button>
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Profile</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Login</button>
                        </div>
                    </div>
                </div>

                <div id="dashboard" class="mb-4">
                    <h2>Overview</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">
                                    <span data-feather="users" class="mr-2"></span> Members
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Total: 120</h5>
                                    <p class="card-text">Active Members</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">
                                    <span data-feather="book" class="mr-2"></span> Books
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Total: 450</h5>
                                    <p class="card-text">Available Books</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header">
                                    <span data-feather="file-text" class="mr-2"></span> Loans
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Active: 85</h5>
                                    <p class="card-text">Books on Loan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">
                                    <span data-feather="clock" class="mr-2"></span> Returns
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Overdue: 5</h5>
                                    <p class="card-text">Overdue Books</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="members" class="mt-5">
                    <h2>Manage Members</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Member data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="books" class="mt-5">
                    <h2>Manage Books</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Year</th>
                                    <th>ISBN</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Book data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="loans" class="mt-5">
                    <h2>Manage Loans</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member Name</th>
                                    <th>Book Title</th>
                                    <th>Loan Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loan data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="returns" class="mt-5">
                    <h2>Manage Returns</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loan ID</th>
                                    <th>Return Date</th>
                                    <th>Fine</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Return data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="categories" class="mt-5">
                    <h2>Manage Categories</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Category data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="staff" class="mt-5">
                    <h2>Manage Staff</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Staff data will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();

        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('open');
        });
    </script>
    </body>
</html>
