/* CS375: Databases and Information Retrieval
		  Assignement 1  Sept. 22/2019
*/

CREATE TABLE classemates (
	cID INT IDENTITY (1, 1) PRIMARY KEY,
	last_name VARCHAR(50) NOT NULL,
	first_name VARCHAR(50) NOT NULL,
	sex VARCHAR(15) NOT NULL,
	_address VARCHAR(255) NOT NULL,
	postcode VARCHAR(25) NOT NULL,
	city VARCHAR(50) NOT NULL,
	phone VARCHAR(15)
);