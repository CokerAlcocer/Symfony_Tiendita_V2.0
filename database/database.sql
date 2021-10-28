CREATE DATABASE tiendita;
USE tiendita;

CREATE TABLE products(
    idProduct INT AUTO_INCREMENT,
    name VARCHAR(1290) NOT NULL,
    precio DECIMAL(7,2) NOT NULL,
    status INT NOT NULL,
    CONSTRAINT pk_products_id PRIMARY KEY(idProduct)
);

INSERT INTO products(name, precio, status) VALUES ('Doritos', 13, 1);
INSERT INTO products(name, precio, status) VALUES ('Sabritas', 15, 1);
INSERT INTO products(name, precio, status) VALUES ('Emperador', 16.50, 1);
INSERT INTO products(name, precio, status) VALUES ('Coca Cola 3L', 30, 1);
INSERT INTO products(name, precio, status) VALUES ('Red Cola 3L', 27.50, 1);