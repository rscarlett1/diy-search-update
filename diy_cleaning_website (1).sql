-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2016 at 10:09 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diy_cleaning_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `ceated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `recipe_id`, `ceated_at`, `updated_at`) VALUES
(1, 'great recipe', 3, 53, '2016-09-03 22:27:15', '2016-09-03 22:27:15'),
(2, 'great easy cleaning', 3, 59, '2016-09-03 23:34:58', '2016-09-03 23:34:58'),
(3, 'Cleans well.', 3, 57, '2016-09-04 02:06:02', '2016-09-04 02:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_database`
--

CREATE TABLE `recipe_database` (
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` enum('Kitchen','Bathroom','Laundry','Garage','Other') NOT NULL DEFAULT 'Other',
  `method` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Declined','') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipe_database`
--

INSERT INTO `recipe_database` (`recipe_id`, `user_id`, `title`, `description`, `category`, `method`, `image`, `status`) VALUES
(49, 3, 'Glass Cleaner', '<p><em>Great for:</em>&nbsp;Windows and mirrors</p>', 'Other', '<p><em>Ingredients</em><br />\r\n&bull; 2 cups water<br />\r\n&bull; 1/2 cup white or cider vinegar<br />\r\n&bull; 1/4 cup rubbing alcohol (70% concentration)<br />\r\n&bull; 1 to 2 drops of orange essential oil, which gives the solution a lovely smell (optional)</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Combine ingredients and store in a spray bottle. Spray on a paper towel or soft cloth first, then on the glass. Hint: Don&#39;t clean windows on a hot, sunny day because the solution will dry too quickly and leave lots of streaks.</p>', '57c7a89050411.jpg', 'Pending'),
(50, 3, 'Heavy Duty Scrub', '<p><em>Great for:</em>&nbsp;Rust stains on porcelain or enamel sinks and tubs</p>', 'Garage', '<p><em>Ingredients</em><br />\r\n&bull; Half a lemon<br />\r\n&bull; 1/2 cup borax (a laundry booster; find it in the detergent aisle)</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Dip the lemon into the borax and scrub surface; rinse. (Not safe for marble or granite.)</p>', '57c7aa9f2c6d5.jpg', 'Pending'),
(51, 3, 'Grease Cleaner', '<p><em>Great for:</em>&nbsp;Oven hoods, grills</p>', 'Kitchen', '<p><em>Ingredients</em><br />\r\n&bull; 1/2 cup sudsy ammonia mixed with enough water to fill a one-gallon container. (Sudsy ammonia, which has detergent in it, helps remove tough grime.)</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Dip sponge or mop in solution and wipe over surface, then rinse area with clear water.</p>', '57c7aaf93d1a8.jpg', 'Pending'),
(52, 3, 'Clothing Stain Remover', '<p><em>Great for:</em>&nbsp;Badly stained washable or bleachable garments</p>', 'Laundry', '<p><em>Ingredients</em><br />\r\n&bull; 1 gallon hot water<br />\r\n&bull; 1 cup powdered dishwasher detergent<br />\r\n&bull; 1 cup regular liquid chlorine bleach (not ultra or concentrate)</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Mix and pour ingredients into a stainless steel, plastic, or enamel bowl (not aluminum). Soak garment for 15 to 20 minutes. If stain is still there, let it soak a bit longer, then wash garment as usual.</p>', '57c7ab7b9496e.jpg', 'Pending'),
(53, 3, 'Dishwasher Stain Remover', '<p>Great to remove stains in clothes</p>', 'Kitchen', '<p><em>Ingredients</em><br />\r\n&bull; 1/4 cup powdered lemon or orange drink</p>\r\n\r\n<p><em>How to use:</em>&nbsp;To remove rust from the inside walls, pour the powder (which contains citric acid or citric acid crystals) into the detergent cup and then run a regular cycle. Repeat as necessary.</p>', '57c7ac03349f3.jpg', 'Pending'),
(54, 3, 'Marble Cleaner', '<p><em>Great for:</em>&nbsp;Natural stone countertops</p>', 'Kitchen', '<p><em>Ingredients</em><br />\r\n&bull; A drop or two of mild dishwashing liquid (non-citrus-scented)<br />\r\n&bull; 2 cups warm water</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Mix the detergent and water. Sponge over marble and rinse completely to remove any soap residue. Buff with a soft cloth; do not let the marble air-dry. Caution: Never use vinegar, lemon, or any other acidic cleaner on marble or granite surfaces; it will eat into the stone.</p>', '57c7ac535449d.jpg', 'Pending'),
(55, 3, 'Brass Cleaner', '<p><em>Great for:</em>&nbsp;Non-lacquered cabinet pulls, bathroom appointments, and more</p>', 'Other', '<p><em>Ingredients</em><br />\r\n&bull; White vinegar or lemon juice<br />\r\n&bull; Table salt</p>\r\n\r\n<p><em>How to use:</em>&nbsp;Dampen a sponge with vinegar or lemon juice, then sprinkle on salt. Lightly rub over surface. Rinse thoroughly with water, then immediately dry with a clean soft cloth.</p>', '57c7aeffb14a8.jpg', 'Pending'),
(56, 3, 'Cleaning the Toilet Without Harsh Chemicals', '<p>Cleaning the toilet without using harsh chemicals.</p>\r\n\r\n<p>&nbsp;</p>', 'Other', '<p>Just sprinkle a little baking soda in and give it a quick once or two around. If you add some essential oils to the baking soda, about 20+ drops, like tea tree oil for it&rsquo;s anti-bacterial qualities and lemon or another scent that you like, it boosts the cleaning power and adds a nice, clean-smelling scent.</p>\r\n\r\n<p>Just sprinkle a little baking soda in and give it a quick once or two around. If you add some essential oils to the baking soda, about 20+ drops, like tea tree oil for it&rsquo;s anti-bacterial qualities and lemon or another scent that you like, it boosts the cleaning power and adds a nice, clean-smelling scent.</p>', '57c7b16901ec5.jpg', 'Pending'),
(57, 3, 'NonÂ ToxicÂ Disinfectant', '<p>Great alternative to the real thing.</p>', 'Bathroom', '<p>Ingredients</p>\r\n\r\n<p>16 oz. water<br />\r\n3 tbsp. liquid castile soap<br />\r\n30 drops tea tree oil<br />\r\nMix together in a spray bottle.</p>\r\n\r\n<p>There are many, many ways you can make a non-toxic disinfectant if you don&rsquo;t have these ingredients on hand.&nbsp; (I order my ingredients from&nbsp;<a href="https://www.vitacostrewards.com/7vC6aQw" target="_blank" title="Vitacost">Vitacost</a>&nbsp;since they have great prices, plus you get a $10 off $30 coupon when you create an account through&nbsp;<a href="https://www.vitacostrewards.com/7vC6aQw" target="_blank" title="Vitacost">my referral link</a>. )</p>\r\n\r\n<p>Other non-toxic products with disinfecting properties:</p>\r\n\r\n<p>Vinegar water (50/50 ratio) (do not use on marble surfaces)</p>\r\n\r\n<p>Hydrogen Peroxide (3 percent; if you want to spray it, you must use a dark spray bottle or screw the nozzle from another spray bottle directly onto the original peroxide bottle.) (Use vinegar and peroxide in conjunction with one another.)</p>\r\n\r\n<p>Thieves Oil</p>', '57c7b2a158e61.jpg', 'Pending'),
(58, 3, 'Mold and Mildrew Remover', '<p>Remove Mould and mildew&nbsp;from your ceilings</p>', 'Other', '<p>Mix&nbsp;<strong>1/2 cup borax</strong>&nbsp;and&nbsp;<strong>1/2 cup vinegar</strong>&nbsp;to make a paste. Scrub with a brush or sponge and rinse with water. For tough mold, let it sit for an hour before rinsing with water.</p>', '57cb58ad0ed54.jpg', 'Pending'),
(59, 3, 'Soap Scum Remover', '<p>Easily get rid of soap scum build up.</p>', 'Bathroom', '<p>Sprinkle on&nbsp;<strong>baking soda</strong>, scrub with a cloth or sponge, and rinse.&nbsp;<strong>Vinegar</strong>&nbsp;or&nbsp;<strong>kosher salt</strong>&nbsp;also work.</p>', '57cb5a122ce25.jpg', 'Pending'),
(60, 3, 'Lavender Disinfectant Spray', '<p>&nbsp;Great for cleaning the bathroom and toilet or anywhere you would usually use disinfectant or antibacterial spray.&nbsp;</p>', 'Bathroom', '<p>1/2 cup white vinegar</p>\r\n\r\n<p>6 drops of Lavender</p>\r\n\r\n<p>water</p>\r\n\r\n<p>Put all the lavender drops into the spray bottle and fill with white vinegar. &nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '57cd242b08751.jpg', 'Pending'),
(61, 3, 'Eucalyptus Oil All Purpose Cleaner', '<p>Great for showers, bench-tops and basins.</p>', 'Other', '<p>Ingredients</p>\r\n\r\n<p>15 drops of eucalyptus oil</p>\r\n\r\n<p>1/2 cup white vinegar water</p>\r\n\r\n<p>Add the eucalyptus oil and the vinegar to a clean spray bottle. &nbsp;Fill with tap water and mix. &nbsp;<br />\r\n&nbsp;</p>', '57cd251ddf623.jpg', 'Pending'),
(62, 3, 'How to Clean Your {Top Loader} Washing Machine Without Using Bleach', '<p>Very easy to clean without chemicals.</p>', 'Laundry', '<p>Ingredients</p>\r\n\r\n<p>2 cups Vinegar (plus 1 cup more if you have a fabric softener dispenser)<br />\r\n1/2 cup baking soda</p>\r\n\r\n<p>What you&#39;ll do:<br />\r\n<br />\r\n1. &nbsp;Fill your washing machine to the highest level with hot water then stop the machine (or you can be super frugal like me and do 1/2 hot and 1/2 warm).</p>\r\n\r\n<p>2. &nbsp;Pour 2 cups of vinegar and 1/2 cup baking soda right into the water.<br />\r\n<br />\r\n3. &nbsp;Turn your washing machine back on (remember you turned it off after you filled it up with water). &nbsp;Let it&nbsp;agitate&nbsp;for a few minutes then turn it back off again leaving the water/vinegar/baking soda mix in the washer.<br />\r\n<br />\r\n4. &nbsp;While it&#39;s sitting there soaking, get a washcloth and clean the outside with some&nbsp;<a href="http://www.lexienaturals.com/2011/10/natural-cleaning.html" target="_blank">Multi-Purpose Citrus Cleaner</a>. &nbsp;Make sure you get all around the top and the bleach dispenser (it should pop right off to make it easier to clean). &nbsp;Wipe down the inside of your machine using&nbsp;the washcloth and water from inside the machine. &nbsp;You won&#39;t have to scrub hard, but you will need to wipe the agitator and tub to get all the dirt and grime off. There will probably be a ring above and below the water line so make sure you get it all. &nbsp;You may need to spray your washcloth with some vinegar for added cleaning power.&nbsp;<br />\r\n<br />\r\n5. &nbsp;Fill the fabric softener dispenser full of vinegar and leave your machine alone for 30-60 minutes letting it soak. &nbsp;After it sits, turn it back on and let it finish the entire cycle including an extra rinse cycle.</p>', '57cd2757294cf.jpg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `privilege` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `privilege`) VALUES
(3, 'Raewynne', 'Scarlett', 'raewynne.scarlett@gmail.com', '$2y$10$4L4NiwVugHJr7.n2IyFADupQ5Sm6AHfaPNtkEPrerEjmrP/iIXW2y', 'admin'),
(4, 'Richard', 'hpa', 'richard.hpa@hotmail.com', '$2y$10$A8AzyVErNdGqis38oR/2V.cZtYtXngZyh.3Vx3oSir5HmHesnQfO2', 'user'),
(5, 'Patrick', 'Scarlett', 'go@gmail.com', '$2y$10$yJlHVeL19Su/stc/revw9.CAVTPw3q/hCASt3bPgS25Cfq5D.8YNG', 'user'),
(6, 'max', 'scarlett', 'max@diggers.com', 'password', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipe_database`
--
ALTER TABLE `recipe_database`
  ADD UNIQUE KEY `recipe_id_2` (`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `recipe_database`
--
ALTER TABLE `recipe_database`
  MODIFY `recipe_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe_database` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipe_database`
--
ALTER TABLE `recipe_database`
  ADD CONSTRAINT `recipe_database_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
