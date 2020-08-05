
INSERT INTO Users (screenName, email, password, avatarURL)
VALUE ("Second Test", "second@uregina.ca", "123456789", "http://via.placeholder/50");

INSERT INTO Polls (title, openDate, closeDate, question)
VALUE ("CSSS VicePresident", "2020-07-30 23:59:59", "2020-08-30 00:59:59", "Please select the next president for CSSS");

INSERT INTO Answers(answerString, pollId)
VALUE ("Test Answer", 2);

INSERT INTO Answers(answerString, pollId)
VALUE ("Mike", 1);

INSERT INTO Votes (userId, answerId)
VALUE (2, 2);