
use bbY;

CREATE TABLE IF NOT EXISTS user (
   id INT NOT NULL AUTO_INCREMENT,
   email varchar(50),
   secret varchar(50),
   salt varchar(10),
   name varchar(250),
   gender varchar(1),
   facebook_id INT default 0,
   twitter_id INT default 0,
   date_joined TIMESTAMP default 0,
   last_login TIMESTAMP default 0,
   verified TINYINT default 0,
   facebook_connect TINYINT default 0,
   PRIMARY KEY(id)
);


CREATE TABLE IF NOT EXISTS category (
   id INT NOT NULL AUTO_INCREMENT,
   eight_coupon_id INT,
   title varchar(150),
   PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS sub_category (
   id INT NOT NULL AUTO_INCREMENT,
   category_id INT NOT NULL,
   eight_coupon_id INT,
   title varchar(150),
   PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS store_chains (
    id INT NOT NULL AUTO_INCREMENT,
    eight_coupon_id INT NOT NULL,
    name varchar(255),
    page varchar(255),
    home_page varchar(255),
    logo_small varchar(255),
    logo_big varchar(255),
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS deals (
    id INT NOT NULL AUTO_INCREMENT,
    source_id INT,
    source_name varchar(255),
    txt TEXT,
    url varchar(255),
    image varchar(255),
    date_posted DATETIME,
    date_expired DATETIME,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS products (
    id INT NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS categories (
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(255),
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS items (
	id INT NOT NULL AUTO_INCREMENT,
	category_id INT NOT NULL,
	title varchar(255),
  date_created TIMESTAMP default 0,
  date_modified TIMESTAMP default 0, 
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS user_items (
  id INT NOT NULL AUTO_INCREMENT,
  item_id INT NOT NULL,
  user_id INT NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO categories(id, name) values(1, "Electronics");
INSERT INTO categories(id, name) values(2, "Travel");
INSERT INTO categories(id, name) values(3, "Restaurants");
INSERT INTO categories(id, name) values(4, "Shopping");
INSERT INTO categories(id, name) values(5, "Entertainment");
INSERT INTO categories(id, name) values(6, "Outdoor Activities");
INSERT INTO categories(id, name) values(7, "Services");
INSERT INTO categories(id, name) values(8, "Restaurants");
INSERT INTO categories(id, name) values(9, "Software");
INSERT INTO categories(id, name) values(10, "Beauty & Spa");
INSERT INTO categories(id, name) values(11, "Clothing, Accessories and Apparels");
INSERT INTO categories(id, name) values(12, "Jewellery");



