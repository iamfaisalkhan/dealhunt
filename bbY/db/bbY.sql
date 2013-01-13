
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

