// server/routes/signup.js
import express from 'express';
import {
  createParticipant,
  findAll,
  findByOwner,
  findById,
  deleteParticipant
} from '../repositories/participants.js';
import { authMiddleware } from '../middleware/auth.js';

const router = express.Router();

/**
 * 所有 /api/signup 都必須登入
 */
router.use(authMiddleware);

/**
 * POST /api/signup
 * 建立資料時記錄 ownerId
 */
router.post('/', async (req, res, next) => {
  try {
    const { name, email, phone } = req.body;
    if (!name || !email || !phone) {
      return res.status(400).json({ error: '缺少必要欄位' });
    }

    const id = await createParticipant({
      name,
      email,
      phone,
      ownerId: req.user.id  
    });

    res.status(201).json({ id });
  } catch (error) {
    if (error.code === 11000) {
      return res.status(400).json({ error: 'Email 已經被使用過' });
    }
    next(error);
  }
});

/**
 * GET /api/signup
 * admin：全部
 * student：只看自己
 */
router.get('/', async (req, res, next) => {
  try {
    let data;

    if (req.user.role === 'admin') {
      data = await findAll();
    } else {
      data = await findByOwner(req.user.id);
    }

    res.json({
      total: data.length,
      data
    });
  } catch (error) {
    next(error);
  }
});

/**
 * DELETE /api/signup/:id
 * 只能刪自己 or admin
 */
router.delete('/:id', async (req, res, next) => {
  try {
    const doc = await findById(req.params.id);
    if (!doc) {
      return res.status(404).json({ error: '找不到資料' });
    }

    if (req.user.role !== 'admin' && doc.ownerId !== req.user.id) {
      return res.status(403).json({ error: '權限不足' });
    }

    await deleteParticipant(req.params.id);
    res.json({ message: '刪除完成' });
  } catch (error) {
    next(error);
  }
});

export default router;
