CREATE DATABASE IF NOT EXISTS bloggdb;
SET @salt = '@hellothis$$$$isfor&&&&&&&passwordprotection';
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;
CREATE TABLE users(
Id INT NOT NULL AUTO_INCREMENT,
Username VARCHAR(100) NOT NULL,
Email VARCHAR(100) NOT NULL,
Password VARCHAR(50) NOT NULL,
Role VARCHAR(50) NOT NULL,
PRIMARY KEY(Id)
);



INSERT INTO users(Username, Email, Password, Role)
VALUES
('admin', 'admin@gmail.com', MD5(CONCAT('admin',@salt)), 'admin'),
('user', 'user@gmail.com', MD5(CONCAT('user',@salt)),  'user');

CREATE TABLE posts(
Id INT NOT NULL AUTO_INCREMENT,
Title VARCHAR(100) NOT NULL,
Content LONGTEXT NOT NULL,
Category VARCHAR(100) NOT NULL,
CreatedBy VARCHAR(100) NOT NULL,
Image TEXT,
Date_Time DATETIME NOT NULL,
UserId INT NOT NULL,
PRIMARY KEY(Id),
CONSTRAINT FK_Posts FOREIGN KEY(UserId) REFERENCES users(Id)
);

INSERT INTO posts(
    Title, 
    Content,
    Category, 
    CreatedBy,
    Image, 
    Date_Time,
    UserId)
VALUES
(
    "Cool Glasses", 
    "Here comes the lastest in trend the Tik-Tok glares!!",
     "Sunglass",
     "admin", 
     "upload/black-prizm-black-polarized-1.jpg",
     CURRENT_TIMESTAMP,
     1
     ),
("Vintage clock", 
"Does this clock reminds you of your olden days waiting for the most awaited rail journeys!!!Well then you should add it to your home to make u remember your sweet flashbacks!!",
"Clock",
 "admin", 
 "upload/64451-24.jpg",
 CURRENT_TIMESTAMP,
 1),
("Green the color of peace",
 "Chair that gives your room not only a modern touch but also a great comfort to sit on!!",
  "Furnishing",
   "admin", 
   "upload/green chair.jpg",
    CURRENT_TIMESTAMP,
    1
    );


CREATE TABLE comments(
Id  INT NOT NULL AUTO_INCREMENT,
Comment_text MEDIUMTEXT NOT NULL,
Post_Id INT NOT NULL,
User_Id INT NOT NULL,
PRIMARY KEY(Id),
CONSTRAINT FK_PostId FOREIGN KEY(Post_Id) REFERENCES posts(Id) ON DELETE CASCADE,
CONSTRAINT FK_UserId FOREIGN KEY(User_Id) REFERENCES users(Id)

);


DROP PROCEDURE IF EXISTS `GetCategoryFurnishing`;
DROP PROCEDURE IF EXISTS `GetCategorySunglass`;
DROP PROCEDURE IF EXISTS `GetCategoryClock`;

DELIMITER //

CREATE PROCEDURE GetCategoryClock()
BEGIN
	SELECT *  FROM posts WHERE Category='Clock' ORDER BY Id DESC;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE GetCategorySunglass()
BEGIN
	SELECT *  FROM posts WHERE Category='Sunglass' ORDER BY Id DESC;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE GetCategoryFurnishing()
BEGIN
	SELECT *  FROM posts WHERE Category='Furnishing' ORDER BY Id DESC;
END //

DELIMITER ;

ENGINE=InnoDB;










