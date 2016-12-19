\c classicmodels
/* Load records into the tables */

/*********************************

copy users FROM 'Users.csv' with delimiter as ',' csv;
copy products FROM 'Products.csv' with delimiter as ',' csv;
copy carts FROM 'Carts.csv' with delimiter as ',' csv;
copy orders FROM 'Orders.csv' with delimiter as ',' csv;


SAMPLE USERS, PASSWORDS:
	admin, 1234
	user1, pass1
	user2, pass2
	user3, pass3

*********************************/

/* Users */
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('admin','1234','Administrator','Metro Manila','admin');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user1','pass1','User1','Quezon City','regular');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user2','pass2','User2','Fairview','regular');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user3','pass3','User3','Caloocan City','regular');

/* Products */
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (1,'Sticker1','Very cute sticker 2x2 waterproof','Available',20,10.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (2,'Sticker2','Amazing design sticker 2x2 clear transparent easy to remove','Available',10,15.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (3,'Sticker3','Cool design sticker 5 inches square on matte paper','Available',10,20.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (4,'Relatable Sticker','Express yourself with these relatable stickers','Available',5,15.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (5,'Motivation','Very in demand so order now!','Out of stock',0,25.00);

/* Carts */
INSERT INTO Carts (cartNumber, userID) VALUES (0, 'admin');
INSERT INTO Carts (cartNumber, userID) VALUES (1, 'user1');
INSERT INTO Carts (cartNumber, userID) VALUES (2, 'user2');
INSERT INTO Carts (cartNumber, userID) VALUES (3, 'user3');

/* Orders */
INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES (1,1,1,2,'NOT OK','2016-12-07 04:19:51.988843');
INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES (2,2,2,1,'NOT OK','2016-12-07 04:20:06.142867');
INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES (3,3,1,1,'NOT OK','2016-12-07 05:20:06.143485');
INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES (4,1,3,2,'OK','2016-12-07 05:20:07.100000');
INSERT INTO Orders (orderNumber, cartNumber, productNumber, orderQuantity, orderStatus, orderDate) VALUES (5,2,3,1,'OK','2016-12-07 06:30:06.142867');
