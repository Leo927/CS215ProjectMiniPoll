--a.
SELECT * FROM Polls 
Left join Answers On Polls.pollId = Answers.pollId 
Order By Polls.createDate DESC 
LIMIT 5;

--b.
SELECT userId, screenName, avatarURL, birthday FROM Users 
WHERE email = "Bella@uregina.ca" And password = "123456789";

SELECT Votes.answerId, COUNT(Answers.answerId) FROM Answers
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
GROUP BY Answers.answerId;

--Subquery Datetime of most recent vote 
SELECT * FROM Polls 
Left join Answers On Polls.pollId = Answers.pollId 
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId =1;

--Subquery to find the pollIds that a user has voted for
SELECT DISTINCT Answers.pollId AS pollId FROM Users
LEFT JOIN Votes ON Users.userId = Votes.userId
LEFT JOIN Answers ON Votes.answerId = Answers.answerId
WHERE Users.userId = 1;

--Subquery to find the last vote date given a pullId
SELECT Votes.voteDate as voteDate FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId = 2
ORDER BY Votes.voteDate DESC
LIMIT 1;

--Subquery to find all the answers and count and given a pullId
SELECT * FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId = 2;

SELECT *, IF(Votes.userId IS NULL, 0, COUNT(Answers.answerId)) AS voteCount FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId IN 
(SELECT DISTINCT Answers.pollId AS pollId FROM Users
LEFT JOIN Votes ON Users.userId = Votes.userId
LEFT JOIN Answers ON Votes.answerId = Answers.answerId
WHERE Users.userId = 3)
GROUP BY Answers.answerId;

--c. add most recent vote date to the above query
SELECT *, (SELECT Votes.voteDate as voteDate FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId = A.pollId
ORDER BY Votes.voteDate DESC
LIMIT 1) as lastVoteDate
FROM 
(SELECT Polls.pollId, Polls.title, Polls.createDate, Polls.openDate, Polls.closeDate,Polls.question, 
Answers.answerId,Answers.answerString , IF(Votes.userId IS NULL, 0, COUNT(Answers.answerId)) AS voteCount FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId IN 
(SELECT DISTINCT Answers.pollId AS pollId FROM Users
LEFT JOIN Votes ON Users.userId = Votes.userId
LEFT JOIN Answers ON Votes.answerId = Answers.answerId
WHERE Users.userId = 3)
GROUP BY Answers.answerId) as A;

--Subquery to find the count given an answerId
SELECT COUNT(voteId) from (SELECT Votes.voteId as voteId FROM Votes
LEFT JOIN Answers ON Votes.answerId = Answers.answerId
WHERE Votes.answerId = 2) AS AnsVotes;

SELECT COUNT(voteId) from (SELECT Votes.answerId as voteId FROM Votes
LEFT JOIN Answers ON Votes.answerId = Answers.answerId) AS AnsVotes;

SELECT Votes.answerId as voteId FROM Votes
LEFT JOIN Answers ON Votes.answerId = Answers.answerId 
GROUP BY Votes.answerId;

--d. 
SELECT Polls.pollId,title,createDate,openDate,closeDate,question,answerId, answerString FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
WHERE Polls.pollId = 1;

--e
SELECT *, (SELECT Votes.voteDate as voteDate FROM Polls
LEFT JOIN Answers ON Polls.pollId = Answers.pollId
LEFT JOIN Votes ON Answers.answerId = Votes.answerId
WHERE Polls.pollId = A.pollId
ORDER BY Votes.voteDate DESC
LIMIT 1) as lastVoteDate
FROM 
(
	SELECT Polls.pollId, Polls.title, Polls.createDate, Polls.openDate, Polls.closeDate,Polls.question, 
Answers.answerId,Answers.answerString , IF(Votes.userId IS NULL, 0, COUNT(Answers.answerId)) AS voteCount FROM Polls
	LEFT JOIN Answers ON Polls.pollId = Answers.pollId
	LEFT JOIN Votes ON Answers.answerId = Votes.answerId
	WHERE Polls.pollId = 2
	GROUP BY Answers.answerId
) as A;
