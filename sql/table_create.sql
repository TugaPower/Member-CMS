﻿CREATE TABLE members (
	id            SMALLINT UNSIGNED PRIMARY KEY       NOT NULL AUTO_INCREMENT,
	username      VARCHAR(255)                        NOT NULL,
	password      VARCHAR(255)                        NOT NULL,
	last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	is_admin      TINYINT DEFAULT 0
);
CREATE UNIQUE INDEX id ON members (id);
CREATE TABLE news (
	id     SMALLINT UNSIGNED PRIMARY KEY       NOT NULL AUTO_INCREMENT,
	title  VARCHAR(255),
	body   LONGTEXT                            NOT NULL,
	date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	author VARCHAR(255)                        NOT NULL
);
CREATE UNIQUE INDEX id ON news (id);