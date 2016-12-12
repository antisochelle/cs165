/* Load records into the tables */
copy users FROM 'Users.csv' with delimiter as ',' csv;
copy products FROM 'Products.csv' with delimiter as ',' csv;
copy carts FROM 'Carts.csv' with delimiter as ',' csv;
copy orders FROM 'Orders.csv' with delimiter as ',' csv;


/*********************************

SAMPLE USERS, PASSWORDS:
	admin, 1234
	user1, pass1
	user2, pass2
	user3, pass3

*********************************/