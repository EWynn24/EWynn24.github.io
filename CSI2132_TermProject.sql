CREATE TABLE Hotel_Chains (
	Number_of_its_hotels INT,
	Phone_number_owner VARCHAR(10),
	Email_address TEXT,
	Address_Of_Central_Offices TEXT,
	PRIMARY KEY (Phone_number_owner)
);

CREATE TABLE Hotels (
	Number_of_rooms INT,
	Stars INT,
	Email_address TEXT,
	Phone_number_hotel VARCHAR(10),
	PRIMARY KEY (Phone_number_hotel),
	FOREIGN KEY (Phone_number_owner)
	REFERENCES HotelChains
);

CREATE TABLE IsOwner (
	FOREIGN KEY (Phone_number_owner)
	REFERENCES Hotel_Chains,
	FOREIGN KEY (Phone_number_hotel, Phone_number_owner)
	REFERENCES Hotels
);

CREATE TABLE Rooms (
	Room_Number INT,
	Damages TEXT[],
	View TEXT,
	Capacity INT,
	Price Numeric(10,2),
	Amenities TEXT[],
	Can_be_extended BOOL,
	Availability BOOL,
	PRIMARY KEY (Room_Number),
	FOREIGN KEY (Phone_number_hotel, Phone_number_owner)
	REFERENCES Hotels
);

CREATE TABLE Has (
	FOREIGN KEY (Phone_number_hotel, Phone_number_owner)
	REFERENCES Hotels,
	FOREIGN KEY (Room_number)
	REFERENCES Rooms
);

CREATE TABLE Customer (
	Full_name Text,
	Address Text,
	Length_of_stay INT,
	PRIMARY KEY (Full_name, Address)
);

CREATE TABLE Booking (
	Start_date Text,
	End_date Text,
	FOREIGN KEY (Full_name, Address)
	REFERENCES Customer,
	FOREIGN KEY (Room_Number, Phone_number_hotel, Phone_number_owner)
	REFERENCES Rooms
);

CREATE TABLE Employee (
	Full_name TEXT,
	SSN VARCHAR(20),
	Position TEXT,
	PRIMARY KEY (SSN)
);

CREATE TABLE Employment (
	FOREIGN KEY (Phone_number_hotel, Phone_number_owner)
	REFERENCES Hotels,
	FOREIGN KEY (SSN)
	REFERENCES Employee
);