-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 08:34 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Name` varchar(70) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project descriptions`
--

CREATE TABLE `project descriptions` (
  `Name` varchar(50) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `Description` varchar(2500) NOT NULL,
  `Month Finished` date NOT NULL COMMENT 'The day is going to be the first of the month because I do not remember the exact days and it is not important for sorting',
  `Programming Languages` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project descriptions`
--

INSERT INTO `project descriptions` (`Name`, `Link`, `Description`, `Month Finished`, `Programming Languages`) VALUES
('Boggle', 'https://github.com/johnfelen/Boggle', 'The Boggle project is one of the prouder Java projects I wrote for a class.  &nbsp;I used recursion to search through the Boggle board and wrote an add and search method for a De La Briandais trie.  &nbsp;There are six different boards with "*" denoting a wild card and two types of dictionaries, simple and a De La Briandais one.  &nbsp;Since there are so many possible words and all words are printed when the game is over, you may not be able to scroll up to the board when the game is over.  &nbsp;It can be compiled in command prompt using "javac MyBoggle.java".  &nbsp;It can be run by typing "java MyBoggle -b &lt;board text file&gt; -d &lt;dictionary type&gt;" in either order.  &nbsp;For example, if you wanted to run it with board 1 using a simple dictionary you could type: "java MyBoggle -d simple -b board1.txt".  &nbsp;Disclaimer: All boards.txt, dictionary.txt, DictionaryInterface.java, and SimpleDictionary.java were provided.  ', '2014-09-30', 'Java'),
('Chat Server', 'https://github.com/johnfelen/Chat-Server', 'The Chat Server was another interesting and challenging program I wrote for a class because I had never had to use sockets nor programmed using cryptography, before.  &nbsp;Like the name of the project describes, this project was a chat service that encrypted messages so only people in the chat room could read them.  &nbsp;To compile the server and client type "javac SecureChatServer.java" and "javac SecureChatClient.java" respectively.  &nbsp;To use the server and clients, first run the server with "java SecureChatServer".  &nbsp;Then you can run several clients by typing "java SecureChatClient" in separate command prompts.  &nbsp;Use "localhost" as the server if you are just running on your own machine. &nbsp;Disclaimer: SecureChatServer.java, SymCipher.java, and keys.txt were provided.  ', '2014-11-30', 'Java'),
('File System', 'https://github.com/johnfelen/File-System', 'This simple two-level directory file system with a block size of 512 bytes was built using FUSE as a final project.  &nbsp;My file system would mount at a directory and then faux as root while accessing files inside of it.  &nbsp;Before writing this project I was indifferent to C.  &nbsp;However, after finishing this project I really grew to like C because of how exciting it was to actually get my favorite bare-bones text editor, nano, to create, open and save a new file using my file system.  &nbsp;Disclaimer: I am not sure if this code will work with multiple blocks because I ran out of time to test files larger than 512 bytes.  &nbsp;Also, this code will not compile or run by itself so it is just example of my C code.  ', '2014-12-31', 'C'),
('FoodChain Base Page', 'https://github.com/johnfelen/FoodChain-Base-Page', 'FoodChain is a social media network that I co-founded.  &nbsp;Although I am no longer part of the company, while I was the Chief Product Officer I was in charge of designing familiarity between different platforms.  &nbsp;I took the lead to make the Android application and the website have a similar layout scheme and object design with relative positions.  &nbsp;I built most of the front end for the web application, beta website, and part of an Administrator Dashboard using HTML and CSS.  &nbsp;I also wrote a lot of the JavaScript for database communication from the front-end web application in conjunction with the Parse API.  &nbsp;However, this JavaScript is not shown in this base example of the web application.  &nbsp;The link is to the web application that I coded in a week.  ', '2014-12-31', 'JavaScript'),
('Hangman', 'https://github.com/johnfelen/Hangman', 'One weekend I decided to teach myself Ruby by diving right into a project.  &nbsp;A handful of hours later, I rose out of the coding pool with a Hangman game that has 6 chances, one for each part of the man being hung.  &nbsp;I had the program print out gallows every time a word is guessed and list the letters that you have tried.  &nbsp;To run it you would just type "ruby Hangman.rb" in the command prompt.  ', '2015-01-31', 'Ruby'),
('Partner Up', 'https://github.com/johnfelen/Partner-Up', 'I had to make random partners when I was a Undergraduate Teaching Assistant in Software Quality Assurance.  &nbsp;To do this project, I decided that Ruby would be a good language since I could get more practice with it after Hangman.  &nbsp;To keep the emails for the students in class private I have made a sample "Student Emails.txt".  &nbsp;The format for this text would be one email per line, and the program assumes that there is an even amount of students.  &nbsp;The program also relies on a text file for the body with the format of "Email &lt;Project Name&gt; &lt;Number of Project&gt;.  &nbsp;I have provided one email in the form as "Email Deliverable 1.txt".  &nbsp;Furthermore, Outlook may or may not ask for your permission, depending on your settings, to send the emails. &nbsp;You would run the program by typing "ruby Partner Up.rb" in the command prompt.  ', '2015-02-28', 'Ruby'),
('Personal Website', 'https://github.com/johnfelen/Personal-Website', 'This project is of my personal website which is at <a href="http://www.johnfelen.com">www.johnfelen.com</a>.  &nbsp;If you are on my website, I hope you have enjoyed the show.  &nbsp;This website is a hub for my small social media presence and extension of my r&eacute;sum&eacute, LinkedIn, and GitHub.  &nbsp;At first, this website was just a fully front-end website but after taking the Programming Languages for Web Applications I updated it to have server side functionality with a myriad of other functionality updates.  &nbsp;The current iteration of the website uses HTML5, CSS3(preprocessed using SASS), Bootstrap, JavaScript(and jQuery), PHP and a bit of MySQL(all of these entries in my portfolio are stored in a database).  &nbsp;While creating this project I learned to some degree, and for the most part taught myself, SASS, CSS3 animations, jQuery, AJAX, Grunt task running, and PHP.  &nbsp;It is easier to look through the website than read a description about it, so have a look around.  ', '2016-05-31', 'PHP JavaScript'),
('Radix Sort', 'https://github.com/johnfelen/Radix-Sort', 'One weekend I wanted to code a sorting algorithm.   &nbsp;I chose my favorite sorting algorithm: Radix Sort.  &nbsp;To kill two birds with one stone, I chose to write it in JavaScript to learn the pseudo-object oriented programming it offers.  &nbsp;If you are using node.js, it can be run in the command line by typing "node radix-sort.js -r &lt;input array file&gt; -w &lt;output array file&gt;" in either order.  &nbsp;Both -r and -w command line arguments are optional but I included "input-arrays.txt" and "output-arrays.txt" as sample input and output array files, respectively.  ', '2015-11-30', 'JavaScript'),
('SCAR', 'https://github.com/johnfelen/SCAR', 'Scatter Conceal and Recover, or SCAR for short, was the research project that two other students and I worked on during the 2015 summer semester.  &nbsp;We also built an Android application to use the algorithm, on GitHub.  &nbsp;This project uses the Reed-Solomon algorithm of bit redundancy, databases, and a splish-splash of cryptography to securely break files into N parts but only need k parts to recreate the file.  &nbsp;In other words: magic.  &nbsp;A high level overview of the project is that the algorithm will encrypt a file using and AES key that we get from SHA-256 hashing some unique information together.  &nbsp;Then, the newly encrypted file will have redundancy added to it using the Reed-Solomon algorithm.  &nbsp;This encrypted file is then broken up into N parts, which is also done by Reed-Solomon, and each of these N parts are stored randomly on the known databases(MySQL, Dropbox etc).  &nbsp;A hash-chain is used to figure out what server each chunk gets stored on.  &nbsp;The reverse is done to retrieve the file, but the interesting part is that we only need k out of N total file chunks to run the algorithm in reverse and get the original file back.  &nbsp;To compile and run you will need an Android IDE with an emulator.  &nbsp;The basic one that I used was Android Studio and Genymotion, respectively, and you would click the green play button to compile and run the program.  ', '2015-08-31', 'Java'),
('Secure File Sharing', 'https://github.com/johnfelen/Secure-File-Sharing', 'This project was for my Applied Cryptography class.  &nbsp;Two other students and I worked on it together.  &nbsp;The point of the project was to protect from given threats, and at the end think of our own threats and protect against them.  &nbsp;A simple example is that we would use RSA signatures so that a user could not modify or forge their Token(data structure that holds user information and rights).  &nbsp;The three write ups under "docs" on GitHub have a much more in-depth analysis and explanation on what we implemented and why we implemented it. &nbsp;The instructions on how to run and compile the project are also under "docs".  ', '2015-04-30', 'Java'),
('Significant Figures', 'https://github.com/johnfelen/Significant-Figures', 'To get some practice with JavaScript on the command prompt with node.js, I wrote a program to count the significant figures in numbers.  &nbsp;When I wrote this program I already knew how to code in JavaScript but only to assist HTML, not to run a program by itself.  &nbsp;The program can take any amount of command line arguments as significant figures with each of them being separated by a space.  &nbsp;If you want to enter a number in scientific notation use "e<magnitude><exponent>."  &nbsp;For example, if you want to enter "3.45 * 10^8" in type "3.45e+8".  &nbsp;The program assumes that there is only one decimal point in the number, accepts commas in numbers, and it does not matter if there is a zero before the decimal point or not, in numbers less than zero.  &nbsp;To run the program, type "node significant-figures.js &lt;number&gt; &lt;number&gt; &lt;etc&gt;" in the command prompt.  ', '2015-01-31', 'JavaScript');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `project descriptions`
--
ALTER TABLE `project descriptions`
  ADD PRIMARY KEY (`Name`),
  ADD UNIQUE KEY `Link` (`Link`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
