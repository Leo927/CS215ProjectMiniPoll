INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Poppy", "Poppy@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Bella", "Bella@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Lola", "Lola@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Catherine", "Catherine@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Michelle", "Michelle@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Meghan", "Meghan@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");

INSERT INTO Users (screenName, email, password, avatarURL, birthday)
VALUE ("Liberty", "Liberty@uregina.ca", "123456789", "http://via.placeholder.com/50", "1992-05-15");


INSERT INTO Polls (title, openDate, closeDate, question, creatorId)
VALUE ("CSSS President", "2020-07-30 23:59:59", "2020-08-30 00:59:59", "Please select the next president for CSSS", 1);

INSERT INTO Polls (title, openDate, closeDate, question, creatorId)
VALUE ("CSSS VicePresident", "2020-08-15 23:59:59", "2020-09-30 00:59:59", "Please select the next vice president for CSSS", 3);





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



INSERT INTO Votes (answerId)
VALUE (3);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 3) ;

INSERT INTO Votes (answerId)
VALUE (3);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 3) ;

INSERT INTO Votes (answerId)
VALUE (3);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 3) ;

INSERT INTO Votes (answerId)
VALUE (2);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 2) ;

INSERT INTO Votes (answerId)
VALUE (1);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 1) ;


INSERT INTO Votes (answerId)
VALUE (2);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 2) ;


INSERT INTO Votes (answerId)
VALUE (3);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 3) ;


INSERT INTO Votes (answerId)
VALUE (4);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 4) ;

INSERT INTO Votes (answerId)
VALUE ( 4);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 4) ;

INSERT INTO Votes (answerId)
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 6) ;


INSERT INTO Votes (answerId)
VALUE (4);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 4) ;

INSERT INTO Votes (answerId)
VALUE ( 6);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 6) ;


INSERT INTO Votes (answerId)
VALUE (4);
UPDATE Polls 
SET lastVoteDate = CURRENT_TIMESTAMP
WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = 4) ;
