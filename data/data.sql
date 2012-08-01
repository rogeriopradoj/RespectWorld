PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE "books" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "title" TEXT NOT NULL,
    "author" TEXT NOT NULL,
    "summary" TEXT
);
INSERT INTO "books" VALUES(1,'Three Musketeers','Alexander Dumas','Three Musketeers');
INSERT INTO "books" VALUES(2,'Meditations','Marcus','Meditations');
DELETE FROM sqlite_sequence;
INSERT INTO "sqlite_sequence" VALUES('books',2);
COMMIT;
