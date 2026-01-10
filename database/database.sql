DROP DATABASE IF EXISTS Kari ;

CREATE DATABASE IF NOT EXISTS kari;

USE kari;

show tables;

CREATE TABLE IF NOT EXISTS roles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  role VARCHAR(10)
);
INSERT INTO roles (role) VALUES ('travler');
INSERT INTO roles (role) VALUES ('host');
INSERT INTO roles (role) VALUES ('admin');
CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  email VARCHAR(30) UNIQUE,
  password VARCHAR(255),
  statut ENUM('active','inactive') DEFAULT 'active',
  role_id INT,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE IF NOT EXISTS rentals (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  description TEXT,
  country VARCHAR(15),
  city VARCHAR(15),
  adress VARCHAR(255),
  price DECIMAL(10,2),
  img VARCHAR(100),
  statut ENUM('active','inactive') DEFAULT 'inactive',
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
)

DROP TABLE IF EXISTS bookings;

CREATE TABLE IF NOT EXISTS bookings (
  id INT PRIMARY KEY AUTO_INCREMENT,
  start_date DATE,
  end_date DATE,
  rental_id INT,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (rental_id) REFERENCES rentals(id)
)

ALTER TABLE bookings ADD COLUMN statut ENUM('active','completed','canceled') DEFAULT 'active';

CREATE TABLE IF NOT EXISTS reviews (
  id INT PRIMARY KEY AUTO_INCREMENT,
  rate DECIMAL(1,1),
  note TEXT,
  date DATE DEFAULT (CURRENT_TIME),
  rental_id INT,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (rental_id) REFERENCES rentals(id)
)

CREATE TABLE IF NOT EXISTS favorites (
  id INT PRIMARY KEY AUTO_INCREMENT,
  date DATE DEFAULT (CURRENT_TIME),
  rental_id INT,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (rental_id) REFERENCES rentals(id)
)

CREATE TABLE IF NOT EXISTS notifications (
  id INT PRIMARY KEY AUTO_INCREMENT,
  body TEXT,
  date DATE DEFAULT (CURRENT_TIME),
  reciever_id INT,
  FOREIGN KEY (reciever_id) REFERENCES users(id)
)

CREATE TABLE IF NOT EXISTS complaints (
  id INT PRIMARY KEY AUTO_INCREMENT,
  omplaint TEXT,
  date DATE DEFAULT (CURRENT_TIME),
  sender_id INT,
  FOREIGN KEY (sender_id) REFERENCES users(id)
)
