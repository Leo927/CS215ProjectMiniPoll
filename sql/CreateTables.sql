DROP TABLE IF EXISTS Users, Polls,Answers,Votes;

CREATE TABLE Users(
	userId int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	screenName nvarchar(50) NOT NULL, 
	email varchar(200) NOT NULL,
	password varchar(32) NOT NULL,
	avatarURL varchar(2083) NOT NULL
);

CREATE TABLE Polls(
	pollId int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	title nvarchar(50) NOT NULL,
	createDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	openDate timestamp NOT NULL,
	closeDate timestamp NOT NULL,
	question nvarchar(100) NOT NULL	
);

CREATE TABLE Answers(
	answerId int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	answerString nvarchar(50) NOT NULL,
	pollId int NOT NULL,
	FOREIGN KEY(pollId) REFERENCES Polls(pollId)	
);

CREATE TABLE Votes(
	voteId int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	voteDate timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	userId int NOT NULL, 
	answerId int NOT NULL,
	FOREIGN KEY(userId) REFERENCES Users(userId),
	FOREIGN KEY(answerID) REFERENCES Answers(userId)
);