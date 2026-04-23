-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 04:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdb555`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `course_desc` text NOT NULL,
  `course_category` text NOT NULL,
  `course_author` varchar(255) NOT NULL,
  `course_img` text NOT NULL,
  `course_duration` text NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_original_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `course_category`, `course_author`, `course_img`, `course_duration`, `course_price`, `course_original_price`) VALUES
(31, 'web devlopment', 'Learn how to build modern and responsive websites from scratch. Start with the basics like HTML, CSS, and JavaScript, then move to advanced topics such as PHP for backend and React for frontend development. Perfect for beginners and aspiring developers who want to create professional web applications.', 'Technology', 'LearnCode.academy', '../image/courseimg/Web Development.jpg', '4', 500, 5000),
(34, 'Flutter App Development', 'Learn how to build fast, beautiful, and cross-platform mobile apps using Flutter. This tutorial covers the basics of Dart, widgets, layouts, and state management to help you create apps for both Android and iOS with a single codebase.', 'Technology', ' Code With Dhruv', '../image/courseimg/Flutter App Development.webp', '2', 250, 2000),
(39, 'Cyber Security', 'Learn the essentials of Cyber Security to protect systems, networks, and data from online threats. This course covers the basics of security concepts, ethical hacking, encryption, malware protection, and safe practices for individuals and organizations.', 'Technology', 'Simplilearn', '../image/courseimg/Cyber security.jpg', '1', 1500, 20000),
(40, 'Business Communication', 'Learn the skills of effective business communication to share ideas clearly and professionally. This course covers verbal and written communication, workplace etiquette, presentations, and strategies for building strong professional relationships.', 'Personal Growth', 'DWIVEDI GUIDANCE', '../image/courseimg/Business Communication.jpg', '9', 2100, 25000),
(41, 'Time Management', 'Learn the art of time management to use your time effectively and productively. This course covers goal setting, prioritization, planning, and techniques to overcome procrastination for better personal and professional success.', 'Personal Growth', 'SeeKen', '../image/courseimg/Time Management.jpg', '6', 1500, 3000),
(42, 'UI-UX Design', 'Learn the essentials of UI (User Interface) and UX (User Experience) Design to create visually appealing, user-friendly, and engaging digital products. This course covers design principles, wireframing, prototyping, usability testing, and tools like Figma and Adobe XD. Build skills to design apps and websites that deliver both beauty and functionality.', 'Creative & Design', 'Learnify', '../image/courseimg/UI-UX Design.webp', '2', 3000, 31000),
(43, 'Digital Marketing', 'Learn the strategies and tools of digital marketing to promote products and services online. This course covers SEO, social media marketing, email marketing, content marketing, PPC, and analytics to help you reach the right audience and grow your business effectively.', 'vocational Skills', 'edureka!', '../image/courseimg/Digital Marketing.jpg', '10', 4500, 19000);

-- --------------------------------------------------------

--
-- Table structure for table `courseorder`
--

CREATE TABLE `courseorder` (
  `co_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courseorder`
--

INSERT INTO `courseorder` (`co_id`, `order_id`, `stu_email`, `course_id`, `course_name`, `amount`, `order_date`) VALUES
(35, 'ORDS38667570', 'jeelgolakiya@gmail.com', 31, 'web devlopment', 500, '2025-08-14'),
(36, 'ORDS53564338', 'sahilvala@gmail.com', 34, 'Flutter App Development', 250, '2025-08-16'),
(37, 'ORDS45490274', 'gauravvekariya@gmail.com', 42, 'UI-UX Design', 3000, '2025-08-17'),
(38, 'ORDS16179134', 'gauravvekariya@gmail.com', 43, 'Digital Marketing', 4500, '2025-08-18'),
(39, 'ORDS87045750', 'jevingolakiya@gmail.com', 40, 'Business Communication', 2100, '2025-08-18'),
(40, 'ORDS14739808', 'jevingolakiya@gmail.com', 41, 'Time Management', 1500, '2025-08-20'),
(41, 'ORDS59233618', 'janvithakur@gmail.com', 39, 'Cyber Security', 1500, '2025-08-21'),
(42, 'ORDS83468469', 'hilsavani@gmail.com', 34, 'Flutter App Development', 250, '2025-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_content` text NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `f_content`, `stu_id`) VALUES
(14, 'my name is jeel golakiya. this web-site is very usefull for me because i learn web-devlopment from this website.', 44),
(15, 'learning web-site is best for all type of course.', 46),
(16, 'well courses in this site. usfull in my bussiness career. thanks learning!\r\n', 48),
(17, 'here i found best instructors and course for improve my skilles', 49),
(18, 'this is my life changing website because i learn degital-marketing and after i tack good salary job.', 47),
(19, 'this is good website', 50);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` text NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_link` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES
(12, '1. HTML Tutorial for Beginners', 'Learn the basics of HTML (HyperText Markup Language) to create the structure of web pages. This beginner-friendly tutorial covers headings, paragraphs, links, images, tables, and forms to help you build your first website.', '../lessonvid/1-HTML Tutorial for Beginners.mp4', 31, 'web devlopment'),
(13, '2. CSS Tutorial', 'Master the basics of CSS (Cascading Style Sheets) to style and design beautiful web pages. Learn how to add colors, fonts, layouts, and responsive designs to make your websites visually appealing and user-friendly.', '../lessonvid/2-CSS Tutorial.mp4', 31, 'web devlopment'),
(14, '3. Github Tutorial For Beginners', 'Learn how to use GitHub to manage and share your code. This tutorial covers creating repositories, committing changes, branching, and collaborating with others—perfect for beginners starting with version control.', '../lessonvid/3-Github Tutorial For Beginners.mp4', 31, 'web devlopment'),
(16, '4. Javascript Tutorial For Beginners', 'Get started with JavaScript, the programming language of the web. Learn how to add interactivity to your websites with variables, functions, events, and simple projects—perfect for beginners who want to make web pages dynamic.', '../lessonvid/4-Javascript Tutorial For Beginners.mp4', 31, 'web devlopment'),
(17, '5. jQuery Tutorial', 'Learn jQuery, a powerful JavaScript library that makes web development faster and easier. This tutorial covers selecting elements, handling events, animations, and AJAX to build interactive and responsive websites.', '../lessonvid/5-jQuery Tutorial.mp4', 31, 'web devlopment'),
(18, '1. How to install flutter - Set up flutter in Android Studio', 'Learn how to install Flutter and configure Android Studio for app development. This tutorial guides you through downloading Flutter SDK, setting up environment variables, installing plugins, and creating your first Flutter project.', '../lessonvid/1. How to install flutter - Set up flutter in Android Studio.mp4', 34, 'Flutter App Development'),
(20, '2. Introduction To Android Studio __ Android Studio Shortcuts And Settings', 'Get started with Android Studio, the official IDE for app development. Learn about its interface, essential settings, and useful keyboard shortcuts to boost your productivity while building Flutter or native Android apps.', '../lessonvid/2. Introduction To Android Studio __ Android Studio Shortcuts And Settings.mp4', 34, 'Flutter App Development'),
(21, '3. Dart Programming Basics __ Part -1', 'Learn the fundamentals of Dart, the programming language behind Flutter. This part covers variables, data types, operators, and simple input/output to help you build a strong foundation for Flutter app development.', '../lessonvid/3. Dart Programming Basics __ Part -1.mp4', 34, 'Flutter App Development'),
(22, '4. PART-2 -Object Oriented Programming Basics In Dart', 'Understand the core concepts of Object-Oriented Programming in Dart. This part covers classes, objects, constructors, inheritance, and polymorphism to help you write structured and reusable code for Flutter apps.', '../lessonvid/4. PART-2 -Object Oriented Programming Basics In Dart.mp4', 34, 'Flutter App Development'),
(23, '5. Hello World! App In Flutter __ Flutter Basics', 'Create your first Flutter app with a simple “Hello World!” program. This tutorial introduces Flutter’s project structure, widgets, and hot reload feature to help beginners understand the basics of building apps.', '../lessonvid/5. Hello World! App In Flutter __ Flutter Basics.mp4', 34, 'Flutter App Development'),
(24, '1. What Is Cyber Security - How It Works.', 'Understand the basics of Cyber Security and how it protects computers, networks, and data from digital attacks. Learn how security systems work, common threats, and the importance of keeping information safe in today’s digital world.', '../lessonvid/1. What Is Cyber Security - How It Works..mp4', 39, 'Cyber Security'),
(25, '2. What Is Firewall _ _ Firewall Explained _ Firewalls and Network Security', 'Learn what a firewall is and how it acts as a security barrier between trusted and untrusted networks. This tutorial explains the types of firewalls, how they filter traffic, and their role in strengthening network security against cyber threats.', '../lessonvid/2. What Is Firewall _ _ Firewall Explained _ Firewalls and Network Security.mp4', 39, 'Cyber Security'),
(26, '3. Phishing _ What Is A Phishing Attack', 'Discover what phishing attacks are and how cybercriminals trick users into sharing sensitive information like passwords or credit card details. Learn the common signs of phishing emails, messages, and websites, along with tips to stay protected.', '../lessonvid/3. Phishing _ What Is A Phishing Attack.mp4', 39, 'Cyber Security'),
(27, '4. Ransomware In Cybersecurity - What Is Ransomware. - Ransomware Attack', 'Learn about ransomware, a type of malicious software that locks or encrypts your files until a ransom is paid. This tutorial explains how ransomware attacks work, real-world examples, and best practices to protect your systems from such threats.', '../lessonvid/4. Ransomware In Cybersecurity - What Is Ransomware. - Ransomware Attack.mp4', 39, 'Cyber Security'),
(28, '5. What Is VPN _ How Does It Work_ _ VPN - Virtual Private Network', 'Understand what a VPN (Virtual Private Network) is and how it keeps your online activities private and secure. Learn how VPNs work, their role in protecting data, bypassing restrictions, and ensuring safe browsing on public networks.', '../lessonvid/5. What Is VPN _ How Does It Work_ _ VPN - Virtual Private Network _.mp4', 39, 'Cyber Security'),
(29, '6. Proxy - What Is A Proxy. - What Is A Proxy Server. - Proxy Explained', 'Learn what a proxy is and how a proxy server works as an intermediary between your device and the internet. This tutorial explains different types of proxies, their uses for security, anonymity, and performance, and how they differ from VPNs.', '../lessonvid/6. Proxy - What Is A Proxy. - What Is A Proxy Server. - Proxy Explained.mp4', 39, 'Cyber Security'),
(30, '7. 5G Explained _ What is 5G_ _ How 5G Works_ _ 5G_ The Next-Gen Network', 'Discover 5G, the next-generation mobile network that offers faster speeds, lower latency, and more reliable connections. Learn how 5G works, its benefits for industries and daily life, and its role in powering future technologies like IoT and smart cities.', '../lessonvid/7. 5G Explained _ What is 5G_ _ How 5G Works_ _ 5G_ The Next-Gen Network.mp4', 39, 'Cyber Security'),
(31, '8. Cyber War - What Is Cyber War. - Cyber Security For Beginners', 'Learn about Cyber War, where nations or groups use digital attacks to disrupt, damage, or steal information from other countries. This tutorial explains how cyber warfare works, its impact on national security, and the importance of cyber defense strategies for beginners.', '../lessonvid/8. Cyber War - What Is Cyber War. - Cyber Security For Beginners.mp4', 39, 'Cyber Security'),
(32, '1. Business Communication _ Meaning and Definition _ Nature, Characteristics, Purpose, Communication', 'Understand the meaning and definition of business communication along with its nature, key characteristics, and purpose. Learn why effective communication is essential for exchanging ideas, decision-making, and building strong business relationships.', '../lessonvid/1. Business Communication _ Meaning and Definition _ Nature, Characteristics, Purpose, Communication.mp4', 40, 'Business Communication'),
(33, '2. process of communication - business communication process - elements of business communication', 'Learn the process of communication in a business setting and understand its key elements such as sender, message, channel, receiver, and feedback. This tutorial explains how information flows effectively within an organization to achieve business goals.', '../lessonvid/2. process of communication - business communication process - elements of business communication.mp4', 40, 'Business Communication'),
(34, '3. 7C of Communication _ seven c of communication', 'Master the 7Cs of Communication—clarity, conciseness, concreteness, correctness, consideration, completeness, and courtesy. This tutorial explains how these principles help in delivering effective, professional, and impactful business communication.', '../lessonvid/3. 7C of Communication _ seven c of communication.mp4', 40, 'Business Communication'),
(35, '4. barriers to communication, business communication', 'Explore the common barriers to communication that affect workplace interactions, such as language differences, cultural gaps, noise, lack of clarity, and psychological factors. Learn how to overcome these barriers for effective business communication.', '../lessonvid/4. barriers to communication, business communication.mp4', 40, 'Business Communication'),
(36, '5. Classifying Communication, verbal, kinesis, haptics, proxemics, chronemics, business communication', 'Learn how business communication is classified into different types, including verbal communication, body language (kinesics), touch (haptics), personal space (proxemics), and time-related communication (chronemics). Understand how each plays a role in effective workplace interaction.', '../lessonvid/5. Classifying Communication, verbal, kinesis, haptics, proxemics, chronemics, business communication.mp4', 40, 'Business Communication'),
(37, '1. STOP WASTING TIME', 'Discover how to identify and eliminate common time-wasting habits. Learn practical tips to stay focused, avoid distractions, and make the most of your time for improved productivity and success.', '../lessonvid/1. STOP WASTING TIME.mp4', 41, 'Time Management'),
(38, '2. SMART WORK & TIME MANAGEMENT', 'Learn how to combine smart work with effective time management to achieve more in less time. This tutorial covers prioritizing tasks, using the right tools, and focusing on efficiency to balance productivity and quality.', '../lessonvid/2. SMART WORK & TIME MANAGEMENT.mp4', 41, 'Time Management'),
(39, '3. HOW TO STUDY or WORK WITH FULL CONCENTRATION', 'Discover techniques to improve focus and concentration while studying or working. Learn how to create a distraction-free environment, manage your energy levels, and apply methods like the Pomodoro technique to stay productive for longer hours.', '../lessonvid/3. HOW TO STUDY or WORK WITH FULL CONCENTRATION.mp4', 41, 'Time Management'),
(40, '4. HOW TO WASTE LIFE. HABITS TO WASTE YOUR LIFE !!!!', 'Understand the negative habits that lead to wasting time and life, such as procrastination, overuse of social media, lack of goals, and poor time management. Learn how to recognize and replace these habits with productive ones to live a meaningful life.', '../lessonvid/4. HOW TO WASTE LIFE. HABITS TO WASTE YOUR LIFE !!!!.mp4', 41, 'Time Management'),
(41, '5. SIMPLE TIME MANAGEMENT TECHNIQUES FOR SMART WORK', 'Learn easy and practical time management techniques like prioritizing tasks, making to-do lists, using the Pomodoro technique, and setting deadlines. These methods help you work smarter, stay organized, and achieve your goals faster.', '../lessonvid/5. SIMPLE TIME MANAGEMENT TECHNIQUES FOR SMART WORK.mp4', 41, 'Time Management'),
(42, '6. SIX MORNING HABITS OF SUCCESSFUL PEOPLE', 'Discover the morning habits that highly successful people follow, such as waking up early, exercising, practicing mindfulness, planning the day, reading, and focusing on goals. Learn how these habits can boost productivity and set a positive tone for the day.', '../lessonvid/6. SIX MORNING HABITS OF SUCCESSFUL PEOPLE.mp4', 41, 'Time Management'),
(43, '1. Introduction to Course _ UI_UX Design Course', 'Get started with the UI/UX Design course and learn the basics of creating user-friendly and visually appealing digital products. This introduction explains the difference between UI and UX, their importance, and how good design improves user satisfaction.', '../lessonvid/1. Introduction to Course _ UI_UX Design Course.mp4', 42, 'Stress Management'),
(44, '2. Course Outline - UI-UX Design Course', 'Explore the course outline for UI/UX Design, covering key topics such as design principles, color theory, typography, wireframing, prototyping, usability testing, and design tools. This roadmap helps you understand the learning journey step by step.', '../lessonvid/2. Course Outline - UI-UX Design Course.mp4', 42, 'UI-UX Design'),
(45, '3. Meeting The Client - UI-UX Design Course', 'Learn how to communicate with clients to understand their needs, goals, and target audience. This lesson covers gathering requirements, asking the right questions, and setting clear expectations to ensure a smooth UI/UX design process.', '../lessonvid/3. Meeting The Client - UI-UX Design Course.mp4', 42, 'UI-UX Design'),
(46, '4. The 2 Paths - UI-UX Design Course', 'Understand the two main paths in design: UI (User Interface), which focuses on the visual look and feel, and UX (User Experience), which focuses on usability and user satisfaction. Learn how both work together to create effective digital products.', '../lessonvid/4. The 2 Paths - UI-UX Design Course.mp4', 42, 'UI-UX Design'),
(47, '5. Exercise Building Your Logo - UI-UX Design Course', 'Practice your design skills by creating your own logo. This exercise teaches you about branding, color choices, typography, and simplicity, helping you apply UI/UX principles to real-world design projects.', '../lessonvid/5. Exercise Building Your Logo - UI-UX Design Course.mp4', 42, 'UI-UX Design'),
(48, '6. Designer vs Developer - UI-UX Design Course', 'Learn the key differences and collaboration between a UI/UX designer and a developer. Understand their roles, responsibilities, and how effective communication ensures that designs are implemented accurately and functionally.', '../lessonvid/6. Designer vs Developer - UI-UX Design Course.mp4', 42, 'UI-UX Design'),
(49, '1. How to Become a Digital Marketer - Roadmap for Digital Marketer', 'Learn the step-by-step roadmap to become a successful digital marketer. This tutorial covers the essential skills, tools, certifications, and strategies needed to start a career in SEO, social media, content marketing, and online advertising.', '../lessonvid/1. How to Become a Digital Marketer - Roadmap for Digital Marketer -.mp4', 43, 'Digital Marketing'),
(50, '2. What Is Digital Marketing.', 'Understand the basics of digital marketing, the practice of promoting products or services using online channels. Learn about its key components, including SEO, social media, email marketing, content marketing, and paid advertising, and how it helps businesses reach and engage their audience effectively.', '../lessonvid/2. What Is Digital Marketing..mp4', 43, 'Digital Marketing'),
(51, '3. Top 50 Digital Marketing Interview Questions and Answers', 'Prepare for your digital marketing interviews with this comprehensive guide. Learn the most commonly asked questions and their answers covering SEO, social media, content marketing, email marketing, PPC, and analytics to boost your confidence and job readiness.', '../lessonvid/3. Top 50 Digital Marketing Interview Questions and Answers.mp4', 43, 'Digital Marketing'),
(52, '4. How to Create a Digital Marketing Strategy.', 'Learn how to develop an effective digital marketing strategy to achieve business goals. This tutorial covers setting objectives, identifying target audiences, choosing the right channels, creating content, and measuring performance for successful online campaigns.', '../lessonvid/4. How to Create a Digital Marketing Strategy..mp4', 43, 'Digital Marketing'),
(53, '5. More Details About What is Digital Marketing', 'Dive deeper into digital marketing and explore its importance, benefits, and various techniques. Learn how online marketing helps businesses grow, reach a global audience, build brand awareness, and measure results using modern tools and analytics.', '../lessonvid/5. More Details About What is Digital Marketing.mp4', 43, 'Digital Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_pass` varchar(255) NOT NULL,
  `stu_occ` varchar(255) NOT NULL,
  `stu_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`, `stu_pass`, `stu_occ`, `stu_img`) VALUES
(44, 'jeel golakiya', 'jeelgolakiya@gmail.com', 'jeelgolakiya', 'web-devloper', '../image/stu/boy-student1.jpg'),
(46, 'sahil vala', 'sahilvala@gmail.com', 'sahilvala', 'app-devloper', '../image/stu/boy-student5.jpg'),
(47, 'gaurav vekariya', 'gauravvekariya@gmail.com', 'gauravvekariya', 'Digital-marketing', '../image/stu/boy-student6.jpg'),
(48, 'jevin golakiya', 'jevingolakiya@gmail.com', 'jevingolakiya', 'businessman', '../image/stu/boy-student4.jpg'),
(49, 'janvi thakur', 'janvithakur@gmail.com', 'janvithakur', 'designer', '../image/stu/girl-student5.jpg'),
(50, 'hil', 'hilsavani@gmail.com', 'hilsavani', 'businessman', '../image/stu/boy-student6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courseorder`
--
ALTER TABLE `courseorder`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `courseorder`
--
ALTER TABLE `courseorder`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
