-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2024 at 02:56 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_clothes`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'on_hold',
  `user_id` int NOT NULL,
  `user_phone` int NOT NULL,
  `user_city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_adress` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_adress`, `order_date`) VALUES
(29, 37.00, 'delivered', 5, 652583234, 'تمارة', 'dzdzee', '2024-12-03 17:15:45'),
(30, 150.00, 'shipped', 5, 652583234, 'تمارة', 'dzefv', '2024-12-03 17:16:00'),
(31, 231.00, 'confirmed', 5, 652514912, 'تمارة', 'dz', '2024-12-03 17:43:42'),
(33, 150.00, 'delivered', 5, 2147483647, 'zde', 'zd', '2024-12-06 15:14:11'),
(35, 150.00, 'delivered', 5, 652514912, 'تمارة', 'azedze', '2024-12-06 15:15:32'),
(37, 231.00, 'untreated', 5, 652583234, 'azertyuiop', 'azertyuiop', '2024-12-19 19:45:34'),
(40, 150.00, 'untreated', 5, 652583234, 'temara', 'lklm:', '2024-12-19 19:56:29'),
(41, 37.00, 'untreated', 5, 652514912, 'تمارة', 'azertyuiop', '2024-12-20 17:10:39'),
(42, 268.00, 'untreated', 5, 652583234, 'azerty', 'azer', '2024-12-22 11:14:55'),
(46, 340.00, 'delivered', 5, 652583234, 'Temara', 'test, test, n00', '2024-12-22 12:44:41'),
(48, 54.00, 'untreated', 6, 652583234, 'test', 'test', '2024-12-22 13:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_price` decimal(6,2) DEFAULT NULL,
  `product_quantity` int DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `user_id`, `order_date`, `product_price`, `product_quantity`) VALUES
(23, 29, 3, 'Carhartt WIP pocket t-shirt in green\r\n\r\n', 'product1.webp', 5, '2024-12-03 17:15:45', 37.00, 1),
(24, 30, 2, 'Sports Shoes', 'featured2.jpg', 5, '2024-12-03 17:16:00', 150.00, 1),
(25, 31, 4, 'Carhartt WIP OG chore button up jacket in dark blue', 'product3.jpg', 5, '2024-12-03 17:43:42', 231.00, 1),
(27, 33, 2, 'Sports Shoes', 'featured2.jpg', 5, '2024-12-06 15:14:11', 150.00, 1),
(29, 35, 1, 'Sports Shoes', 'featured.jpg', 5, '2024-12-06 15:15:32', 150.00, 1),
(31, 37, 4, 'Carhartt WIP OG chore button up jacket in dark blue', 'product3.jpg', 5, '2024-12-19 19:45:34', 231.00, 1),
(34, 40, 2, 'Sports Shoes', 'featured2.jpg', 5, '2024-12-19 19:56:29', 150.00, 1),
(35, 41, 3, 'Carhartt WIP pocket t-shirt in green\r\n\r\n', 'product1.webp', 5, '2024-12-20 17:10:39', 37.00, 1),
(36, 42, 3, 'Carhartt WIP pocket t-shirt in green\r\n\r\n', 'product1.webp', 5, '2024-12-22 11:14:55', 37.00, 1),
(37, 42, 4, 'Carhartt WIP OG chore button up jacket in dark blue', 'product3.jpg', 5, '2024-12-22 11:14:55', 231.00, 1),
(45, 46, 2, 'Sports Shoes', 'featured2.jpg', 5, '2024-12-22 12:44:41', 150.00, 2),
(46, 46, 21, 'Fleece Hooded Sweatshirt', 'product_6767fde17e53d8.77654698.webp', 5, '2024-12-22 12:44:41', 10.00, 4),
(48, 48, 21, 'Fleece Hooded Sweatshirt', 'product_6767fde17e53d8.77654698.webp', 6, '2024-12-22 13:11:25', 10.00, 3),
(49, 48, 30, 'Cuffed Beanie', 'product_67680093363ef9.08916339.jpg', 6, '2024-12-22 13:11:25', 12.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_image4` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_category`) VALUES
(1, 'Sports Shoes', 'Découvrez ces chaussures de sport alliant confort et performance. Conçues avec des matériaux légers et respirants, elles offrent un excellent amorti pour protéger vos pieds et articulations. Parfaites pour toutes vos activités sportives, elles assurent un maintien optimal et une adhérence supérieure. Idéales pour les amateurs comme les professionnels en quête de style et de fonctionnalité', 'featured.jpg', 'featured.jpg', 'product2.avif', 'featured.jpg', 150.00, 'Men'),
(2, 'Sports Shoes', 'Découvrez ces chaussures de sport alliant confort et performance. Conçues avec des matériaux légers et respirants, elles offrent un excellent amorti pour protéger vos pieds et articulations. Parfaites pour toutes vos activités sportives, elles assurent un maintien optimal et une adhérence supérieure. Idéales pour les amateurs comme les professionnels en quête de style et de fonctionnalité', 'featured2.jpg', 'featured2.jpg', 'featured2.jpg', 'featured.jpg', 150.00, 'Men'),
(3, 'Carhartt WIP pocket t-shirt in green\r\n\r\n', '### Description du produit : **Carhartt WIP Pocket T-Shirt in Green**  \r\n\r\nLe t-shirt **Carhartt WIP Pocket** en vert est une pièce essentielle pour les amateurs de mode décontractée et fonctionnelle. Fabriqué avec soin par la marque emblématique Carhartt, ce vêtement allie style, confort et durabilité.\r\n\r\n#### Caractéristiques principales :\r\n- **Couleur** : Un vert profond et élégant, idéal pour une tenue décontractée ou superposée.\r\n- **Matériau** : Confectionné en coton doux et résistant, parfait pour un confort quotidien.\r\n- **Coupe** : Une coupe régulière qui offre un équilibre parfait entre style et aisance.\r\n- **Poche poitrine** : Équipé d\'une poche pratique sur la poitrine avec le logo Carhartt WIP brodé, ajoutant une touche de signature classique.\r\n- **Polyvalent** : Convient aussi bien pour les activités quotidiennes que pour un look casual chic.\r\n\r\n#### Avantages :\r\n- Résiste à l\'usure, fidèle à la réputation de la marque.\r\n- Un design minimaliste et intemporel qui se marie facilement avec différents styles.\r\n- Idéal pour les amateurs de vêtements fonctionnels et stylés.  \r\n\r\nAjoutez ce t-shirt Carhartt WIP à votre garde-robe pour un look décontracté et authentique.', 'product1.webp', 'product1a.jpg', 'product1b.webp', 'product1c.jpg', 37.00, 'Men'),
(4, 'Carhartt WIP OG chore button up jacket in dark blue', 'La veste Carhartt WIP OG Chore en bleu foncé est un incontournable de la garde-robe pour les amateurs de vêtements fonctionnels et élégants. Inspirée des vêtements de travail classiques, cette pièce combine un design robuste avec une esthétique intemporelle.\r\n\r\nCaractéristiques principales :\r\nCouleur : Un bleu foncé sophistiqué, parfait pour une tenue automnale ou hivernale.\r\nMatériau : Fabriquée à partir de toile de coton durable, offrant une excellente résistance à l\'usure tout en restant confortable.\r\nCoupe OG : Coupe originale légèrement ample, idéale pour une superposition avec des sweats ou des pulls.\r\nFermeture : Boutons sur le devant pour une fermeture rapide et un look authentique.\r\nPoches fonctionnelles : Équipée de plusieurs poches à l’avant, parfaites pour transporter vos essentiels ou ajouter un côté pratique.\r\nLogo signature : Écusson Carhartt WIP brodé sur l\'une des poches, symbole de qualité et d’authenticité.\r\nAvantages :\r\nPolyvalente, elle convient aussi bien pour un look urbain que pour une tenue décontractée.\r\nConçue pour durer grâce à des matériaux de haute qualité et une attention aux détails.\r\nInspirée de l\'héritage des vêtements de travail, elle apporte une touche utilitaire et élégante à votre style.', 'product3.jpg', 'product3.jpg', 'product3a.jpg', 'product3a.jpg', 231.00, 'Men'),
(5, 'New Balance 327 trainers in beige', 'Les sneakers New Balance 327 en beige sont une combinaison parfaite de style rétro et de design moderne. Inspirées des silhouettes de course des années 1970, ces baskets apportent une touche vintage à votre garde-robe tout en offrant un confort optimal.\r\n\r\nCaractéristiques principales :\r\nCouleur : Une teinte beige neutre et élégante, facile à assortir avec une variété de styles et de tenues.\r\nMatériaux :\r\nTige : En daim et textile pour un mélange parfait de texture et de respirabilité.\r\nSemelle intérieure : Confortable, conçue pour un port prolongé.\r\nSemelle extérieure distinctive : Une semelle en gomme avec une traction exagérée, emblématique du modèle 327, offrant une excellente adhérence.\r\nDesign asymétrique : Le grand logo \"N\" sur le côté apporte une signature audacieuse et unique.\r\nFermeture à lacets : Pour un ajustement personnalisé et sécurisé.\r\nAvantages :\r\nLégères et respirantes, elles conviennent aussi bien pour la marche que pour un usage quotidien.\r\nUn design polyvalent qui s’intègre aussi bien à des tenues décontractées qu’à des looks urbains.\r\nConfort et durabilité grâce à des matériaux de qualité.', 'women1.jpg', 'women1a.jpg', 'women1b.jpg', 'women1b.jpg', 116.00, 'Women'),
(6, 'Topshop faux leather super oversized bomber jacket with borg lining in brown', 'La veste Topshop Faux Leather Super Oversized Bomber Jacket en marron est une pièce audacieuse et tendance qui allie un style vintage à un confort moderne. Conçue pour offrir une allure décontractée, cette veste est idéale pour l’automne et l’hiver.  Caractéristiques principales : Matériau extérieur : En similicuir de haute qualité, offrant un look chic sans compromettre l\'éthique. Finition texturée pour un effet authentique. Doublure Borg : Intérieur doublé en borg doux et chaud, parfait pour les journées fraîches. Coupe : Une coupe super oversized qui apporte une esthétique décontractée et permet une superposition facile. Couleur : Un marron riche et classique qui se marie avec toutes les palettes automnales. Fermeture : Fermeture éclair robuste sur le devant pour un look utilitaire et une fonctionnalité pratique. Détails : Col montant doublé en borg pour une chaleur supplémentaire. Poignets et ourlets côtelés pour un ajustement confortable. Avantages : Un design oversized qui convient à tous les types de morphologies et ajoute une touche contemporaine. Chaude et confortable grâce à la doublure borg, parfaite pour affronter le froid avec style. Polyvalente, elle peut être portée aussi bien avec des tenues décontractées qu’avec des looks plus sophistiqués.', 'women2.jpg', 'women2.jpg', 'women2a.jpg', 'women2a.jpg', 84.00, 'Women'),
(7, 'Rolex Submariner Stainless Steel Yellow Gold Watch Diamond Dial 116613', 'The Rolex Submariner 116613 is a prestigious timepiece known for its robust functionality and luxurious design, making it a standout piece in the Submariner collection.\r\n\r\nKey Features:\r\nMaterial: Crafted from a combination of stainless steel and 18k yellow gold, showcasing Rolex\'s signature two-tone style (Rolesor).\r\nDial: A striking diamond-set dial adds a touch of sophistication and opulence.\r\nBezel: Unidirectional rotatable bezel with a ceramic insert for durability and scratch resistance, perfect for diving purposes.\r\nCase: 40mm Oyster case, waterproof up to 300 meters (1,000 feet), ensuring reliability under extreme conditions.\r\nMovement: Powered by the Rolex Caliber 3135, a self-winding mechanical movement known for its precision and reliability.\r\nBracelet: Oyster bracelet with a combination of polished and brushed links, equipped with a Glidelock clasp for easy adjustments.\r\nDesign Highlights:\r\nA harmonious blend of sportiness and elegance, suitable for both formal occasions and underwater adventures.\r\nThe diamond hour markers enhance its luxurious appeal while maintaining legibility.\r\nPerformance:\r\nCertified Superlative Chronometer, ensuring exceptional accuracy and durability.\r\nEquipped with a Parachrom hairspring, resistant to shocks and temperature variations.\r\nThe Rolex Submariner 116613 is more than just a watch—it\'s a symbol of sophistication, durability, and timeless style. Perfect for collectors and enthusiasts seeking a versatile yet luxurious timepiece.', '4.jpg', '4.jpg', '4.jpg', '4.jpg', 100.00, 'Accessory'),
(21, 'Fleece Hooded Sweatshirt', '**Fleece Hooded Sweatshirt**\r\n\r\nThis cozy fleece hooded sweatshirt is the perfect combination of comfort and style. Made from soft, high-quality fleece fabric, it provides warmth and a relaxed fit, making it ideal for cooler days. The sweatshirt features a spacious hood with adjustable drawstrings, along with a front pocket for added convenience.\r\n\r\nWhether you\'re lounging at home or out for a casual outing, this hoodie will keep you snug and stylish. Its versatile design can easily be paired with jeans, leggings, or joggers, offering a laid-back look that’s perfect for any casual occasion.', 'product_6767fde17e53d8.77654698.webp', 'product_6767fde17e8092.93315700.webp', 'product_6767fd35c2a244.37728577.webp', 'product_6767fd35c2e948.85304047.webp', 10.00, 'Men'),
(22, 'Long-Sleeve Elongated T-Shirt', '**Long-Sleeve Elongated T-Shirt**  \r\n\r\nThis long-sleeve elongated T-shirt is the perfect blend of comfort and contemporary fashion. Designed with a relaxed fit and extended length, it adds a modern edge to any outfit.  \r\n\r\nMade from soft and breathable fabric, it ensures all-day comfort, whether you\'re out and about or lounging at home. The long sleeves provide extra coverage, making it suitable for cooler weather or layering.  \r\n\r\nAvailable in a range of colors, this versatile T-shirt is perfect for creating stylish casual or streetwear-inspired looks.', 'product_6767fe34594812.99553149.webp', 'product_6767fe34598488.67579173.webp', 'product_6767fe3459ba36.96280041.jpg', 'product_6767fe3459f127.08815377.jpg', 20.00, 'Women'),
(23, 'High-Waisted Skinny Jeans', '**High-Waisted Skinny Jeans**\r\n\r\nThese high-waisted skinny jeans are a wardrobe essential for a sleek and stylish look. Designed to hug your curves, they offer a flattering fit that enhances your silhouette.  \r\n\r\nCrafted from a blend of soft, stretchy denim, they provide both comfort and flexibility, making them perfect for all-day wear. The high-rise waist accentuates your figure and pairs effortlessly with crop tops, blouses, or tucked-in shirts.  \r\n\r\nVersatile and timeless, these skinny jeans can be dressed up with heels for a night out or paired with sneakers for a casual vibe. A must-have for every fashion-forward wardrobe!', 'product_6767fe7d864781.40093073.webp', 'product_6767fe7d8703a7.82783718.webp', 'product_6767fe7d876b87.19332030.webp', 'product_6767fe7d87a6c3.32927290.webp', 25.00, 'Women'),
(24, 'Flowy Blouse', '**Flowy Blouse**\r\n\r\nElevate your wardrobe with this elegant flowy blouse, designed for both comfort and sophistication. Its lightweight, airy fabric drapes beautifully, providing a relaxed yet polished look.  \r\n\r\nFeaturing a versatile silhouette, this blouse pairs effortlessly with tailored trousers for work or jeans for a casual outing. The fluid design ensures ease of movement, making it perfect for any occasion.  \r\n\r\nWhether styled with accessories for a chic evening look or worn simply for a minimalist vibe, this flowy blouse is a timeless addition to your collection.', 'product_6767febc0fa856.25636058.webp', 'product_6767febc1035e5.59701594.webp', 'product_6767febc106c40.29512954.jpg', 'product_6767febc10a849.57520760.webp', 24.00, 'Women'),
(25, 'Faux Shearling Sweatshirt', '**Faux Shearling Sweatshirt**\r\n\r\nStay cozy and stylish with this faux shearling sweatshirt, designed to keep you warm while adding a touch of elegance to your casual wardrobe. Made from soft, plush faux shearling fabric, it mimics the look and feel of real lamb’s wool for ultimate comfort.  \r\n\r\nThe relaxed fit and cozy texture make it perfect for chilly days, whether you’re lounging at home or heading out. Pair it with jeans or leggings for a casual yet chic look.  \r\n\r\nThis sweatshirt is a must-have for anyone seeking warmth, comfort, and effortless style during the colder months.', 'product_6767ff078e3597.42314715.jpg', 'product_6767ff078ed2d9.22650530.webp', 'product_6767ff078f0718.21040782.webp', 'product_6767ff078f3c72.10792860.webp', 50.00, 'Women'),
(26, 'Solid Gavroche Beret', '**Solid Gavroche Beret**\r\n\r\nThis classic solid-colored Gavroche beret adds a chic and timeless touch to any outfit. Made from soft, high-quality fabric, it offers both comfort and style. The beret’s versatile design can be paired with a variety of looks, from casual to more sophisticated, giving you the perfect accessory for any occasion.\r\n\r\nWith its relaxed fit and stylish silhouette, this beret is ideal for cooler days and a great addition to your accessory collection. Elevate your look effortlessly with this essential piece.', 'product_6767ff79b56f43.85077027.webp', 'product_6767ff79b5c505.31733682.jpg', 'product_6767ff79b61522.44216139.webp', 'product_6767ff79b69612.95124946.jpg', 12.00, 'Accessory'),
(27, 'Quilted Shoulder Bag', '**Quilted Shoulder Bag**\r\n\r\nThis elegant quilted shoulder bag combines style and practicality. Designed with a textured, diamond-patterned finish, it adds a sophisticated touch to any outfit. The bag features an adjustable shoulder strap for comfort and convenience, making it perfect for everyday use or a night out.\r\n\r\nWith its spacious interior and sleek design, this bag offers both functionality and fashion. Whether you\'re heading to work, a casual outing, or a special event, the quilted shoulder bag is the ideal accessory to complete your look.', 'product_6767ffbd4121c6.28133459.webp', 'product_6767ffbd416331.66713172.webp', 'product_6767ffbd4198e3.94443824.webp', 'product_6767ffbd41d118.61825232.jpg', 23.00, 'Accessory'),
(28, 'Cable Knit Sweater', '**Cable Knit Sweater**\r\n\r\nThis cozy cable knit sweater is a must-have for any wardrobe. Featuring a classic textured design with intricate twisted cables, it offers a stylish yet comfortable fit. Made from soft, breathable material, this sweater is perfect for layering during cooler months or wearing on its own for a relaxed, chic look.\r\n\r\nThe timeless design makes it versatile for both casual and semi-formal outfits, while the ribbed cuffs and hem ensure a snug fit. Whether paired with jeans or a skirt, the cable knit sweater adds warmth and style to any ensemble.', 'product_67680001bf23f1.07888590.jpg', 'product_67680001bfec17.17717547.webp', 'product_67680001c020e9.94900004.webp', 'product_67680001c051a6.22279137.jpg', 31.00, 'Men'),
(29, 'Straight-Leg Joggers', '**Straight-Leg Joggers**\r\n\r\nThese straight-leg joggers combine comfort with style, making them perfect for both lounging and casual outings. Featuring a relaxed fit through the legs, they offer a flattering silhouette without being too tight or too loose. The soft fabric provides a comfortable feel, while the elastic waistband with drawstrings ensures a secure and adjustable fit.\r\n\r\nThe simple design is complemented by side pockets, perfect for storing small essentials. Whether paired with a casual t-shirt or a cozy sweatshirt, these joggers are an ideal addition to any casual wardrobe.', 'product_6768004a86de12.00602222.webp', 'product_6768004a871cd3.98235723.webp', 'product_6768004a8751b2.98672958.webp', 'product_6768004a878a12.41453225.webp', 18.00, 'Women'),
(30, 'Cuffed Beanie', '**Cuffed Beanie**\r\n\r\nThis cuffed beanie is the perfect accessory for staying warm and stylish during the colder months. Made from soft, stretchy fabric, it offers a snug fit that ensures comfort and warmth. The cuffed design adds a trendy touch while allowing you to adjust the length of the beanie for a personalized fit.\r\n\r\nIts versatile design makes it easy to pair with any winter outfit, whether you\'re going for a casual or more fashionable look. The beanie is available in a range of colors, making it a great addition to your seasonal wardrobe.', 'product_67680093363ef9.08916339.jpg', 'product_67680093367bf0.19002391.jpg', 'product_6768009336e1b1.60369087.webp', 'product_67680093372f07.16166800.webp', 12.00, 'Accessory'),
(31, 'Western Style Belt', '**Western Style Belt**\r\n\r\nThis Western-style belt combines rugged charm with classic elegance, perfect for adding a bold touch to your outfit. Crafted from high-quality leather, it features intricate detailing and a sturdy buckle that captures the essence of Western fashion. The design includes embossed patterns and metal accents, giving it a distinctive look that\'s both timeless and trendy.\r\n\r\nIdeal for pairing with jeans, skirts, or dresses, this belt effortlessly enhances any casual or semi-casual outfit. Whether you\'re channeling a country-inspired style or simply want to add some flair to your wardrobe, this Western-style belt is a versatile accessory that stands out.', 'product_676800e2cd7f24.90390129.jpg', 'product_676800e2cdbb92.73304884.webp', 'product_676800e2cdece8.80675986.jpg', 'product_676800e2ce20a2.21995551.webp', 16.00, 'Accessory'),
(32, 'Linen Blend Shirt', '**Linen Blend Shirt**\r\n\r\nThis linen blend shirt offers the perfect balance of comfort and breathability. Made from a high-quality mix of linen and other fibers, it provides a lightweight, soft feel while keeping you cool even on warm days. The classic design features a button-down front, long sleeves, and a relaxed fit for a comfortable, laid-back look.\r\n\r\nIdeal for casual outings or layering over a t-shirt, this shirt can be dressed up or down depending on the occasion. Its natural texture and breathable fabric make it a great choice for summer or transitional seasons, adding a touch of sophistication to your wardrobe.', 'product_67680330c3b0b2.14297417.webp', 'product_67680330c3f089.07808579.webp', 'product_67680330c42a34.39811994.webp', 'product_67680330c45d93.11734753.webp', 29.00, 'Men'),
(35, 'Corduroy Fanny Pack', 'This stylish corduroy fanny pack combines fashion and function, offering a trendy way to carry your essentials hands-free. Made from soft, durable corduroy fabric, it has a unique textured look that adds depth and character to any outfit. The adjustable strap ensures a comfortable fit, while the compact design allows for easy storage of your phone, keys, and small accessories.\r\n\r\nPerfect for casual outings, festivals, or travel, this fanny pack adds a vintage vibe to your ensemble. The rich texture of the corduroy fabric elevates the simple design, making it both practical and fashionable.', 'product_67681072849f15.82425357.webp', 'product_6768107284e964.71634226.webp', 'product_67681072852496.98033926.jpg', 'product_67681072855921.09113995.webp', 15.00, 'Accessory');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Contraint` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(5, 'Teljaoui Mohamed', 'teljaoui@gmail.com', '7682fe272099ea26efe39c890b33675b'),
(6, 'Test Test', 'test@gmail.com', '7682fe272099ea26efe39c890b33675b'),
(7, 'nawfal', 'nawfal@gmail.com', '7682fe272099ea26efe39c890b33675b'),
(8, 'Youssef Teljaoui', 'youssef@gmail.com', '7682fe272099ea26efe39c890b33675b'),
(9, 'admin', 'admin', '7682fe272099ea26efe39c890b33675b'),
(10, 'anas anas ', 'anas@gmail.com', '7682fe272099ea26efe39c890b33675b');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
