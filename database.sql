CREATE DATABASE mitiendita;
USE mitiendita;

CREATE TABLE products(
    idProduct INT AUTO_INCREMENT,
    name VARCHAR(1290) NOT NULL,
    precio DECIMAL(7,2) NOT NULL,
    status INT NOT NULL,
    CONSTRAINT pk_products_id PRIMARY KEY(idProduct)
);