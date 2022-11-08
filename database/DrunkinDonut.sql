
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Drunkin Donut`
--

DROP DATABASE IF EXISTS DrunkinDonut;
CREATE DATABASE DrunkinDonut;
USE DrunkinDonut;

-- --------------------------------------------------------
--
-- Table structure for table `Role`
--
CREATE TABLE IF NOT EXISTS `Role`(
RoleID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
RoleName VARCHAR(30) NOT NULL UNIQUE KEY
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Role`
--
INSERT INTO `Role`(RoleID, RoleName) VALUES
(1,"User"), (2,"Employee"), (3,"Admin");

-- --------------------------------------------------------
--
-- Table structure for table `Account`
--
CREATE TABLE IF NOT EXISTS `Account`(
AccountID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
AccName VARCHAR(30) NOT NULL,
AccPassword  VARCHAR(32) NOT NULL,
AccPhoneNo VARCHAR(10) NOT NULL UNIQUE KEY,
AccEmail VARCHAR(100) NOT NULL UNIQUE KEY,
`Point` INT DEFAULT 0,
RoleID INT NOT NULL,
FOREIGN KEY (RoleID) REFERENCES `Role`(RoleID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account`(AccountID,AccName, AccPassword, AccPhoneNo, AccEmail, RoleID) VALUES
(1,'lyhoaithu','e10adc3949ba59abbe56e057f20f883e ','0123456789','hoaithu2811@gmail.com',1),
(2,'ngocyen2102','e10adc3949ba59abbe56e057f20f883e ','0123456788','ngocyen210201@gmail.com',1),
(3,'wendyson','e10adc3949ba59abbe56e057f20f883e ','0123456787','todayiswendy@gmail.com',3),
(4,'joypark','e10adc3949ba59abbe56e057f20f883e ','0123456786','iamyourjoy@gmail.com',2);

-- --------------------------------------------------------
--
-- Table structure for table `Cart`
--
CREATE TABLE IF NOT EXISTS `Cart`(
CartID VARCHAR(10) NOT NULL PRIMARY KEY,
AccountID INT NOT NULL,
FOREIGN KEY (AccountID) REFERENCES `Account` (AccountID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`CartID`,`AccountID`) VALUES
('cart01',3),
('cart02',4);



-- --------------------------------------------------------
--
-- Table structure for table `Categories`
--
CREATE TABLE IF NOT EXISTS `Categories`(
CategoryID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
CategoryName VARCHAR(200) NOT NULL
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (CategoryID,CategoryName) VALUES
(1,'Basic'),
(2,'Filled'),
(3,'Special'),
(4,'Box Set');

-- --------------------------------------------------------
--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS Product(
ProductID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ProductName VARCHAR(255) NOT NULL,
ThumbnailPic VARCHAR(255) NOT NULL,
Price INT UNSIGNED NOT NULL,
ProductQuantity INT UNSIGNED NOT NULL,
`Description` VARCHAR(3000),
Discount INT DEFAULT '0',
CreateDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
CategoryID INT NOT NULL,
FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `Product`
--

INSERT INTO Product (ProductID, ProductName, ThumbnailPic, Price, ProductQuantity, `Description`, CategoryID) VALUES
(1,'Blue Sky','Blue Sky.png','45000','10',
'Ruffian: Donut, 
Glaze: Blue Cream Cheese, 
Topping: Blue Sprinkles','1'),
(2,'Butter Milk','Butter Milk.png','55000','0',
'Ruffian: Donut, 
Glaze: Icing Sugar, 
Topping: Butter Milk Cookies','3'),
(3,'Cappuchino Vanilla','Cappuchino Vanilla.png','60000','5',
'Ruffian: Donut, 
Glaze: Creamy Chocolate & White Chocolate Sauce, 
Topping: Chocolate Sprinkles & Coffee Macaroon','3'),
(4,'Caramel Sprinkels','Caramel Sprinkels.png','60000','0',
'Ruffian: Donut, 
Glaze: White Chocolate, 
Sauce: Caramel Sauce, 
Topping: Vanilla Macaroon & Caramel Peanut','3'),
(5,'Chocolate Addicted','Chocolate Addicted.png','50000','16',
'Ruffian: Donut, 
Glaze: Dark Chocolate, 
Sauce: Hershey Chocolate Sauce, 
Topping: Snickers','1'),
(6,'Chocolate Filled Crossnut','Chocolate Filled Crossnut.png','70000','29',
'Ruffian: Croissnut, 
Glaze: Dark Chocolate, 
Filled: Brown Chocolate, 
Topping: Pistachio & Rasberry','2'),
(7,'Coconut Mix','coconut mix.png','50000','1',NULL,'3'),
(8,'Coffee Bomb','Coffee Bomb.png','60000','34',
'Ruffian: Donut, 
Glaze: Black Coffee Cream, 
Sauce: Milky Chocolate, 
Topping: Burnt Whipping Cream & Coffee Macaroon','2'),
(9,'Deluxe Set','Deluxe Set.png','350000','17','Flavors: Chocolate Lover, Creamy Matcha, Strawberry Cheese, Mango Coconut Bomb, ChocolateBerry Caramel, Oh My Pretzel','4'),
(10,'M&M Vibe','M&M Vibe.png','50000','26',
'Ruffian: Donut, 
Glaze: Icing Sugar, 
Topping: M&M & Vanilla Macaroon','3'),
(11,'NYC Cheese Cake','NYC Cheese Cake.png','65000','0',
'Ruffian: Donut, 
Glaze: Cheese Cake Creamy Flavor, 
Sauce: White Chocolate, 
Topping: Cheesecake Crumbles & Smiley Cow Burnt Cheeese','2'),
(12,'Pink Party','Pink Party.png','70000','92',
'Ruffian: Donut, 
Glaze: Strawberry Icing, 
Sauce: Hershey Chocolate Sauce, 
Topping: Chocolate Sprinkles & Strawberry Kitkat & Rasberry','2'),
(13,'Rafeallo Bomb','Rafeallo Bomb.png','68000','103',
'Ruffian: Donut, 
Glaze: Coconut Cream, 
Topping: Dried Coconut & Rafeallo Candy','3'),
(14,'Rasberry Touch','Rasberry Touch.png','80000','12',NULL,'2'),
(15,'Rasberry Jams Crossnut','Raspberry Jams Crossnut.png','70000','5',
'Ruffian: Croissnut, 
Glaze: Rasberry Jams, 
Topping: Peanuts','2'),
(16,'Donut Ask Box','Donut Ask Box.jpg','350000','23','Random Flavours From Our Menu','4');
-- --------------------------------------------------------
--
-- Table structure for table `Rate`
--
CREATE TABLE IF NOT EXISTS `Rate`(
Ratings INT NOT NULL,
Review VARCHAR(5000),
CreatedDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
AccountID INT NOT NULL,
ProductID INT NOT NULL,
FOREIGN KEY (AccountID) REFERENCES `Account`(AccountID) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (ProductID) REFERENCES PRODUCT (ProductID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Rate`
--

INSERT INTO `Rate` (`Ratings`, `Review`, `AccountID`,`ProductID`) VALUES
(1,'One of my favourite flavor! The cake is nut doughy and it is freshly baked. The glaze is amazing. 10/10',3,5),
(2,NULL,4,10),
(3,'The crossnut is such an amazing idea and the filling is one of the best thing that I have ever tasted',4,15);

-- --------------------------------------------------------
--
-- Table structure for table `Product_Cart`
--
CREATE TABLE IF NOT EXISTS `Product_Cart`(
ProductID INT NOT NULL,
CartID VARCHAR(10) NOT NULL,
Quantity INT,
AddedDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
FOREIGN KEY (ProductID) REFERENCES PRODUCT (ProductID) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (CartID) REFERENCES CART (CartID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product_Cart`
--

INSERT INTO `Product_Cart` (`ProductID`,`CartID`,`Quantity`) VALUES
(13,'cart01', 1),
(9,'cart01', 2),
(10,'cart01', 3),
(8,'cart01', 7),
(15,'cart01', 1),
(6,'cart02', 3),
(9,'cart02', 3);


-- --------------------------------------------------------
--
-- Table structure for table `Order`
--
CREATE TABLE IF NOT EXISTS `Order` (
  OrderID VARCHAR(6) NOT NULL PRIMARY KEY,
  OrderDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  OrderStatus ENUM('Unconfirmed','Preparing','Shipping', 'Completed', 'Cancelled') NOT NULL,
  PaymentStatus ENUM('Unpaid', 'Paid')NOT NULL,
  TotalOrder DOUBLE DEFAULT '0',
  AccountID INT NOT NULL,
  FOREIGN KEY (AccountID) REFERENCES `Account` (AccountID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order`
--

INSERT INTO `Order` (`OrderID`,`AccountID`, `OrderStatus`, `PaymentStatus`,`TotalOrder`) VALUES
('DD0001',3,'Unconfirmed','Unpaid', 250000),
('DD0002',3,'Shipping','Unpaid', 125000),
('DD0003',4,'Completed','Paid', 380000),
('DD0004',4,'Preparing','Paid', 268000);

-- --------------------------------------------------------
--
-- Table structure for table `Order_Details`
--
CREATE TABLE IF NOT EXISTS `Order_Details` (
  OrderID VARCHAR(6) NOT NULL,
  CustomerName VARCHAR(30) NOT NULL,
  CustomerAddress VARCHAR(200) NOT NULL,
  CustomerPhoneNo VARCHAR(10) NOT NULL,
  PaymentMethod ENUM('COD','Banking'),
  Note VARCHAR (5000),
  FOREIGN KEY (OrderID) REFERENCES `Order` (OrderID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order_Details`
--

INSERT INTO `Order_Details` (`OrderID`, `CustomerName`, `CustomerAddress`,`CustomerPhoneNo`,`PaymentMethod`) VALUES
('DD0001','Wendy','Ngõ 366 Ngọc Thụy, Long Biên, Hà Nội','0123456787','COD'),
('DD0002','Seulgi','Số 24 Bùi Thị Xuân, Hai Bà Trưng, Hà Nội','0123456787','COD'),
('DD0003','Joy','Số 1 Phan Đình Giót, Phương Liệt, Thanh Xuân, Hà Nội','0123456786','Banking'),
('DD0004','Crush','533 Giải Phóng, Thanh Xuân, Hà Nội','0123456785','Banking');

-- --------------------------------------------------------
--
-- Table structure for table `Order_Product`
--
CREATE TABLE IF NOT EXISTS `Order_Product` (
  OrderID VARCHAR(6) NOT NULL,
  ProductID INT NOT NULL,
  OrderQuantity TINYINT NOT NULL,
  QuantityPrice INT NOT NULL,
  FOREIGN KEY (OrderID) REFERENCES `Order` (OrderID) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (ProductID) REFERENCES `Product` (ProductID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order_Product`
--

INSERT INTO `Order_Product` (`OrderID`, `ProductID`, `OrderQuantity`, `QuantityPrice`) VALUES
('DD0001',1,2,90000),
('DD0001',8,1,60000),
('DD0001',12,1,70000),
('DD0002',1,1,45000),
('DD0002',10,1,50000),
('DD0003',16,1,350000),
('DD0004',6,1,70000),
('DD0004',7,1,50000),
('DD0004',13,1,68000),
('DD0002',5,1,50000);

-- --------------------------------------------------------
--
-- Table structure for table `Anon_Cart`
--
CREATE TABLE IF NOT EXISTS `Anon_Cart`(
CartID VARCHAR(32) NOT NULL PRIMARY KEY
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Anon_Cart`
--

INSERT INTO `Anon_Cart` (`CartID`) VALUES
('anon00001'),
('anon00002'),
('anon00003');

-- --------------------------------------------------------
--
-- Table structure for table `Anon_Cart_Product`
--
CREATE TABLE IF NOT EXISTS `Anon_Cart_Product`(
CartID VARCHAR(32) NOT NULL,
ProductID INT,
Quantity INT,
AddedDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
FOREIGN KEY (CartID) REFERENCES ANON_CART (CartID) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (ProductID) REFERENCES PRODUCT (ProductID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Anon_Cart_Product`
--

INSERT INTO `Anon_Cart_Product` (`CartID`,`ProductID`,`Quantity`) VALUES
('anon00001','6','2'),
('anon00001','12','3'),
('anon00003','3','2');


