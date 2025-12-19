import 'dotenv/config';
import express from 'express';
import path from "path";
import { fileURLToPath } from "url";
import cors from 'cors';
import { connectDB } from './db.js';
import signupRouter from './routes/signup.js';
import authRoutes from "./routes/auth.js";
import participantsRouter from "./routes/participants.js";

const app = express();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// middleware
app.use(cors({ origin: process.env.ALLOWED_ORIGIN }));
app.use(express.json());

// routes
app.use("/auth", authRoutes);
app.use('/api/signup', signupRouter);
app.use("/api/participants", participantsRouter);


// ⭐ 前端靜態檔案（一定要在 404 前）
app.use(express.static(path.join(__dirname, "../client")));

// 404
app.use((req, res) => {
  res.status(404).json({ error: 'Not Found' });
});

// error handler
app.use((err, req, res, next) => {
  console.error(err);
  res.status(500).json({ error: 'Server Error' });
});

const port = process.env.PORT || 3001;

connectDB()
  .then(() => {
    app.listen(port, () => {
      console.log(`Server running on http://localhost:${port}`);
    });
  })
  .catch((error) => {
    console.error('Failed to connect MongoDB', error);
    process.exit(1);
  });
