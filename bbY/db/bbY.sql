
use bbY;


CREATE TABLE category (
   id INT NOT NULL AUTO_INCREMENT,
   eight_coupon_id INT,
   title varchar(150),
   PRIMARY KEY(id)
);

CREATE TABLE sub_category (
   id INT NOT NULL AUTO_INCREMENT,
   eight_coupon_id INT,
   title varchar(150),
   PRIMARY KEY(id)
);

