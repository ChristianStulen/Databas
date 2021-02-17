--
-- Uppgift 2
-- Skapa databaser med SQL
--

-- Skapa en databas
CREATE DATABASE webshop
CHARACTER SET utf8
COLLATE utf8_swedish_ci;

-- Skapa tabellen Customers
CREATE TABLE Customers(
    customerid INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    str_address VARCHAR(50) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    city VARCHAR(50) NOT NULL,
    tel VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (customerid)
);

-- Skapa tabellen Products
CREATE TABLE Products(
    productid INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
    in_stock INT NOT NULL,
    PRIMARY KEY (productid)
);

-- Skapa tabellen Orders
CREATE TABLE Orders(
    orderid INT NOT NULL AUTO_INCREMENT,
    productid INT NOT NULL,
    customerid INT NOT NULL,
    ordertime DATETIME NOT NULL,
    PRIMARY KEY (orderid)
);

-- Sätt främmande nycklar
ALTER TABLE Orders
ADD FOREIGN KEY (customerid) 
REFERENCES customers(customerid) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT; 

ALTER TABLE Orders 
ADD FOREIGN KEY (productid) 
REFERENCES products(productid) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;