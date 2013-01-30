
use bbY;


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
	name varchar(255),
	PRIMARY KEY(id)
);
