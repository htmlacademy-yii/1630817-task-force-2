CREATE DATABASE TaskForce
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE TaskForce;


CREATE TABLE users
(
    id                        INT AUTO_INCREMENT PRIMARY KEY,
    registration_date         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email                     VARCHAR(128) NOT NULL UNIQUE,
    login                     VARCHAR(128) UNIQUE,
    password                  CHAR(64) NOT NULL,
    avatar                    VARCHAR(255),
    user_role                 VARCHAR(255),
    rating                    float,
    count_of_completed_tasks  int
);

CREATE TABLE statuses
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(128)
);


CREATE TABLE categories
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(128)
);

CREATE TABLE addresses
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    city        VARCHAR(255),
    district    VARCHAR(255),
    street      VARCHAR(255),
    longitude   float,
    latitude    float
);

CREATE TABLE tasks
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(128),
    description     TEXT,
    category_id     INT,
    author_id       INT,
    status_id       INT,
    link            VARCHAR(255),
    payment         float,
    file            VARCHAR(255),
    creation_date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    finish_date     TIMESTAMP,
    location_id     INT,
    FOREIGN KEY (author_id) REFERENCES users (id),
    FOREIGN KEY (status_id) REFERENCES statuses (id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (location_id) REFERENCES addresses(id)
);


CREATE TABLE tasks_responses
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    candidate       INT,
    approved        TINYINT(1),
    task_id         INT,
    FOREIGN KEY (task_id) REFERENCES tasks (id),
    FOREIGN KEY (candidate) REFERENCES users (id)
);

CREATE TABLE user_addresses
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    address_id     INT,
    users_id       INT,
    FOREIGN KEY (users_id) REFERENCES users (id),
    FOREIGN KEY (address_id) REFERENCES addresses (id)
);


CREATE INDEX u_mail ON users (email);
CREATE INDEX u_login ON users (login);
CREATE INDEX task_title ON tasks (title);
CREATE INDEX task_author ON tasks (title);
CREATE INDEX task_id ON tasks_responses (task_id);
CREATE INDEX user_id ON user_addresses (users_id);
CREATE FULLTEXT INDEX task_search ON tasks (title, description);