-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2019 at 10:26 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nheatley03`
--

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_AccountType`
--

CREATE TABLE `TrainerPal_AccountType` (
  `accountTypeID` int(11) NOT NULL,
  `accountType` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_AccountType`
--

INSERT INTO `TrainerPal_AccountType` (`accountTypeID`, `accountType`) VALUES
(1, 'Basic'),
(2, 'Trainer');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_AdminMessageHandler`
--

CREATE TABLE `TrainerPal_AdminMessageHandler` (
  `adminMessageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` varchar(300) NOT NULL,
  `responded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_AdminMessageHandler`
--

INSERT INTO `TrainerPal_AdminMessageHandler` (`adminMessageID`, `senderID`, `subject`, `message`, `responded`) VALUES
(16, 47, 'System Error', 'The system was bit slow today, will this be fixed?', 2),
(17, 45, 'Loading', 'Hi there, my pages are taking a while to load, will this be fixed?', 2),
(18, 43, 'System Workouts', 'Can you guys please add more in system workouts?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_AdminMessageReplies`
--

CREATE TABLE `TrainerPal_AdminMessageReplies` (
  `adminMessageReplyID` int(11) NOT NULL,
  `originalMessageID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `response` varchar(500) NOT NULL,
  `recipientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_AdminMessageReplies`
--

INSERT INTO `TrainerPal_AdminMessageReplies` (`adminMessageReplyID`, `originalMessageID`, `adminID`, `subject`, `response`, `recipientID`) VALUES
(16, 16, 43, 'System Error', 'Thank you for getting in touch, it should be resolved now!', 47),
(17, 17, 43, 'Loading', 'Hi Niamh, thanks for getting in touch. It should be solved now!', 45);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_AdminMessageResponded`
--

CREATE TABLE `TrainerPal_AdminMessageResponded` (
  `respondedID` int(11) NOT NULL,
  `responded` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_AdminMessageResponded`
--

INSERT INTO `TrainerPal_AdminMessageResponded` (`respondedID`, `responded`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Admins`
--

CREATE TABLE `TrainerPal_Admins` (
  `adminID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `madeAdminBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Admins`
--

INSERT INTO `TrainerPal_Admins` (`adminID`, `userID`, `madeAdminBy`) VALUES
(25, 43, 44),
(26, 44, 43);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_ClientWorkoutComplete`
--

CREATE TABLE `TrainerPal_ClientWorkoutComplete` (
  `clientWorkoutCompleteID` int(11) NOT NULL,
  `trainerClientWorkoutID` int(11) NOT NULL,
  `workoutRatingID` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_ClientWorkoutComplete`
--

INSERT INTO `TrainerPal_ClientWorkoutComplete` (`clientWorkoutCompleteID`, `trainerClientWorkoutID`, `workoutRatingID`, `comment`) VALUES
(18, 29, 5, 'Loved this workout, really hit the back muscles!'),
(19, 30, 4, 'This was really tough, but I enjoyed it!'),
(20, 32, 4, 'This was tough, more of the same!'),
(21, 33, 4, 'Loved this workout!');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Exercises`
--

CREATE TABLE `TrainerPal_Exercises` (
  `exerciseID` int(11) NOT NULL,
  `workoutType` int(11) NOT NULL,
  `muscleGroup` int(11) NOT NULL,
  `exerciseName` varchar(128) NOT NULL,
  `description` varchar(300) NOT NULL,
  `sets` varchar(128) NOT NULL,
  `reps` varchar(128) NOT NULL,
  `youtubeVideoURL` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Exercises`
--

INSERT INTO `TrainerPal_Exercises` (`exerciseID`, `workoutType`, `muscleGroup`, `exerciseName`, `description`, `sets`, `reps`, `youtubeVideoURL`) VALUES
(7, 1, 1, 'Chest Flys', 'Give you a wide chest', '5 sets', '10-15 Reps', 'https://www.youtube.com/watch?v=QENKPHhQVi4'),
(8, 5, 2, 'Deadlift', 'The Deadlift is a key compound movement and will help build overall strength.Start with 50% of your total lifting weight and then increase over 5 sets to 90%', '5-7 Sets', '2-5 Reps', 'https://www.youtube.com/watch?v=ytGaGIn3SjE'),
(9, 5, 3, 'Barbell Squat', 'The Barbell Squat is a massive movement which works the entire body. Increase the weight with each set and work your way to a 1 rep max.', '5-8 Sets', '3-6 Reps', 'https://www.youtube.com/embed/bEv6CCg2BC8'),
(10, 1, 4, 'Shoulder Press', 'Use a barbell or dumbbells - do not worry about the weight just keep the form. You should aim to go until failure.', '4-6 Sets', '10-12 Reps', 'https://www.youtube.com/watch?v=qEwKCR5JCog'),
(11, 1, 4, 'Shoulder Flys', 'Do these until it burns and you cannot do any more. Light weight - high reps.', '4-5 Sets', '12-20 Reps', 'https://www.youtube.com/embed/9YiT_U_-wvU'),
(12, 1, 3, 'Squats', 'High reps in order to make the muscles grow. Strength is not the main concern here. Start with about 50% of your 1 rep max and work up from there to around 80%.', '5-8 Sets', '8-12 Reps', 'https://www.youtube.com/watch?v=bEv6CCg2BC8'),
(13, 1, 3, 'Quad Extensions', 'Hit your quads - high reps and feel it burn until failure.', '4-6 Sets', '10-15 Reps', 'https://www.youtube.com/embed/9nmAtebIwy8'),
(14, 1, 2, 'Lat Pull down', 'Wide Grip and Close Grip work well. High rep range and really focus on getting the squeeze at the bottom.', '4-8 Sets', '8-12 Reps', 'https://youtu.be/CAwf7n6Luuc'),
(15, 1, 2, 'Pull Up', 'Great exercise for working more than just your back. If needed, use assistance via a band and get your reps in.', '4 Sets', '6-8 Reps', 'https://www.youtube.com/embed/fNf-pJxiF5E'),
(16, 1, 5, 'Dumbell Curl', 'All about the high reps and getting the squeeze. Don\'t go heavy where you lose form.', '3-6 Sets', '10-15 Reps', 'https://www.youtube.com/embed/in7PaeYlhrM'),
(17, 1, 5, 'Tricep Pull Down', 'Feel the squeeze at the bottom and aim for 15 reps. The tricep makes up 2/3rds of your arm so it\'s an important muscle to hit.', '4-8 Sets', '12-15 Reps', 'https://www.youtube.com/embed/GCa8Q4e7laU'),
(18, 4, 6, 'Burpees', 'Bend your elbows and do 1 push-up.\r\nNow jump your feet to the outside of your hands. As you stand up, explode up and jump as high as you can, bringing your arms overhead.\r\nDo as many reps as possible in 45 seconds.', '4-5 Sets', 'As many as possible in 45 Seconds', 'https://www.youtube.com/embed/dZgVxmf6jkA'),
(19, 4, 6, 'Mountain Climbers', 'Start in high plank and draw your right knee under your torso, keeping the toes off the ground.\r\nReturn your right foot to starting position.\r\nSwitch legs and bring your left knee under your chest. Keep switching legs as if you\'re running in place.', '5 Sets', 'As many as possible in 50 Seconds', 'https://www.youtube.com/embed/QMc0VQNZKvw'),
(20, 4, 6, 'Jumping Lunge', 'Starting standing with feet shoulder-width apart. Jump your left leg forward and your right leg back and land in a lunge position. Jump up and switch your legs in midair so that you land in a lunge with your right leg in front. Continue jumping back and forth, pausing as little as possible.', '6 Sets', 'As many as you can in one minute.', 'https://www.youtube.com/embed/1ExU8445rbU'),
(21, 2, 6, 'Stair Master', '20 minutes on the stair master at the start or end of a workout will shred body fat quickly.', 'N/A', 'Continue on the Stair Master between 10-20 minutes', 'https://www.youtube.com/embed/iq13RO_3RtE'),
(22, 2, 6, '7 minute Ab Buster', 'A 7 minute workout to kill your abs. Watch the video to see the entire routine.', 'N/A', 'As many as you can in the 7 minute circuit', 'https://www.youtube.com/embed/DHD1-2P94DI'),
(25, 1, 1, 'Chest Press', 'Move the weight up', '4-6 Sets', '8-12 Reps', 'https://www.youtube.com/watch?v=vthMCtgVtFw&t=20s'),
(26, 1, 1, 'Decline Chest Press', 'This will target the lower part of the chest, follow the video for proper form.', '4-7 Sets', '10-15 Reps', 'https://www.youtube.com/watch?v=LfyQBUKR8SE'),
(28, 1, 2, 'Deadlift', 'Lift it up.', '4-6 sets of each exercise', '10-12 reps', 'https://youtu.be/QENKPHhQVi4'),
(29, 1, 4, 'Shoulder Military Press', 'Move the weight up at a steady rate.', '5-8 sets', '10-15 reps', 'https://youtu.be/2yjwXTZQDDI'),
(30, 2, 6, 'Tester exercise', 'Run run', '7', '6', 'https://youtu.be/2yjwXTZQDDI');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_InvoicePayed`
--

CREATE TABLE `TrainerPal_InvoicePayed` (
  `invoicePayedID` int(11) NOT NULL,
  `invoicePaid` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_InvoicePayed`
--

INSERT INTO `TrainerPal_InvoicePayed` (`invoicePayedID`, `invoicePaid`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Invoices`
--

CREATE TABLE `TrainerPal_Invoices` (
  `invoiceID` int(11) NOT NULL,
  `invoiceTitle` varchar(128) NOT NULL,
  `invoiceDescription` varchar(300) NOT NULL,
  `invoiceDate` varchar(128) NOT NULL,
  `invoiceAmount` varchar(128) NOT NULL,
  `client` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Invoices`
--

INSERT INTO `TrainerPal_Invoices` (`invoiceID`, `invoiceTitle`, `invoiceDescription`, `invoiceDate`, `invoiceAmount`, `client`, `paid`, `owner`) VALUES
(25, 'Training Sessions - Week 1', 'Invoice for 2 training sessions taken this week.', '29/07/2019', '60', 45, 2, 43),
(26, 'Training Sessions - Week 2', 'Invoice for personal training sessions taken in week 2.', '30/07/2019', '65', 45, 2, 43),
(27, 'Training Week 1', 'Two intense sessions this week.', '03/07/2019', '70', 48, 1, 43),
(29, 'Training Week 3', 'Three training sessions this week', '30/07/2019', '90', 45, 2, 43);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_MessageHandler`
--

CREATE TABLE `TrainerPal_MessageHandler` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `message` varchar(300) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `messageRead` int(11) NOT NULL,
  `inTrash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_MessageHandler`
--

INSERT INTO `TrainerPal_MessageHandler` (`messageID`, `senderID`, `subject`, `message`, `recipientID`, `messageRead`, `inTrash`) VALUES
(58, 45, 'Training', 'Hi Emily, I was wondering what deals you have on at the moment?', 44, 1, 1),
(59, 45, 'Training', 'Hi Diego, would you take me on as a client please?', 43, 1, 1),
(60, 43, 'First Assignment', 'Hi Niamh, I am going to send you a workout to complete for the week, please give feedback!', 45, 1, 1),
(61, 43, 'Training', 'Hi Niamh, yes no problem at all, just send me a Trainer Request through the app and I\'ll accept.', 45, 1, 1),
(62, 47, 'Personal Training', 'Hi there Diego, I was wondering if you would take me on as a client?', 43, 1, 1),
(63, 43, 'Personal Training', 'Hi Paul, yes no problem, just send me a trainer Request and we can go from there.', 47, 1, 1),
(64, 43, 'Workout', 'Hi Karl, could you please send me more assigned workout plans?', 46, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_MessageRead`
--

CREATE TABLE `TrainerPal_MessageRead` (
  `messageReadID` int(11) NOT NULL,
  `messageRead` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_MessageRead`
--

INSERT INTO `TrainerPal_MessageRead` (`messageReadID`, `messageRead`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_MuscleGroup`
--

CREATE TABLE `TrainerPal_MuscleGroup` (
  `muscleGroupID` int(11) NOT NULL,
  `muscleGroup` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_MuscleGroup`
--

INSERT INTO `TrainerPal_MuscleGroup` (`muscleGroupID`, `muscleGroup`) VALUES
(1, 'Chest'),
(2, 'Back'),
(3, 'Legs'),
(4, 'Shoulders'),
(5, 'Arms'),
(6, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_ProgressReports`
--

CREATE TABLE `TrainerPal_ProgressReports` (
  `progressReportID` int(11) NOT NULL,
  `date` varchar(300) NOT NULL,
  `clientID` int(11) NOT NULL,
  `wentWell` varchar(500) NOT NULL,
  `didNotLike` varchar(500) NOT NULL,
  `couldImprove` varchar(500) NOT NULL,
  `nextWeek` varchar(500) NOT NULL,
  `trainerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_ProgressReports`
--

INSERT INTO `TrainerPal_ProgressReports` (`progressReportID`, `date`, `clientID`, `wentWell`, `didNotLike`, `couldImprove`, `nextWeek`, `trainerID`) VALUES
(11, '29/07/2019', 45, 'The assigned workouts were great!', 'Nothing.', 'Nothing, just continue as we are.', 'I would like to do more leg work and running.', 43),
(12, '29/07/2019', 48, 'The intense training regime really worked.', 'I did not like the deadlifting.', 'I would like to do more core work going forward.', 'More of the same!', 43),
(13, '30/07/2019', 43, 'Everything this week.', 'N/A', 'N/A', 'Same again, with a focus on body building!', 46),
(14, '30/07/2019', 45, 'everything this week.', 'N/A', 'N/A', 'N/A', 43);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_sentToTrash`
--

CREATE TABLE `TrainerPal_sentToTrash` (
  `trashID` int(11) NOT NULL,
  `inTrash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_sentToTrash`
--

INSERT INTO `TrainerPal_sentToTrash` (`trashID`, `inTrash`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Trainer`
--

CREATE TABLE `TrainerPal_Trainer` (
  `trainerUserID` int(12) NOT NULL,
  `userID` int(11) NOT NULL,
  `gymName` varchar(128) NOT NULL,
  `trainerBio` varchar(300) NOT NULL,
  `specialistAreas` varchar(128) NOT NULL,
  `gymAddress` varchar(128) NOT NULL,
  `gymCity` varchar(128) NOT NULL,
  `gymPostcode` varchar(128) NOT NULL,
  `gymCountry` varchar(128) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Trainer`
--

INSERT INTO `TrainerPal_Trainer` (`trainerUserID`, `userID`, `gymName`, `trainerBio`, `specialistAreas`, `gymAddress`, `gymCity`, `gymPostcode`, `gymCountry`, `verified`) VALUES
(39, 43, 'DW Fitness', 'I want to help you with your fitness journey through specialised Training.', 'Body Building, CrossFit, Endurance', 'Longwood Retail Park, Longwood road', 'Belfast', 'BT37 9UL', 'Northern Ireland', 2),
(40, 44, 'Pure Gym', 'I love fitness and helping others achieve their goals.', 'Body Toning, Weight Loss.', 'Unit 1, Shore Road Retail Park', 'Newtownabbey', 'BT16 7BS', 'Northern Ireland.', 2),
(41, 46, 'Pure Gym', 'I love fitness and I am a champion power lifter.', 'Power Lifting and Body building', '48 Greenwich High Road', 'London', 'SE10 8JL', 'England', 2),
(42, 48, 'Pure Gym', 'I\'m Scottish and I love Training.', 'Running, CrossFit', '140 Bath Street', 'Glasgow', 'G2 3ER', 'Scotland', 1);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_TrainerClients`
--

CREATE TABLE `TrainerPal_TrainerClients` (
  `trainerCientsID` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_TrainerClients`
--

INSERT INTO `TrainerPal_TrainerClients` (`trainerCientsID`, `trainer`, `client`) VALUES
(9, 43, 45),
(12, 43, 48),
(13, 46, 43);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_TrainerClientWorkouts`
--

CREATE TABLE `TrainerPal_TrainerClientWorkouts` (
  `clientWorkoutID` int(11) NOT NULL,
  `workoutType` int(11) NOT NULL,
  `muscleGroup` int(11) NOT NULL,
  `exerciseName` varchar(128) NOT NULL,
  `description` varchar(700) NOT NULL,
  `sets` varchar(128) NOT NULL,
  `reps` varchar(128) NOT NULL,
  `youtubeVideoURL` varchar(128) NOT NULL,
  `clientID` int(11) NOT NULL,
  `trainerID` int(11) NOT NULL,
  `workoutCompleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_TrainerClientWorkouts`
--

INSERT INTO `TrainerPal_TrainerClientWorkouts` (`clientWorkoutID`, `workoutType`, `muscleGroup`, `exerciseName`, `description`, `sets`, `reps`, `youtubeVideoURL`, `clientID`, `trainerID`, `workoutCompleted`) VALUES
(29, 1, 2, 'Back Workout Circuit', 'Make sure to squeeze the muscles throughout. Please see the video for a visual representation of each exercise.', 'Complete the circuit 5-7 times', 'Each circuit will last 5 minutes.', 'https://www.youtube.com/watch?v=kcCG2-KEGEQ', 45, 43, 2),
(30, 4, 6, 'Endurance circuit', 'Follow the circuit as seen in the video. This will be an endurance test, don\'t give up!', 'Complete the circuit 7 times.', 'The circuit will last 6 minutes.', 'https://youtu.be/AvqZvnFr630', 45, 43, 2),
(31, 1, 3, 'Leg Day Plan', 'Heavy day of squats and leg extensions, follow the video for the full routine.', '4-6 sets per exercise', '8-12 reps each set', 'https://www.youtube.com/watch?v=RjexvOAsVtI', 48, 43, 1),
(32, 1, 3, 'Leg day', 'Intense leg day focused on heavy squats and raises, follow the video!', '4-6 Sets of each exercise', '10-15 Reps', 'https://www.youtube.com/watch?v=RjexvOAsVtI', 45, 43, 2),
(33, 2, 6, 'Cardio Day', 'Follow the video and burn those calories', 'Do this 5 times', 'N/A', 'https://youtu.be/6OS-iG39mqk', 45, 43, 2),
(36, 1, 1, 'Test', 'test', '5', '12', 'https://youtu.be/I5GaxSYLCSc', 45, 43, 1);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_TrainerRequestResponse`
--

CREATE TABLE `TrainerPal_TrainerRequestResponse` (
  `requestResponseID` int(11) NOT NULL,
  `requestResponse` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_TrainerRequestResponse`
--

INSERT INTO `TrainerPal_TrainerRequestResponse` (`requestResponseID`, `requestResponse`) VALUES
(1, 'Not Answered'),
(2, 'No'),
(3, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_TrainerRequests`
--

CREATE TABLE `TrainerPal_TrainerRequests` (
  `trainerRequestID` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `client` int(11) NOT NULL,
  `trainerRequestResponse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_TrainerRequests`
--

INSERT INTO `TrainerPal_TrainerRequests` (`trainerRequestID`, `trainer`, `message`, `client`, `trainerRequestResponse`) VALUES
(18, 44, 'Would you take me on as a client please?', 45, 3),
(19, 43, 'This is the request, thank you.', 45, 3),
(20, 43, 'I hope you can take me on as a client, thank you!', 48, 3),
(21, 46, 'Please take me on as a client?', 43, 3);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_UpgradePaid`
--

CREATE TABLE `TrainerPal_UpgradePaid` (
  `upgradePaidID` int(11) NOT NULL,
  `upgradePaid` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_UpgradePaid`
--

INSERT INTO `TrainerPal_UpgradePaid` (`upgradePaidID`, `upgradePaid`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_User`
--

CREATE TABLE `TrainerPal_User` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `password` varchar(28) NOT NULL,
  `securityQuestion` varchar(128) NOT NULL,
  `securityQuestionAnswer` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `telephoneNumber` varchar(128) NOT NULL,
  `profilePictureURL` varchar(200) NOT NULL,
  `accountType` int(12) NOT NULL,
  `upgradePaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_User`
--

INSERT INTO `TrainerPal_User` (`userID`, `firstName`, `lastName`, `password`, `securityQuestion`, `securityQuestionAnswer`, `email`, `address`, `city`, `postcode`, `country`, `telephoneNumber`, `profilePictureURL`, `accountType`, `upgradePaid`) VALUES
(43, 'Diego', 'Carter', 'ðÖ:wð€³˜Æó)Ð', 'What city were you born in?', 'Belfast', 'DiegoCarter@gmail.com', '65 Salisbury Avenue', 'Belfast', 'BT155EA', 'Northern Ireland', '0789332442424', 'trainer-1.jpg', 2, 2),
(44, 'Emily', 'Magill', '¿´²ï™\\\"<•ÂÇ:Í', 'What was the make of your first car?', 'BMW', 'EmilyMagill@gmail.com', '37 Upper Cavehill Road', 'Belfast', 'BT15 5FB', 'Northern Ireland', '08765567888', 'trainer-2.jpg', 2, 2),
(45, 'Niamh', 'Lynch', '—¤º{Z§VÆÔÝÂS\"', 'What was the make of your first car?', 'Mini', 'NiamhLynch@gmail.com', '3 Waterloo Gardens', 'Belfast', 'BT15 4EX', 'Northern Ireland', '07899992222', 'trainer-3.jpg', 1, 1),
(46, 'Karl', 'Guest', '§4Y].Î¾ÎÝ!ÛËŸ', 'What is your favourite colour?', 'Blue', 'KarlGuest@gmail.com', '11 Castletown Road', 'London', 'W14 9HE', 'England', '07892654611', 'trainer-4.jpg', 2, 2),
(47, 'Paul', 'Heatley', 'ƒïå<ä2ÎVÒ­¹ú<', 'What is your favourite colour?', 'Red', 'PaulHeatley@gmail.com', '75 Salisbury Avenue', 'Belfast', 'BT15 5EA', 'Northern Ireland', '07853312111', 'defaultUserImage.jpg', 1, 1),
(48, 'George', 'Mac', '.j%ˆß«ä…2.P', 'What city were you born in?', 'Glasgow', 'GeorgeMac@gmail.com', '4 Dechmont Street', 'Glasgow', 'G31 4TL', 'Scotland', '07897555222', 'defaultUserImage.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Verifications`
--

CREATE TABLE `TrainerPal_Verifications` (
  `verificationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `idImage` varchar(300) NOT NULL,
  `qualificationImage` varchar(300) NOT NULL,
  `adminResponded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Verifications`
--

INSERT INTO `TrainerPal_Verifications` (`verificationID`, `userID`, `idImage`, `qualificationImage`, `adminResponded`) VALUES
(9, 43, 'trainer-1.jpg', 'background3.jpg', 2),
(10, 44, 'trainer-2.jpg', 'background5.jpg', 2),
(11, 46, 'background5.jpg', 'background6.jpg', 2),
(13, 48, 'background2.jpg', 'background5.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_Verified`
--

CREATE TABLE `TrainerPal_Verified` (
  `verifiedID` int(11) NOT NULL,
  `verified` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_Verified`
--

INSERT INTO `TrainerPal_Verified` (`verifiedID`, `verified`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_WorkoutCompleted`
--

CREATE TABLE `TrainerPal_WorkoutCompleted` (
  `workoutCompleteID` int(11) NOT NULL,
  `workoutComplete` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_WorkoutCompleted`
--

INSERT INTO `TrainerPal_WorkoutCompleted` (`workoutCompleteID`, `workoutComplete`) VALUES
(1, 'Not Completed'),
(2, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_WorkoutRating`
--

CREATE TABLE `TrainerPal_WorkoutRating` (
  `workoutRatingID` int(11) NOT NULL,
  `workoutRating` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_WorkoutRating`
--

INSERT INTO `TrainerPal_WorkoutRating` (`workoutRatingID`, `workoutRating`) VALUES
(1, '1 Star'),
(2, '2 Star'),
(3, '3 Star'),
(4, '4 Star'),
(5, '5 Star');

-- --------------------------------------------------------

--
-- Table structure for table `TrainerPal_WorkoutType`
--

CREATE TABLE `TrainerPal_WorkoutType` (
  `workoutTypeID` int(11) NOT NULL,
  `workoutType` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TrainerPal_WorkoutType`
--

INSERT INTO `TrainerPal_WorkoutType` (`workoutTypeID`, `workoutType`) VALUES
(1, 'Body Building'),
(2, 'Fat Burning'),
(3, 'Body Toning'),
(4, 'HIIT (High-Intensity Interval Training)'),
(5, 'Strength Building');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TrainerPal_AccountType`
--
ALTER TABLE `TrainerPal_AccountType`
  ADD PRIMARY KEY (`accountTypeID`);

--
-- Indexes for table `TrainerPal_AdminMessageHandler`
--
ALTER TABLE `TrainerPal_AdminMessageHandler`
  ADD PRIMARY KEY (`adminMessageID`),
  ADD KEY `FK_UserIDnnn` (`senderID`),
  ADD KEY `FK_Responded` (`responded`);

--
-- Indexes for table `TrainerPal_AdminMessageReplies`
--
ALTER TABLE `TrainerPal_AdminMessageReplies`
  ADD PRIMARY KEY (`adminMessageReplyID`),
  ADD KEY `FK_OGMessageID` (`originalMessageID`),
  ADD KEY `FK_RecipientID` (`recipientID`),
  ADD KEY `FK_AdminID` (`adminID`);

--
-- Indexes for table `TrainerPal_AdminMessageResponded`
--
ALTER TABLE `TrainerPal_AdminMessageResponded`
  ADD PRIMARY KEY (`respondedID`);

--
-- Indexes for table `TrainerPal_Admins`
--
ALTER TABLE `TrainerPal_Admins`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `FK_UserIDppp` (`userID`),
  ADD KEY `FK_UserIDvv` (`madeAdminBy`);

--
-- Indexes for table `TrainerPal_ClientWorkoutComplete`
--
ALTER TABLE `TrainerPal_ClientWorkoutComplete`
  ADD PRIMARY KEY (`clientWorkoutCompleteID`),
  ADD KEY `FK_ClientWorkoutID` (`trainerClientWorkoutID`),
  ADD KEY `FK_WorkoutRatingID` (`workoutRatingID`);

--
-- Indexes for table `TrainerPal_Exercises`
--
ALTER TABLE `TrainerPal_Exercises`
  ADD PRIMARY KEY (`exerciseID`),
  ADD KEY `FK_WorkoutType` (`workoutType`),
  ADD KEY `FK_MuscleGroup` (`muscleGroup`);

--
-- Indexes for table `TrainerPal_InvoicePayed`
--
ALTER TABLE `TrainerPal_InvoicePayed`
  ADD PRIMARY KEY (`invoicePayedID`);

--
-- Indexes for table `TrainerPal_Invoices`
--
ALTER TABLE `TrainerPal_Invoices`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `FK_UserIDdd` (`client`),
  ADD KEY `FK_UserIDdo` (`owner`),
  ADD KEY `FK_PaidID` (`paid`);

--
-- Indexes for table `TrainerPal_MessageHandler`
--
ALTER TABLE `TrainerPal_MessageHandler`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `FK_MessageRead` (`messageRead`),
  ADD KEY `FK_InTrash` (`inTrash`),
  ADD KEY `FK_UserIDD` (`senderID`),
  ADD KEY `FK_UserIDE` (`recipientID`);

--
-- Indexes for table `TrainerPal_MessageRead`
--
ALTER TABLE `TrainerPal_MessageRead`
  ADD PRIMARY KEY (`messageReadID`);

--
-- Indexes for table `TrainerPal_MuscleGroup`
--
ALTER TABLE `TrainerPal_MuscleGroup`
  ADD PRIMARY KEY (`muscleGroupID`);

--
-- Indexes for table `TrainerPal_ProgressReports`
--
ALTER TABLE `TrainerPal_ProgressReports`
  ADD PRIMARY KEY (`progressReportID`),
  ADD KEY `FK_UserIDqq` (`clientID`),
  ADD KEY `FK_UserIDww` (`trainerID`);

--
-- Indexes for table `TrainerPal_sentToTrash`
--
ALTER TABLE `TrainerPal_sentToTrash`
  ADD PRIMARY KEY (`trashID`);

--
-- Indexes for table `TrainerPal_Trainer`
--
ALTER TABLE `TrainerPal_Trainer`
  ADD PRIMARY KEY (`trainerUserID`),
  ADD KEY `FK_VerifiedID` (`verified`),
  ADD KEY `FK_UserIDC` (`userID`);

--
-- Indexes for table `TrainerPal_TrainerClients`
--
ALTER TABLE `TrainerPal_TrainerClients`
  ADD PRIMARY KEY (`trainerCientsID`),
  ADD KEY `FK_UserIDz` (`client`),
  ADD KEY `FK_UserIDv` (`trainer`);

--
-- Indexes for table `TrainerPal_TrainerClientWorkouts`
--
ALTER TABLE `TrainerPal_TrainerClientWorkouts`
  ADD PRIMARY KEY (`clientWorkoutID`),
  ADD KEY `FK_MuscleGroupA` (`muscleGroup`),
  ADD KEY `FK_WorkoutTypeA` (`workoutType`),
  ADD KEY `FK_UserIDoo` (`trainerID`),
  ADD KEY `FK_UserIDzz` (`clientID`),
  ADD KEY `FK_WorkoutCompleted` (`workoutCompleted`);

--
-- Indexes for table `TrainerPal_TrainerRequestResponse`
--
ALTER TABLE `TrainerPal_TrainerRequestResponse`
  ADD PRIMARY KEY (`requestResponseID`);

--
-- Indexes for table `TrainerPal_TrainerRequests`
--
ALTER TABLE `TrainerPal_TrainerRequests`
  ADD PRIMARY KEY (`trainerRequestID`),
  ADD KEY `FK_RequestResponose` (`trainerRequestResponse`),
  ADD KEY `FK_UserIDp` (`trainer`),
  ADD KEY `FK_UserIDu` (`client`);

--
-- Indexes for table `TrainerPal_UpgradePaid`
--
ALTER TABLE `TrainerPal_UpgradePaid`
  ADD PRIMARY KEY (`upgradePaidID`);

--
-- Indexes for table `TrainerPal_User`
--
ALTER TABLE `TrainerPal_User`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `FK_AccountType` (`accountType`),
  ADD KEY `FK_UpgradePaidID` (`upgradePaid`);

--
-- Indexes for table `TrainerPal_Verifications`
--
ALTER TABLE `TrainerPal_Verifications`
  ADD PRIMARY KEY (`verificationID`),
  ADD KEY `FK_TrainerUserID` (`userID`),
  ADD KEY `FK_AdminResponded` (`adminResponded`);

--
-- Indexes for table `TrainerPal_Verified`
--
ALTER TABLE `TrainerPal_Verified`
  ADD PRIMARY KEY (`verifiedID`);

--
-- Indexes for table `TrainerPal_WorkoutCompleted`
--
ALTER TABLE `TrainerPal_WorkoutCompleted`
  ADD PRIMARY KEY (`workoutCompleteID`);

--
-- Indexes for table `TrainerPal_WorkoutRating`
--
ALTER TABLE `TrainerPal_WorkoutRating`
  ADD PRIMARY KEY (`workoutRatingID`);

--
-- Indexes for table `TrainerPal_WorkoutType`
--
ALTER TABLE `TrainerPal_WorkoutType`
  ADD PRIMARY KEY (`workoutTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TrainerPal_AccountType`
--
ALTER TABLE `TrainerPal_AccountType`
  MODIFY `accountTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_AdminMessageHandler`
--
ALTER TABLE `TrainerPal_AdminMessageHandler`
  MODIFY `adminMessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `TrainerPal_AdminMessageReplies`
--
ALTER TABLE `TrainerPal_AdminMessageReplies`
  MODIFY `adminMessageReplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `TrainerPal_AdminMessageResponded`
--
ALTER TABLE `TrainerPal_AdminMessageResponded`
  MODIFY `respondedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_Admins`
--
ALTER TABLE `TrainerPal_Admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `TrainerPal_ClientWorkoutComplete`
--
ALTER TABLE `TrainerPal_ClientWorkoutComplete`
  MODIFY `clientWorkoutCompleteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `TrainerPal_Exercises`
--
ALTER TABLE `TrainerPal_Exercises`
  MODIFY `exerciseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `TrainerPal_InvoicePayed`
--
ALTER TABLE `TrainerPal_InvoicePayed`
  MODIFY `invoicePayedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_Invoices`
--
ALTER TABLE `TrainerPal_Invoices`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `TrainerPal_MessageHandler`
--
ALTER TABLE `TrainerPal_MessageHandler`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `TrainerPal_MessageRead`
--
ALTER TABLE `TrainerPal_MessageRead`
  MODIFY `messageReadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_MuscleGroup`
--
ALTER TABLE `TrainerPal_MuscleGroup`
  MODIFY `muscleGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `TrainerPal_ProgressReports`
--
ALTER TABLE `TrainerPal_ProgressReports`
  MODIFY `progressReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `TrainerPal_sentToTrash`
--
ALTER TABLE `TrainerPal_sentToTrash`
  MODIFY `trashID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_Trainer`
--
ALTER TABLE `TrainerPal_Trainer`
  MODIFY `trainerUserID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `TrainerPal_TrainerClients`
--
ALTER TABLE `TrainerPal_TrainerClients`
  MODIFY `trainerCientsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `TrainerPal_TrainerClientWorkouts`
--
ALTER TABLE `TrainerPal_TrainerClientWorkouts`
  MODIFY `clientWorkoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `TrainerPal_TrainerRequestResponse`
--
ALTER TABLE `TrainerPal_TrainerRequestResponse`
  MODIFY `requestResponseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `TrainerPal_TrainerRequests`
--
ALTER TABLE `TrainerPal_TrainerRequests`
  MODIFY `trainerRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `TrainerPal_UpgradePaid`
--
ALTER TABLE `TrainerPal_UpgradePaid`
  MODIFY `upgradePaidID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_User`
--
ALTER TABLE `TrainerPal_User`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `TrainerPal_Verifications`
--
ALTER TABLE `TrainerPal_Verifications`
  MODIFY `verificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `TrainerPal_Verified`
--
ALTER TABLE `TrainerPal_Verified`
  MODIFY `verifiedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_WorkoutCompleted`
--
ALTER TABLE `TrainerPal_WorkoutCompleted`
  MODIFY `workoutCompleteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TrainerPal_WorkoutRating`
--
ALTER TABLE `TrainerPal_WorkoutRating`
  MODIFY `workoutRatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `TrainerPal_WorkoutType`
--
ALTER TABLE `TrainerPal_WorkoutType`
  MODIFY `workoutTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `TrainerPal_AdminMessageHandler`
--
ALTER TABLE `TrainerPal_AdminMessageHandler`
  ADD CONSTRAINT `FK_Responded` FOREIGN KEY (`responded`) REFERENCES `TrainerPal_AdminMessageResponded` (`respondedID`),
  ADD CONSTRAINT `FK_UserIDnnn` FOREIGN KEY (`senderID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `TrainerPal_AdminMessageReplies`
--
ALTER TABLE `TrainerPal_AdminMessageReplies`
  ADD CONSTRAINT `FK_AdminID` FOREIGN KEY (`adminID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_OGMessageID` FOREIGN KEY (`originalMessageID`) REFERENCES `TrainerPal_AdminMessageHandler` (`adminMessageID`),
  ADD CONSTRAINT `FK_RecipientID` FOREIGN KEY (`recipientID`) REFERENCES `TrainerPal_User` (`userID`);

--
-- Constraints for table `TrainerPal_Admins`
--
ALTER TABLE `TrainerPal_Admins`
  ADD CONSTRAINT `FK_UserIDppp` FOREIGN KEY (`userID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDvv` FOREIGN KEY (`madeAdminBy`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `TrainerPal_ClientWorkoutComplete`
--
ALTER TABLE `TrainerPal_ClientWorkoutComplete`
  ADD CONSTRAINT `FK_ClientWorkoutID` FOREIGN KEY (`trainerClientWorkoutID`) REFERENCES `TrainerPal_TrainerClientWorkouts` (`clientWorkoutID`),
  ADD CONSTRAINT `FK_WorkoutRatingID` FOREIGN KEY (`workoutRatingID`) REFERENCES `TrainerPal_WorkoutRating` (`workoutRatingID`);

--
-- Constraints for table `TrainerPal_Exercises`
--
ALTER TABLE `TrainerPal_Exercises`
  ADD CONSTRAINT `FK_MuscleGroup` FOREIGN KEY (`muscleGroup`) REFERENCES `TrainerPal_MuscleGroup` (`muscleGroupID`),
  ADD CONSTRAINT `FK_WorkoutType` FOREIGN KEY (`workoutType`) REFERENCES `TrainerPal_WorkoutType` (`workoutTypeID`);

--
-- Constraints for table `TrainerPal_Invoices`
--
ALTER TABLE `TrainerPal_Invoices`
  ADD CONSTRAINT `FK_PaidID` FOREIGN KEY (`paid`) REFERENCES `TrainerPal_InvoicePayed` (`invoicePayedID`),
  ADD CONSTRAINT `FK_UserIDdd` FOREIGN KEY (`client`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDdo` FOREIGN KEY (`owner`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `TrainerPal_MessageHandler`
--
ALTER TABLE `TrainerPal_MessageHandler`
  ADD CONSTRAINT `FK_InTrash` FOREIGN KEY (`inTrash`) REFERENCES `TrainerPal_sentToTrash` (`trashID`),
  ADD CONSTRAINT `FK_MessageRead` FOREIGN KEY (`messageRead`) REFERENCES `TrainerPal_MessageRead` (`messageReadID`),
  ADD CONSTRAINT `FK_UserIDD` FOREIGN KEY (`senderID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDE` FOREIGN KEY (`recipientID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `TrainerPal_ProgressReports`
--
ALTER TABLE `TrainerPal_ProgressReports`
  ADD CONSTRAINT `FK_UserIDqq` FOREIGN KEY (`clientID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDww` FOREIGN KEY (`trainerID`) REFERENCES `TrainerPal_User` (`userID`);

--
-- Constraints for table `TrainerPal_Trainer`
--
ALTER TABLE `TrainerPal_Trainer`
  ADD CONSTRAINT `FK_UserIDC` FOREIGN KEY (`userID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_VerifiedID` FOREIGN KEY (`verified`) REFERENCES `TrainerPal_Verified` (`verifiedID`);

--
-- Constraints for table `TrainerPal_TrainerClients`
--
ALTER TABLE `TrainerPal_TrainerClients`
  ADD CONSTRAINT `FK_UserIDv` FOREIGN KEY (`trainer`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDz` FOREIGN KEY (`client`) REFERENCES `TrainerPal_User` (`userID`);

--
-- Constraints for table `TrainerPal_TrainerClientWorkouts`
--
ALTER TABLE `TrainerPal_TrainerClientWorkouts`
  ADD CONSTRAINT `FK_MuscleGroupA` FOREIGN KEY (`muscleGroup`) REFERENCES `TrainerPal_MuscleGroup` (`muscleGroupID`),
  ADD CONSTRAINT `FK_UserIDoo` FOREIGN KEY (`trainerID`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDzz` FOREIGN KEY (`clientID`) REFERENCES `TrainerPal_User` (`userID`),
  ADD CONSTRAINT `FK_WorkoutCompleted` FOREIGN KEY (`workoutCompleted`) REFERENCES `TrainerPal_WorkoutCompleted` (`workoutCompleteID`),
  ADD CONSTRAINT `FK_WorkoutTypeA` FOREIGN KEY (`workoutType`) REFERENCES `TrainerPal_WorkoutType` (`workoutTypeID`);

--
-- Constraints for table `TrainerPal_TrainerRequests`
--
ALTER TABLE `TrainerPal_TrainerRequests`
  ADD CONSTRAINT `FK_RequestResponose` FOREIGN KEY (`trainerRequestResponse`) REFERENCES `TrainerPal_TrainerRequestResponse` (`requestResponseID`),
  ADD CONSTRAINT `FK_UserIDp` FOREIGN KEY (`trainer`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserIDu` FOREIGN KEY (`client`) REFERENCES `TrainerPal_User` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `TrainerPal_User`
--
ALTER TABLE `TrainerPal_User`
  ADD CONSTRAINT `FK_AccountType` FOREIGN KEY (`accountType`) REFERENCES `TrainerPal_AccountType` (`accountTypeID`),
  ADD CONSTRAINT `FK_UpgradePaidID` FOREIGN KEY (`upgradePaid`) REFERENCES `TrainerPal_UpgradePaid` (`upgradePaidID`);

--
-- Constraints for table `TrainerPal_Verifications`
--
ALTER TABLE `TrainerPal_Verifications`
  ADD CONSTRAINT `FK_AdminResponded` FOREIGN KEY (`adminResponded`) REFERENCES `TrainerPal_AdminMessageResponded` (`respondedID`),
  ADD CONSTRAINT `FK_TrainerUserID` FOREIGN KEY (`userID`) REFERENCES `TrainerPal_User` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
