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
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('admin','e0zgt1l4aS/Zk','Administrator','Metro Manila','admin');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user1','7Hz2HJSCW65AI','User1','Quezon City','regular');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user2','NeM//a51Jof1w','User2','Fairview','regular');
INSERT INTO Users (userID, userPass, userName, userAddress, userType) VALUES ('user3','weBW9PPKWKeJE','User3','Caloocan City','regular');

/* Products */
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (1,'Sticker1','Very cute sticker 2x2 waterproof','Available',20,10.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (2,'Sticker2','Amazing design sticker 2x2 clear transparent easy to remove','Available',10,15.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (3,'Sticker3','Cool design sticker 5 inches square on matte paper','Available',10,20.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (4,'Relatable Sticker','Express yourself with these relatable stickers','Available',5,15.00);
INSERT INTO Products (productNumber, productName, productDescription, productStatus, productQuantity, productPrice) VALUES (5,'Motivation','Very in demand so order now!','Out of stock',0,25.00);

/* Carts */

/* Orders */
