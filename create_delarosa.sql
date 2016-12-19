CREATE DATABASE DELAROSA;
\c DELAROSA

/* Drop existing tables, just to be sure */
DROP TABLE Users;
DROP TABLE Products;
DROP TABLE Carts;
DROP TABLE Orders;

/* Drop extension(to be sure) & create extension for chkpass (storing encrypted passwords) */
DROP EXTENSION chkpass;
CREATE EXTENSION chkpass;

/* Create Users table  */
CREATE TABLE Users (
	userID VARCHAR (50) NOT NULL,
	userPass chkpass NOT NULL,
	userName VARCHAR (50) NOT NULL,
	userAddress VARCHAR (100) NOT NULL,
	userType VARCHAR (10) NOT NULL,		/* Regular or Admin */
	PRIMARY KEY (userID)
);

/* Create Products table  */
CREATE TABLE Products (
	productNumber INTEGER NOT NULL,
	productName VARCHAR (50) NOT NULL,
	productDescription TEXT NOT NULL,
	productStatus TEXT NOT NULL,
	productQuantity SMALLINT NOT NULL,
	productPrice NUMERIC NOT NULL,
	PRIMARY KEY (productNumber)
);

/* Create Carts table  */
CREATE TABLE Carts (
	cartNumber INTEGER NOT NULL,
	userID VARCHAR (50) NOT NULL,
	PRIMARY KEY (cartNumber)
);

/* Create Orders table */
CREATE TABLE Orders (
	orderNumber INTEGER NOT NULL,
	cartNumber INTEGER NOT NULL,
	productNumber INTEGER NOT NULL,
	orderQuantity SMALLINT NOT NULL,
	orderStatus VARCHAR (20) NOT NULL,	/* OK: CHECKOUT or NOT_OK: NOT YET CHECKOUT */
	orderDate TIMESTAMP NOT NULL,
	PRIMARY KEY (orderNumber)
);