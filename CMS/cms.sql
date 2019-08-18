-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 08:02 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'PHP'),
(2, 'Java'),
(3, 'Python'),
(4, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) DEFAULT NULL,
  `comment_author` varchar(255) DEFAULT NULL,
  `comment_email` varchar(255) DEFAULT NULL,
  `comment_content` text,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 2, 'Vaibhaw Samrat', 'samratv@hotmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-22'),
(2, 2, 'Vaibhaw Samrat', 'samratv@hotmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-22'),
(3, 1, 'Vaibhaw Samrat', 'samratv@hotmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-22'),
(4, 1, 'Vaibhaw Samrat', 'samratv@hotmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-22'),
(5, 8, 'Edward Kennway', 'ejk16@gmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-27'),
(6, 8, 'Edward Kennway', 'ejk16@gmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-27'),
(7, 8, 'Vaibhaw Samrat', 'samratv@hotmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', 'approved', '2018-02-27'),
(8, 8, 'Edward Kennway', 'ejk16@gmail.com', '<p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p>', 'approved', '2018-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_category_id` int(11) DEFAULT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_content` text,
  `post_image` text,
  `post_view_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_category_id`, `post_author`, `post_status`, `post_date`, `post_tags`, `post_content`, `post_image`, `post_view_count`) VALUES
(1, 'PHP', 1, 'Vaibhaw Samrat', 'published', '2018-02-21', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '1.jpg', 0),
(2, 'Java', 2, 'Vaibhaw Samrat', 'published', '2018-02-21', 'Java', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '2.jpg', 0),
(3, 'Java', 2, 'Vaibhaw Samrat', 'published', '2018-02-21', 'Java', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '2.jpg', 0),
(4, 'PHP', 1, 'Vaibhaw Samrat', 'published', '2018-02-21', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '1.jpg', 0),
(5, 'PHP', 1, 'Vaibhaw Samrat', 'published', '2018-02-21', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '1.jpg', 0),
(6, 'Java', 2, 'Vaibhaw Samrat', 'published', '2018-02-21', 'Java', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '2.jpg', 0),
(7, 'Java', 2, 'Vaibhaw Samrat', 'published', '2018-02-21', 'Java', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '2.jpg', 0),
(8, 'PHP', 1, 'Vaibhaw Samrat', 'published', '2018-02-21', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '1.jpg', 2),
(9, 'PHP', 1, 'Vaibhaw Samrat', 'published', '2018-02-21', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed vehicula sapien, id condimentum dui. Donec rhoncus vel nulla ac posuere. Pellentesque id augue quis risus varius condimentum ac eu lectus. Nullam in pretium orci, in congue ligula. Morbi pellentesque eros varius justo euismod, a congue purus iaculis. Aenean posuere metus et neque feugiat sodales. Proin ut dignissim quam. Aliquam eu imperdiet velit. Quisque vulputate blandit justo, egestas venenatis ante accumsan et. Aliquam et posuere arcu.</p><p>Integer rhoncus, ligula ut elementum convallis, eros velit convallis nunc, et convallis justo ligula varius elit. Fusce et sapien vel massa pulvinar viverra. Integer faucibus id purus in commodo. Vestibulum auctor egestas vulputate. Aliquam erat volutpat. Maecenas lobortis metus quis urna iaculis gravida. Aliquam erat volutpat. Phasellus id enim at ante dignissim interdum. Pellentesque turpis neque, ultrices non faucibus in, vulputate vel sem. Nunc ipsum lorem, scelerisque ac rutrum nec, vehicula vitae massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus pharetra congue diam, sed cursus magna dictum vitae. In aliquam lorem eget quam pretium, id interdum nunc tristique. Vivamus at tempus ligula, eget dignissim est. Pellentesque dapibus, leo nec sagittis fringilla, metus augue cursus orci, ac dictum mauris libero vitae sem. Nam dignissim porttitor purus, ut auctor sem consequat quis.</p><p>Vivamus scelerisque molestie tempus. Quisque interdum mi nec eros aliquam lobortis. Fusce convallis venenatis est, ut auctor augue condimentum eget. Nulla blandit massa sed facilisis fermentum. Quisque blandit neque nec quam bibendum, sit amet dignissim dolor lacinia. Etiam eget libero nec massa imperdiet dignissim vitae ut neque. Nullam luctus risus neque, in dapibus arcu fringilla vitae. Suspendisse id turpis eros. Nulla vestibulum dui et diam facilisis convallis. Sed et dolor pulvinar enim scelerisque pulvinar nec in enim. Maecenas fermentum quam ipsum, in malesuada lacus fermentum a. Aliquam a mi efficitur nulla volutpat cursus nec et nisi. Ut facilisis fringilla elit eget lobortis. Morbi lectus lorem, lobortis ut orci sit amet, tempus sodales est. Phasellus vel lorem in libero scelerisque hendrerit accumsan quis magna. Ut pellentesque urna sit amet massa imperdiet, quis congue elit dictum.</p><p>Sed hendrerit id velit nec tincidunt. Proin erat nisi, blandit id massa non, feugiat lobortis nisl. Nullam a dui nisl. Sed nec tincidunt magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec fringilla laoreet felis, finibus iaculis felis. Sed molestie tristique tellus eget dapibus. Phasellus commodo consectetur nunc sit amet aliquam. Pellentesque faucibus ex id justo lobortis, at porttitor magna mollis.</p><p>Aenean purus quam, dapibus facilisis suscipit et, auctor non urna. Morbi tincidunt, libero at accumsan scelerisque, nibh dolor convallis eros, auctor congue neque odio a dolor. Curabitur auctor pulvinar euismod. Vivamus id nunc ligula. In laoreet enim sit amet iaculis consectetur. Suspendisse sagittis congue libero, nec lacinia dolor dictum vitae. Vestibulum mattis dolor quis elementum dignissim. Suspendisse hendrerit magna at dolor vestibulum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis dui nec ligula condimentum tincidunt.</p>', '1.jpg', 3),
(10, 'VS', 1, 'Vaibhaw Samrat', 'published', '2018-06-14', 'PHP', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>', '4380e7ed098106a2408dcdbb5185f76b1528956640background.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'subscriber',
  `user_email` text,
  `user_password` text,
  `account_created` date DEFAULT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `username`, `user_role`, `user_email`, `user_password`, `account_created`, `token`) VALUES
(1, 'Vaibhaw', 'Samrat', 'SamratV', 'admin', 'samratv@hotmail.com', '$2y$12$hxhN9vMhIym5N3wG5X6ZLul8smrC387xeJosV64XorIBMqpLhr47y', '2018-02-21', '4457db718d8a81daed69f22af07aac5eed6819438296921e0720ae810d84a88d7b116a4338c340d94284c5ac602b440037b214733bdddae341e0042d2f550156491233e46619afa4b175bd229130add454f39088a974d02d7a0dc7b3c4a5f6ad4fa074234457db718d8a81daed69f22af07aac5eed6819438296921e0720ae810d84a88d7b116a4338c340d94284c5ac602b440037b2'),
(3, 'Vaibhaw', 'Samrat', 'VS1234', 'admin', 'vaibhawsky@gmail.com', '$2y$12$m8dGpCZJgDH66r/WUb8c8erroxO1q1iY91MO.tmfuDzCOutEUD3dm', '2018-02-21', '886d6b6bbe18a83450640ab856da107322872519bb36b0128ec86b5d33d8304db0a0e650a0b6e1bf0c706c6503119738710d27982ca651bd41118e6ade01e709a64861808909fa8642a7a55ccb4a11af0aeeb59176183f73ce523ff32a806b7fbffdd411886d6b6bbe18a83450640ab856da107322872519bb36b0128ec86b5d33d8304db0a0e650a0b6e1bf0c706c6503119738710d'),
(9, 'xyz', 'xyz', 'xyz123', 'subscriber', 'xyz@gmail.com', '$2y$12$tnvXM.y1lJCuXqPlLn/i9O1ad2.V/jTbH1rvjeQcfJQRlaUp2ze5K', '2018-03-17', NULL),
(10, 'Edward', 'Kenway', 'James16', 'subscriber', 'ejk16@gmail.com', '$2y$12$hEFeGVl7Tk.UoxUZ5llPR.kKrUfRphc5LLPyGLdEkkv0kzjDtW76C', '2018-03-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `session` text,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`session`, `time`) VALUES
('SamratV', 1566115366);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
