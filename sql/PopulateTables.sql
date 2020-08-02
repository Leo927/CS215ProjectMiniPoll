INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Poppy", "Poppy@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Bella", "Bella@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Lola", "Lola@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Catherine", "Catherine@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Michelle", "Michelle@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Meghan", "Meghan@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Liberty", "Liberty@uregina.ca", "123456789", "http://via.placeholder/50");


INSERT INTO Polls (title, openDate, closeDate, question)
VALUE ("CSSS President", "2020-07-30 23:59:59", "2020-08-30 00:59:59", "Please select the next president for CSSS");

INSERT INTO Polls (title, openDate, closeDate, question)
VALUE ("CSSS VicePresident", "2020-08-15 23:59:59", "2020-09-30 00:59:59", "Please select the next vice president for CSSS");





INSERT INTO Answers(answerString, pollId)
VALUE ("Daniella", 1);

INSERT INTO Answers(answerString, pollId)
VALUE ("Sharon ", 1);

INSERT INTO Answers(answerString, pollId)
VALUE ("Demi ", 1);

INSERT INTO Answers(answerString, pollId)
VALUE ("Anais Vega", 2);

INSERT INTO Answers(answerString, pollId)
VALUE ("Hermione Farmer ", 2);

INSERT INTO Answers(answerString, pollId)
VALUE ("Sadie May ", 2);



INSERT INTO Votes (userId, answerId)
VALUE (1, 3);

INSERT INTO Votes (userId, answerId)
VALUE (2, 3);

INSERT INTO Votes (userId, answerId)
VALUE (3, 3);

INSERT INTO Votes (userId, answerId)
VALUE (4, 2);

INSERT INTO Votes (userId, answerId)
VALUE (5, 1);

INSERT INTO Votes (userId, answerId)
VALUE (6, 2);

INSERT INTO Votes (userId, answerId)
VALUE (7, 3);


INSERT INTO Votes (userId, answerId)
VALUE (2, 4);

INSERT INTO Votes (userId, answerId)
VALUE (3, 4);

INSERT INTO Votes (userId, answerId)
VALUE (4, 6);

INSERT INTO Votes (userId, answerId)
VALUE (5, 4);

INSERT INTO Votes (userId, answerId)
VALUE (6, 6);

INSERT INTO Votes (userId, answerId)
VALUE (7, 4);