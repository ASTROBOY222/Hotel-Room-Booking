# Hotel-Room-Booking
Download xampp, youtube link: https://www.youtube.com/watch?v=VCHXCusltqI

1. create this tables in database:
a) USER:
CREATE TABLE user (
  UserID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  phone int(10) NOT NULL,
  PRIMARY KEY (UserID)
);

b) Hotel:
CREATE TABLE hotel (
  id int(11) NOT NULL AUTO_INCREMENT,
  Location varchar(100) NOT NULL,
  H_name varchar(100) NOT NULL,
  Room_no int(11) NOT NULL,
  Type int(11) DEFAULT NULL,
  Price decimal(10,2) DEFAULT NULL,
  Description text DEFAULT NULL,
  Status varchar(20) DEFAULT NULL CHECK (Status in ('available','unavailable')),
  PRIMARY KEY (id)
) ;

c) Booking:
CREATE TABLE booking (
  BookID int(11) NOT NULL AUTO_INCREMENT,
  RoomID int(11) NOT NULL,
  UserID int(11) NOT NULL,
  CheckIn date NOT NULL,
  CheckOut date NOT NULL,
  PRIMARY KEY (BookID)
);

d) Payment:
CREATE TABLE payment (
  PayID int(11) NOT NULL AUTO_INCREMENT,
  PayDate date NOT NULL,
  UserID int(11) NOT NULL,
  Amount decimal(10,2) NOT NULL,
  PRIMARY KEY (PayID)
);


3. create trigger for database:
CREATE TRIGGER after_booking_insert AFTER INSERT ON booking
 FOR EACH ROW BEGIN
  DECLARE payment_amount DECIMAL(10,2);
  DECLARE room_price DECIMAL(10,2);
  DECLARE days_stayed INT;

  -- Get the price of the room
  SELECT Price INTO room_price
  FROM hotel
  WHERE id = NEW.RoomID;

  -- Calculate the number of days stayed
  SET days_stayed = DATEDIFF(NEW.CheckOut, NEW.CheckIn);

  -- Calculate the payment amount
  SET payment_amount = days_stayed * room_price;

  -- Insert into payment table
  INSERT INTO payment (PayDate, UserID, Amount)
  VALUES (CURDATE(), NEW.UserID, payment_amount);

  -- Update the room status to 'unavailable'
  UPDATE hotel
  SET Status = 'unavailable'
  WHERE id = NEW.RoomID;
END

AND THEN YOU CAN FOLLOW YOUTUBE VIDEO AND LOCALLY-HOST THIS PAGES....
