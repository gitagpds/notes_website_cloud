import express from "express";
import { createNote, deleteNote, getNotes, updateNote, getNoteById } from "../controller/NotesController.js";

const router = express.Router();

router.get("/notes", getNotes);
router.post("/add-note", createNote);
router.put("/edit-note/:id", updateNote);
router.delete("/delete-note/:id", deleteNote);
router.get("/notes/:id", getNoteById);

export default router;