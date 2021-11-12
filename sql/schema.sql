CREATE DATABASE TaskForce
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE TaskForce;


CREATE TABLE user
(
    id                        INT AUTO_INCREMENT PRIMARY KEY,
    email                     VARCHAR(128) NOT NULL UNIQUE,
    login                     VARCHAR(128) NOT NULL UNIQUE,
    password                  CHAR(64) NOT NULL,
    avatar                    VARCHAR(255),
    created_at                TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at                TIMESTAMP 
);


CREATE TABLE role
(
    id                      INT AUTO_INCREMENT PRIMARY KEY,
    name                    VARCHAR(255)
);


CREATE TABLE user_role
(
    id                      INT AUTO_INCREMENT PRIMARY KEY,
    role_id                 INT,
    user_id                 INT,
    created_at              TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (role_id) REFERENCES role (id)

);


CREATE TABLE status
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(128),
    code         VARCHAR(128)

);


CREATE TABLE category
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(128)
);

CREATE TABLE address
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    city        VARCHAR(255),
    district    VARCHAR(255),
    street      VARCHAR(255),
    longitude   float,
    latitude    float
);

CREATE TABLE task
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(128),
    description     TEXT,
    category_id     INT,
    author_id       INT,
    status_id       INT,
    payment         float,
    file            VARCHAR(255),
    end_date        TIMESTAMP,
    location_id     INT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES user (id),
    FOREIGN KEY (status_id) REFERENCES status (id),
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (location_id) REFERENCES address(id)
);


CREATE TABLE task_response
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id    INT,
    approved        TINYINT,
    task_id         INT,
    FOREIGN KEY (task_id) REFERENCES task (id),
    FOREIGN KEY (candidate_id) REFERENCES user (id)
);

CREATE TABLE user_address
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    address_id     INT,
    user_id       INT,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (address_id) REFERENCES address (id)
);

CREATE TABLE review
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    description    TEXT,
    task_id        INT,
    raiting        FLOAT,
    FOREIGN KEY (task_id) REFERENCES task (id)

);



CREATE INDEX u_mail ON user (email);
CREATE INDEX u_login ON user (login);
CREATE INDEX task_title ON task (title);
CREATE INDEX task_author ON task (title);
CREATE INDEX task_id ON task_response (task_id);
CREATE INDEX user_id ON user_address (user_id);
CREATE FULLTEXT INDEX task_search ON task (title, description);