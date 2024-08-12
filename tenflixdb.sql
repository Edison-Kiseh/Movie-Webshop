-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 11:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenflixdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(8) UNSIGNED NOT NULL,
  `customerID` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `customerID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cartproducts`
--

CREATE TABLE `cartproducts` (
  `cartID` int(8) UNSIGNED NOT NULL,
  `productID` int(8) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float UNSIGNED NOT NULL,
  `paymentStatus` varchar(10) NOT NULL DEFAULT 'not paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartproducts`
--

INSERT INTO `cartproducts` (`cartID`, `productID`, `quantity`, `total`, `paymentStatus`) VALUES
(1, 1, 1, 15, 'paid'),
(1, 7, 2, 25, 'paid'),
(1, 17, 1, 10.5, 'paid'),
(1, 7, 2, 25, 'paid'),
(1, 10, 1, 11, 'paid'),
(1, 2, 2, 27, 'paid'),
(1, 9, 3, 30, 'not paid'),
(2, 7, 2, 25, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(8) UNSIGNED NOT NULL,
  `categoryName` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Adventure'),
(2, 'Action'),
(3, 'SCI-FI'),
(4, 'Romance'),
(5, 'Thriller'),
(6, 'Crime');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(8) UNSIGNED NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `streetName` varchar(32) NOT NULL,
  `number` int(5) NOT NULL,
  `zipCode` int(5) NOT NULL,
  `municipality` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `permissions` varchar(20) DEFAULT 'user',
  `userRemoved` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `streetName`, `number`, `zipCode`, `municipality`, `email`, `password`, `permissions`, `userRemoved`) VALUES
(1, 'Edison', 'Kiseh', 'Rue du Long Chêne', 84, 1970, 'Wezembeek-Oppem', 'r0937121@student.thomasmore.be', '$2y$10$QeEziZruywS0zTyMOME4aOn0u2UGzhjm2dIKgKoo0yekaKkVhyS0W', 'administrator', 'no'),
(2, 'Wendy', 'Williams', 'brussels street', 12, 1000, 'Anderlecht', 'wendywilliams@gmail.com', '$2y$10$ylbnkLsSoJTF6MwLCFWbROQBm3kbT6cg/sVv75FVEHJY4Xkh6xdqm', 'user', 'no'),
(3, 'Harry', 'Osborne', '', 0, 0, '', 'harryo@gmail.com', '$2y$10$ssrD/qQ3V2bl3WAUdhhG0.t.dNsKJUVQPMB5DmxCgfHEJxPFrY6S.', 'user', 'no'),
(4, 'Sunny', 'Jackman', '', 0, 0, '', 'sunnyjack@gmail.com', '$2y$10$LtFHFprR1AaX20kgiHbwOuR63Y5sjzcVVAKPRO5u9IpXhT5VumuQ2', 'user', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(8) UNSIGNED DEFAULT NULL,
  `productID` int(8) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `quantity`) VALUES
(1, 1, 1),
(1, 7, 2),
(1, 17, 1),
(2, 7, 2),
(3, 10, 1),
(4, 2, 2),
(5, 2, 2),
(6, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(8) UNSIGNED NOT NULL,
  `orderDate` date DEFAULT NULL,
  `shippingAddress` varchar(100) DEFAULT NULL,
  `customerID` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `shippingAddress`, `customerID`) VALUES
(1, '2023-12-27', 'Long chene, 84 - 1970 Wezembeek-Oppem', 1),
(2, '2023-12-27', 'Rue du Long Chêne, 84 - 1970 Wezembeek-Oppem', 1),
(3, '2023-12-27', 'Rue du Long Chêne, 84 - 1970 Wezembeek-Oppem', 1),
(4, '2023-12-27', 'Rue du Long Chêne, 84 - 1970 Wezembeek-Oppem', 1),
(5, '2023-12-27', 'Rue du Long Chêne, 84 - 1970 Wezembeek-Oppem', 1),
(6, '2023-12-27', 'brussels street, 12 - 1000 Anderlecht', 2);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `productID` int(8) UNSIGNED NOT NULL,
  `categoryID` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productID`, `categoryID`) VALUES
(1, 2),
(1, 3),
(2, 2),
(2, 5),
(3, 2),
(3, 1),
(4, 1),
(4, 3),
(5, 2),
(5, 1),
(5, 4),
(6, 2),
(6, 3),
(7, 2),
(7, 5),
(8, 1),
(8, 3),
(9, 2),
(9, 4),
(10, 4),
(10, 5),
(11, 2),
(11, 5),
(12, 2),
(12, 6),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 6),
(15, 2),
(15, 3),
(16, 2),
(16, 6),
(16, 5),
(17, 2),
(17, 1),
(17, 4),
(18, 2),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(8) UNSIGNED NOT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `price` float NOT NULL,
  `parentalGuidance` varchar(5) NOT NULL,
  `rating` float NOT NULL,
  `duration` varchar(10) NOT NULL,
  `actors` varchar(100) NOT NULL,
  `director` varchar(32) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `landscapeImage` varchar(100) NOT NULL,
  `trailer` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `releaseDate` varchar(32) NOT NULL,
  `removeProduct` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `price`, `parentalGuidance`, `rating`, `duration`, `actors`, `director`, `image`, `landscapeImage`, `trailer`, `description`, `releaseDate`, `removeProduct`) VALUES
(1, 'Inception', 15, 'PG-13', 8.6, '2h28min', 'Leonardo Dicaprio, Elliot Page, Joseph Gordon-Levitt...', 'Christopher Nolan', '../images/movies/inception.jpg', '../../images/movies/inception2.jpg', '	 https://youtu.be/YoHD9XEInc0', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.', 'July 21, 2010', 'no'),
(2, 'Mission Impossible', 13.5, 'PG-12', 7.8, '2h43min', 'Tom Cruise, Hayley Atwell, Rebecca Ferguson, Esai Morales...', 'Christopher McQuarrie', '../images/movies/mission_impossible.jpg', '../../images/movies/mission-impossible-filming-locations-4.jpg', 'https://youtu.be/avz06PDqDbM', 'Ethan Hunt and the IMF team must track down a terrifying new weapon that threatens all of humanity if it falls into the wrong hands. With control of the future and the fate of the world at stake, a deadly race around the globe begins. Confronted by a mysterious, all-powerful enemy, Ethan is forced to consider that nothing can matter more than the mission -- not even the lives of those he cares about most.', 'July 12, 2023', 'no'),
(3, 'Free guy', 10.5, 'PG-12', 7.1, '1h55min', 'Ryan Reynolds, Jodie Comer, Taika Waititi...', ' Shawn Levy', '../images/movies/free_guy.jpeg', '	 ../../images/movies/free_guy_landscape.jpeg', 'https://youtu.be/JORN2hkXLyM', 'Guy lives a seemingly peaceful life as a bank teller. However, an encounter with a pretty but mysterious woman makes him realise that he is a non-playable character in a massive online video game.', 'August 13, 2021', 'no'),
(4, 'Interstellar', 12, 'PG-13', 8.7, '2h49min', 'Matthew McConaughey, Jessica Chastain, Anne Hathaway, Mackenzie Foy...', 'Christopher Nolan', '../images/movies/interstellar.jpeg', '../../images/movies/interstellar_poster_0.jpg', 'https://youtu.be/2LqzF5WauAw', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.', 'November 5, 2014', 'no'),
(5, 'The man from U.N.C.L.E', 10, 'PG-16', 7.2, '1h56min', 'Armie Hammer, Henry Cavill, Alicia Vikander, Elizabeth Debicki...', 'Guy Ritchie', '../images/movies/The_man_from_U.N.C.L.E.jpg', '../../images/movies/the_man_from_uncle_landscape.jpg', 'https://youtu.be/4K4Iv_N9Nno', 'Napoleon Solo, a CIA agent, and Illya Kuryakin, a KGB operative, must set aside their differences and work together to thwart the plans of a criminal organization that wants to use nuclear weapons.', 'August 14, 2015', 'no'),
(6, 'Tenet', 14, 'PG-12', 7.3, '2h30min', 'Elizabeth Debicki, John David Washington, Robert Pattinson, Keneth Branagh...', 'Christopher Nolan', '../images/movies/tenet.jpg', '../../images/movies/tenet-movie.jpg', 'https://youtu.be/C0BMx-qxsP4', 'Armed with only one word, Tenet, and fighting for the survival of the entire world, a Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.', 'August 12, 2020', 'no'),
(7, 'John Wick 1', 12.5, 'PG-16', 7.4, '1h41min', 'Keanu Reeves, Michael Nyqvist, Alfie Allen...', 'Chad Stahelski', '../images/movies/john_wick.jpg', '	 ../../images/movies/john-wick-landscape.jpg', 'https://youtu.be/C0BMx-qxsP4', 'John Wick, a retired hitman, is forced to return to his old ways after a group of Russian gangsters steal his car and kill a puppy gifted to him by his late wife.', 'November 24, 2014', 'no'),
(8, 'Dune', 11.5, 'PG-13', 8, '2h25min', 'Zendaya, Rebecca Ferguson, Timothée Chalamet...', 'Denis Villeneuve', '../images/movies/dune.jpg', '../../images/movies/dune-landscape.jpg', 'https://youtu.be/n9xhJrPXop4', 'A noble family becomes embroiled in a war for control over the galaxy\'s most valuable asset while its heir becomes troubled by visions of a dark future.', 'October 22, 2021', 'no'),
(9, 'Mr. and mrs. Smith', 10, 'PG-13', 6.5, '2h6min', 'Brad Pitt, Angelina Jolie, Adam Brody...', 'Doug Liman', '../images/movies/mr_and_mrs_smith.jpeg', '../../images/movies/mr_and_mrs_smith_movie.jpg', 'https://youtu.be/CZ0B22z22pI', 'A husband and wife struggle to keep their marriage alive until they realise they are both secretly working as assassins. Now, their respective assignments require them to kill each other.', 'Jun 10, 2005', 'no'),
(10, 'The tourist', 11, 'PG-13', 6, '1h43min', 'Johnny Depp, Paul Bettany, Angelina Jolie...', 'Florian Henckel von Donnersmarck', '../images/movies/the_tourist.jpg', '../../images/movies/the_tourist_movie_image_angelina_jolie_johnny_depp_01.jpg', 'https://youtu.be/5XtbLezJtMg', 'Revolves around Frank, an American tourist visiting Italy to mend a broken heart. Elise is an extraordinary woman who deliberately crosses his path.', 'December 10, 2010', 'no'),
(11, 'James bond - Skyfall', 13, 'PG-13', 7.8, '1h43min', 'Javier Bardem, Daniel Craig, Naomie Harris...', 'Sam Mendes', '../images/movies/james_bond_skyfall.jpg', '	 ../../images/movies/skyfall-image.jpg', 'https://youtu.be/6kw1UVovByw', 'James Bond\'s loyalty to M is tested when her past comes back to haunt her. When MI6 comes under attack, 007 must track down and destroy the threat, no matter how personal the cost.', 'October 26, 2012', 'no'),
(12, 'The Equalizer', 11, 'PG-13', 7.2, '2h12min', 'Denzel Washington, Chloë Grace Moretz, Marton Csokas...', 'Antoine Fuqua', '../images/movies/The-Equalizer.jpg', '../../images/movies/equalizer-image.jpg', 'https://youtu.be/VjctHUEmutw', 'With his violent past behind him, McCall decides to lead a quiet life. However, when he sees a young girl, Teri, being controlled by violent gangsters, he once again takes up the fight for justice.', 'September 26, 2014', 'no'),
(13, 'The Creator', 11.5, 'PG-13', 7.1, '2h15min', 'Gemma Chan, John David Washington, Madeleine Yuna Voyles...', 'Gareth Edwards', '../images/movies/the_creator.jpg', '../../images/movies/the-creator-image.jpeg', 'https://youtu.be/ex3C1-5Dhb8', 'As a future war between the human race and artificial intelligence rages on, ex-special forces agent Joshua is recruited to hunt down and kill the Creator, the elusive architect of advanced AI. The Creator has developed a mysterious weapon that has the power to end the war and all of mankind. As Joshua and his team of elite operatives venture into enemy-occupied territory, they soon discover the world-ending weapon is actually an AI in the form of a young child.', 'September 29, 2023', 'no'),
(14, 'Sherlock Holmes', 13.5, 'PG-13', 7.8, '2h8min', 'Jude Law, Rachel McAdams, Robert Downey Jr...', 'Guy Ritchie', '../images/movies/sherlock-holmes.jpg', '../../images/movies/sherlockHolmes.jpg', 'https://youtu.be/iKUzhzustok', 'Detective Sherlock Holmes and his partner, Dr Watson, send Blackwood, a serial killer, to the gallows. However, they are shocked to learn that he is back from the dead and must pursue him again.', 'December 25, 2009', 'no'),
(15, 'The matrix', 13.5, 'PG-13', 8.7, '2h16min', 'Laurence Fishburne, Keanu Reeves, Carrie-Anne Moss...', 'Lana Wachowski, Lilly Wachowski', '../images/movies/the-matrix.jpg', '../../images/movies/theMatrix.jpg', 'https://youtu.be/m8e-FF8MsqU', 'Neo, a computer programmer and hacker, has always questioned the reality of the world around him. His suspicions are confirmed when Morpheus, a rebel leader, contacts him and reveals the truth to him.', 'Mar 31, 1999', 'no'),
(16, 'Batman', 13, 'PG-13', 8.4, '2h44min', ' Anne Hathaway, Tom Hardy, Christian Bale...', 'Christopher Nolan', '../images/movies/batman-rises.jpg', '../../images/movies/batman-movie-image.jpeg', 'https://youtu.be/g8evyE9TuYk', 'Eight years after the Joker\'s reign of chaos, Batman is coerced out of exile with the assistance of the mysterious Selina Kyle in order to defend Gotham City from the vicious guerrilla terrorist Bane.', 'July 25, 2012', 'no'),
(17, 'Knight and Day', 10.5, 'PG-13', 6.3, '1h50min', 'Cameron Diaz, Peter Sarsgaard, Tom Cruise...', 'James Mangold', '../images/movies/Knight-and-Day.jpg', '	 ../../images/movies/knightAndDay.png', 'https://youtu.be/JGPl86DBNNs', 'June Havens meets Roy Miller, a lethal operative, in an unlikely encounter and gets entangled in his adventures. She falls in love with him and has to figure out if he is a traitor or a good guy.', 'June 23, 2010', 'no'),
(18, 'Jumanji', 11, 'PG-13', 6.9, '1h59min', 'Dwayne Johnson, Kevin Hart, Karen Gillan...', 'Jake Kasdan', '../images/movies/jumanji.jpg', '../../images/movies/jumanjiImage.jpg', 'https://youtu.be/JGPl86DBNNs', 'When four students play with a magical video game, they are drawn to the jungle world of Jumanji, where they are trapped as their avatars. To return to the real world, they must finish the game.', 'December 20, 2017', 'no'),
(21, 'My movie', 12.3, '12', 7, '1h00', 'Edison Kiseh, John Smith...', 'Edison Kiseh', '', '', '', 'Just a test movie to see if this mechanism works.', 'September 12, 2012', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `cartproducts`
--
ALTER TABLE `cartproducts`
  ADD KEY `productID` (`productID`),
  ADD KEY `cardID` (`cartID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `cartproducts`
--
ALTER TABLE `cartproducts`
  ADD CONSTRAINT `cartproducts_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `cartproducts_ibfk_3` FOREIGN KEY (`cartID`) REFERENCES `cart` (`cartID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `productcategory_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`),
  ADD CONSTRAINT `productcategory_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
