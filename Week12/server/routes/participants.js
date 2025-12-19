import express from "express";
import {
  findAll,
  findByOwner,
  findById,
  createParticipant,
  deleteParticipant
} from "../repositories/participants.js";
import { authMiddleware } from "../middleware/auth.js";

const router = express.Router();

/**
 * GET /api/participants
 * student → 只看自己的
 * admin   → 看全部
 */
router.get("/", authMiddleware, async (req, res) => {
  try {
    let items;

    if (req.user.role === "admin") {
      items = await findAll();
    } else {
      items = await findByOwner(req.user.id);
    }

    res.json({ items });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "Failed to load participants" });
  }
});
/**
 * DELETE /api/participants/:id
 * owner 或 admin 才能刪
 */
router.delete("/:id", authMiddleware, async (req, res) => {
  try {
    const target = await findById(req.params.id);

    if (!target) {
      return res.status(404).json({ error: "資料不存在" });
    }

    const isOwner = target.ownerId.toString() === req.user.id;
    const isAdmin = req.user.role === "admin";

    if (!isOwner && !isAdmin) {
      return res.status(403).json({ error: "權限不足" });
    }

    await deleteParticipant(req.params.id);
    res.json({ success: true });

  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "刪除失敗" });
  }
});

/**
 * POST /api/participants
 * 登入才能新增，ownerId 紀錄建立者
 */
router.post("/", authMiddleware, async (req, res) => {
  try {
    const result = await createParticipant({
      ...req.body,
      ownerId: req.user.id,
    });

    res.status(201).json({ id: result });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: "新增失敗" });
  }
});

export default router;
