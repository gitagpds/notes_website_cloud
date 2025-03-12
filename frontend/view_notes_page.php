<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style_inputnotes.css">
</head>
<body>
    <div class="d-flex">
        <div class="bg-light border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4">
                <img src="assets/logo.png" alt="Memomate Logo" width="50">
                <strong class="brand-name">Memomate</strong>
            </div>
            <div class="list-group list-group-flush">
                <a href="input_notes_page.php" class="btn btn-purple text-white m-3">+ Note-taking</a>
                <a href="home_page.php" class="list-group-item list-group-item-action" style="margin-top: 50px;">
                    <i class="bi bi-house-door"></i> Home
                </a>
                <a href="view_notes_page.php" class="list-group-item list-group-item-action active">
                    <i class="bi bi-journal-text"></i> Your Notes
                </a>
            </div>
        </div>

        <div class="container-fluid p-4">
            <h2 class="text-center mb-4">YOUR NOTES</h2>
            <div class="row" id="notes-container"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("http://localhost:5000/notes")
                .then(response => response.json())
                .then(data => {
                    const notesContainer = document.getElementById("notes-container");
                    notesContainer.innerHTML = "";
                    data.forEach(note => {
                        const noteElement = document.createElement("div");
                        noteElement.classList.add("col-md-3", "mb-3");
                        noteElement.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${note.title}</h5>
                                <p class="card-text">${note.content.substring(0, 50)}...</p>
                                <button class="btn btn-sm btn-primary view-btn" data-id="${note.id}">
                                    <i class="bi bi-eye-fill"></i> View
                                </button>
                                <button class="btn btn-sm btn-warning edit-btn" data-id="${note.id}">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${note.id}">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </div>
                        </div>
                    `;
                        notesContainer.appendChild(noteElement);
                    });
                });

            document.addEventListener("click", function(event) {
                const target = event.target.closest("button");
                if (!target) return;
                const noteId = target.dataset.id;

                // Fitur View Note
                if (target.classList.contains("view-btn")) {
                    fetch(`http://localhost:5000/notes/${noteId}`)
                        .then(response => response.json())
                        .then(note => {
                            showModal("View Note", `
                                <h4>${note.title}</h4>
                                <hr>
                                <p style="white-space: pre-wrap;">${note.content}</p>
                            `);
                        });
                }

                // Fitur Edit Note
                if (target.classList.contains("edit-btn")) {
                    fetch(`http://localhost:5000/notes/${noteId}`)
                        .then(response => response.json())
                        .then(note => {
                            showModal("Edit Note", `
                                <input type="hidden" id="edit-note-id" value="${note.id}">
                                <div class="mb-2">
                                    <label>Title</label>
                                    <input type="text" id="edit-note-title" class="form-control" value="${note.title}">
                                </div>
                                <div class="mb-2">
                                    <label>Content</label>
                                    <textarea id="edit-note-content" class="form-control" style="height: 300px;">${note.content}</textarea>
                                </div>
                                <button class="btn btn-success" id="save-note">Save</button>
                            `, true);

                            document.getElementById("save-note").addEventListener("click", function() {
                                const updatedNote = {
                                    title: document.getElementById("edit-note-title").value,
                                    content: document.getElementById("edit-note-content").value
                                };

                                fetch(`http://localhost:5000/edit-note/${noteId}`, {
                                    method: "PUT",
                                    headers: {
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify(updatedNote)
                                })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.message === "Note updated successfully") {
                                        closeModal();
                                        location.reload();
                                    } else {
                                        alert("Failed to update note.");
                                    }
                                });
                            });
                        });
                }

                // Fitur Delete Note
                if (target.classList.contains("delete-btn")) {
                    if (confirm("Are you sure you want to delete this note?")) {
                        fetch(`http://localhost:5000/delete-note/${noteId}`, { method: "DELETE" })
                            .then(() => location.reload())
                            .catch(error => console.error("Error deleting note:", error));
                    }
                }
            });
        });

        // Fungsi Menampilkan Modal
        function showModal(title, body) {
            let oldModal = document.getElementById("dynamic-modal");
            if (oldModal) {
                oldModal.remove();
            }

            let modal = document.createElement("div");
            modal.id = "dynamic-modal";
            modal.classList.add("modal", "fade");
            modal.innerHTML = `
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${title}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">${body}</div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            let bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        }

        // Fungsi Menutup Modal
        function closeModal() {
            let modal = document.getElementById("dynamic-modal");
            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                bootstrapModal.hide();
                modal.remove();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
