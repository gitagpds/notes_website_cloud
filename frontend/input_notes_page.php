<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Taking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style_inputnotes.css">
    <style>
        #preview {
            min-height: 400px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
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
                <a href="home_page.php" class="list-group-item list-group-item-action" style="margin-top: 50px;"><i class="bi bi-house-door"></i> Home</a>
                <a href="view_notes_page.php" class="list-group-item list-group-item-action"><i class="bi bi-journal-text"></i> Your Notes</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4" id="note-taking">
            <div class="row">
                <!-- Preview Section -->
                <div class="col-md-6" id="note-preview">
                    <h2 id="preview-title" class="text-center"></h2>
                    <p id="preview-content" class="mt-3"></p>
                </div>

                <!-- Input Section -->
                <div class="col-md-6">
                    <form id="note-form">
                        <div class="mb-3">
                            <label for="title" class="form-label" style="font-weight: bold;">Judul</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label" style="font-weight: bold;">Notes</label>
                            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-purple w-100">Save</button>
                        <p id="message" class="text-center mt-3"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("title").addEventListener("input", function() {
            document.getElementById("preview-title").innerText = this.value;
        });

        document.getElementById("content").addEventListener("input", function() {
            document.getElementById("preview-content").innerText = this.value;
        });

        document.getElementById("note-form").addEventListener("submit", async function(event) {
            event.preventDefault();

            const title = document.getElementById("title").value;
            const content = document.getElementById("content").value;

            const response = await fetch("http://localhost:5000/add-note", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    title,
                    content
                })
            });

            const message = document.getElementById("message");
            if (response.ok) {
                message.innerText = "Catatan berhasil disimpan!";
                message.style.color = "green";
                document.getElementById("note-form").reset();
                document.getElementById("preview-title").innerText = "";
                document.getElementById("preview-content").innerText = "";
            } else {
                message.innerText = "Gagal menyimpan catatan.";
                message.style.color = "red";
            }
        });
    </script>
</body>

</html>