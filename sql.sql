DROP TABLE IF EXISTS sanatorium, service, procedure;

CREATE TABLE sanatorium (
    ID SERIAL PRIMARY KEY,
    name CHAR(40) NOT NULL,
    mail CHAR(30) NOT NULL,
    telephone CHAR(20) NOT NULL,
    address CHAR(100) NOT NULL
);

CREATE TABLE service (
    ID SERIAL PRIMARY KEY,
    sanatorium_id int not null,
    name CHAR(40) NOT NULL,
    cost INT,
    FOREIGN KEY (sanatorium_id) REFERENCES sanatorium (ID) ON DELETE CASCADE
);

CREATE TABLE procedure (
    ID SERIAL PRIMARY KEY,
    service_id INT NOT NULL,
    description TEXT,
    duration_min INT,
    FOREIGN KEY (service_id) REFERENCES service (ID) ON DELETE CASCADE
);