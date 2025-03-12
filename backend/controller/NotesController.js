import Note from "../models/NotesModel.js";

// GET
async function getNotes(req, res) {
  try {
    const result = await Note.findAll();
    res.status(200).json(result);
  } catch (error) {
    console.log(error.message);
  }
}

// POST
async function createNote(req, res) {
  try {
    const inputResult = req.body;
    const newNote = await Note.create(inputResult);
    res.status(201).json(newNote);
  } catch (error) {
    console.log(error.message);
  }
}

// PUT/PATCH
async function updateNote(req, res) {
  try {
    const { id } = req.params;
    const updateInput = req.body;
    const note = await Note.findByPk(id);
    
    if (!note) {
      return res.status(404).json({ message: "Note not found" });
    }

    await Note.update(updateInput, { where: { id } });
    res.status(200).json({ message: "Note updated successfully" });
  } catch (error) {
    console.log(error.message);
    res.status(500).json({ message: "Error updating note" });
  }
}


// DELETE
async function deleteNote(req, res) {
  try {
    const { id } = req.params;
    const note = await Note.findByPk(id);

    if (!note) {
      return res.status(404).json({ message: "Note not found" });
    }

    await Note.destroy({ where: { id } });
    res.status(200).json({ message: "Note deleted successfully" });
  } catch (error) {
    console.log(error.message);
  }
}

// GET NOTE BY ID
async function getNoteById(req, res) {
  try {
      const { id } = req.params;
      const note = await Note.findByPk(id);
      if (!note) {
          return res.status(404).json({ message: "Note not found" });
      }
      res.status(200).json(note);
  } catch (error) {
      console.log(error.message);
  }
}

export { getNotes, createNote, updateNote, deleteNote, getNoteById };