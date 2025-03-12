<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memomate - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style_homepage.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4">
                <img src="assets/logo.png" alt="Memomate Logo" width="50">
                <strong class="brand-name">Memomate</strong>
            </div>
            <div class="list-group list-group-flush">
                <a href="input_notes_page.php" class="btn btn-purple text-white m-3">+ Note-taking</a>
                <a href="home_page.php" class="list-group-item list-group-item-action active" style="margin-top: 50px;"><i class="bi bi-house-door"></i> Home</a>
                <a href="view_notes_page.php" class="list-group-item list-group-item-action"><i class="bi bi-journal-text"></i> Your Notes</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start" style="padding-left: 50px;">
                    <p class="lead"><strong>Memomate helps you organize and take notes efficiently. Start writing now to keep your thoughts structured.</strong></p>
                    <a href="input_notes_page.php" class="btn btn-lg btn-purple text-white">+ Note-taking</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="assets/homepage.png" alt="Homepage Illustration" class="img-fluid homepage-img">
                </div>
            </div>
        </div>
    </div>

</body>

</html>