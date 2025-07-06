CREATE TABLE books (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL
);
INSERT INTO books (title) VALUES
  ('The Great Gatsby'),
  ('To Kill a Mockingbird'),
  ('1984'),
  ('Pride and Prejudice'),
  ('SQL Injection for Dummies');

CREATE TABLE users (
  username TEXT PRIMARY KEY,
  password TEXT NOT NULL,
  role TEXT NOT NULL
);
INSERT INTO users (username, password, role) VALUES
  ('normal','library123','normal'),
  ('admin','admin123','admin');
