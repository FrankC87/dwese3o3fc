DROP DATABASE IF EXISTS sero3fjcr;
CREATE DATABASE sero3fjcr CHARACTER SET utf8 COLLATE utf8_spanish_ci;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  nick VARCHAR(100) NOT NULL,
  pass VARCHAR(100) NOT NULL,
  CONSTRAINT PK_users PRIMARY KEY (nick)
);

CREATE TABLE movimientos(
  id SERIAL,
  nick VARCHAR(100),
  fecha DATE  NOT NULL,
  descripcion VARCHAR(1000) NOT NULL,
  cantidad DECIMAL(10,2) DEFAULT 0,
  tipo VARCHAR(100),
  CONSTRAINT PK_ing PRIMARY KEY (id),
  CONSTRAINT FK_ing_u FOREIGN KEY (nick) REFERENCES users(nick)
);

