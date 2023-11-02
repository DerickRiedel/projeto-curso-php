/* Lógico_1: */

CREATE TABLE userlogin (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    password VARCHAR(50),
    create_date DATE,
    email VARCHAR(50),
    sector VARCHAR(50)
);

CREATE TABLE tech (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    password VARCHAR(50),
    create_date DATE,
    email VARCHAR(50)
);

CREATE TABLE team (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    description VARCHAR(1024),
    create_date DATE
);

CREATE TABLE ticket (
    id INT PRIMARY KEY,
    subject VARCHAR(50),
    description VARCHAR(2048),
    create_date DATE,
    modified_date DATE,
    complete_date DATE,
    status CHAR,
    fk_userlogin_id INT,
    fk_category_id SERIAL
);

CREATE TABLE item (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    description VARCHAR(1024),
    value FLOAT,
    create_date DATE,
    count INT
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50),
    description VARCHAR(1024),
    has_item BOOL
);

CREATE TABLE ticket_item (
    fk_ticket_id INT,
    fk_item_id INT,
    id SERIAL PRIMARY KEY,
    loan_date DATE,
    devol_date DATE,
    count INT,
    pending INT,
    loaded INT
);

CREATE TABLE tech_team (
    fk_team_id INT,
    fk_tech_id INT
);

CREATE TABLE team_category (
    fk_category_id SERIAL,
    fk_team_id INT
);

CREATE TABLE message (
    fk_tech_id INT,
    fk_ticket_id INT,
    seq SERIAL PRIMARY KEY,
    description VARCHAR(2048)
);
 
ALTER TABLE ticket ADD CONSTRAINT FK_ticket_2
    FOREIGN KEY (fk_userlogin_id)
    REFERENCES userlogin (id)
    ON DELETE CASCADE;
 
ALTER TABLE ticket ADD CONSTRAINT FK_ticket_3
    FOREIGN KEY (fk_category_id)
    REFERENCES category (id)
    ON DELETE CASCADE;
 
ALTER TABLE ticket_item ADD CONSTRAINT FK_ticket_item_2
    FOREIGN KEY (fk_ticket_id)
    REFERENCES ticket (id)
    ON DELETE SET NULL;
 
ALTER TABLE ticket_item ADD CONSTRAINT FK_ticket_item_3
    FOREIGN KEY (fk_item_id)
    REFERENCES item (id)
    ON DELETE SET NULL;
 
ALTER TABLE tech_team ADD CONSTRAINT FK_tech_team_1
    FOREIGN KEY (fk_team_id)
    REFERENCES team (id)
    ON DELETE RESTRICT;
 
ALTER TABLE tech_team ADD CONSTRAINT FK_tech_team_2
    FOREIGN KEY (fk_tech_id)
    REFERENCES tech (id)
    ON DELETE RESTRICT;
 
ALTER TABLE team_category ADD CONSTRAINT FK_team_category_1
    FOREIGN KEY (fk_category_id)
    REFERENCES category (id)
    ON DELETE RESTRICT;
 
ALTER TABLE team_category ADD CONSTRAINT FK_team_category_2
    FOREIGN KEY (fk_team_id)
    REFERENCES team (id)
    ON DELETE SET NULL;
 
ALTER TABLE message ADD CONSTRAINT FK_message_2
    FOREIGN KEY (fk_tech_id)
    REFERENCES tech (id)
    ON DELETE SET NULL;
 
ALTER TABLE message ADD CONSTRAINT FK_message_3
    FOREIGN KEY (fk_ticket_id)
    REFERENCES ticket (id)
    ON DELETE SET NULL;