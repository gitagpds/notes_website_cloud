import { Sequelize } from "sequelize";

const db = new Sequelize("notes_db", "root", "gita123", {
    host: "34.173.109.51",
    dialect: "mysql"

})

export default db;