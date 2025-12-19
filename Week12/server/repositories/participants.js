import { ObjectId } from "mongodb";
import { getDB } from "../db.js";

const collection = () => getDB().collection("participants");

/* 建立 */
export async function createParticipant(data) {
  const result = await collection().insertOne({
    ...data,
    createdAt: new Date(),
    updatedAt: new Date(),
  });
  return result.insertedId;
}

/* admin：全部 */
export async function findAll() {
  return collection().find().toArray();
}

/* student：只看自己的 */
export async function findByOwner(ownerId) {
  return collection()
    .find({ ownerId: new ObjectId(ownerId) })
    .toArray();
}

/* 找單筆（刪除用） */
export async function findById(id) {
  return collection().findOne({ _id: new ObjectId(id) });
}

/* 刪除 */
export async function deleteParticipant(id) {
  return collection().deleteOne({ _id: new ObjectId(id) });
}
