--Create all tables
CREATE TABLE users (
    user_name       VARCHAR(32) UNIQUE NOT NULL,
    name            VARCHAR(255) NOT NULL,
    pword           VARCHAR(255) NOT NULL,
    email           VARCHAR(255) NOT NULL,
    date            TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_name),
    CONSTRAINT uq_users UNIQUE(email)
);

CREATE TABLE songs (
    id          INT NOT NULL auto_increment,
    user_name   VARCHAR(32) NOT NULL,
    title       VARCHAR(255) NOT NULL,
    sub_title   VARCHAR(255) NOT NULL,
    lyrics      text,
    PRIMARY KEY (id),
    FOREIGN KEY (user_name) REFERENCES users (user_name)
);

CREATE TABLE setlists (
    id          INT NOT NULL auto_increment,
    user_name   VARCHAR(32) NOT NULL,
    title       VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_name) REFERENCES users (user_name)
);

CREATE TABLE setlist_links (
    user_name   VARCHAR(32) NOT NULL,
    setlist_id  INT NOT NULL,
    song_id     INT NOT NULL,
    FOREIGN KEY (user_name) REFERENCES users (user_name),
    FOREIGN KEY (setlist_id) REFERENCES setlists (id),
    FOREIGN KEY (song_id) REFERENCES songs (id)
);

CREATE TABLE user_settings (
    user_name   VARCHAR(32) NOT NULL,
    setting     VARCHAR(32) NOT NULL,
    value       VARCHAR(32),
    FOREIGN KEY (user_name) REFERENCES users (user_name),
    CONSTRAINT uq_usr_setting UNIQUE(user_name, setting)
);

CREATE TABLE song_settings (
    user_name   VARCHAR(32) NOT NULL,
    song_id     INT NOT NULL,
    platform    VARCHAR(32) NOT NULL,
    setting     VARCHAR(32) NOT NULL,
    value       VARCHAR(32),
    FOREIGN KEY (user_name) REFERENCES users (user_name),
    FOREIGN KEY (song_id) REFERENCES songs (id),
    CONSTRAINT uq_song_setting UNIQUE(user_name, song_id, platform, setting)
);



--Make user
INSERT INTO `users`(`user_name`, `name`, `pword`, `email`) VALUES ('ccatura', 'Charles Catura', 'abc123', 'ccatura@gmail.com');

--make song
INSERT INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('ccatura', 'You Raise Me Up', 'By Josh Groban',
'[verse 1]
When I am down and, oh my soul, so weary
When troubles come and my heart burdened be
Then, I am still and wait here in the silence
Until You come and sit awhile with me.

[chorus]
You raise me up, so I can stand on mountains
You raise me up, to walk on stormy seas
I am strong, when I am on your shoulders
You raise me up to more than I can be
You raise me up, so I can stand on mountains
You raise me up, to walk on stormy seas
I am strong, when I am on your shoulders
You raise me up to more than I can be.

[verse 2]
When I am down and, oh my soul, so weary
When troubles come and my heart burdened be
Then, I am still and wait here in the silence
Until You come and sit awhile with me.

[chorus]
You raise me up, so I can stand on mountains
You raise me up, to walk on stormy seas
I am strong, when I am on your shoulders
You raise me up to more than I can be.
You raise me up, so I can stand on mountains
You raise me up, to walk on stormy seas
I am strong, when I am on your shoulders

[end]
You raise me up to more than I can be.
You raise me up to more than I can be.'
);

INSERT INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('ccatura', 'The Pluto Song (Me and Clyde)', 'By Charlie Katt',
"[verse 1]
Me and Clyde met in the second grade,
he lived next door just `round the fence
He sold cookies, I sold lemonade,
in our driveways everyday for fifteen cents

Every evening through the telescope,
Clyde would scour through the skies
He looked for rocks and stars and meteors,
while I photographed the best times of our lives
[!!end_part!!]
[lift]
But, that one photo`s memory always stays,
our arms were spread like we could fly
Clyde, he loved to stare at it for days,
and he discovered something strange among
The twinkles in that picture`s sky
[!!end_part!!]
[chorus]
Now, I see Pluto waving down at me
Three billion miles in the sky
The heavens will not be the same for me
Thanks to that photograph I took of me and Clyde
[!!end_part!!]
[verse 2]
Me and Clyde were like PB and J,
like America and apple pie
And, though I learned to shoot a photograph,
I was so darn sure that Clyde would learn to fly
[!!end_part!!]
[lift]
But, there was one who set his heart ablaze,
Patty Edson was her name
Clyde would get lost in her eyes for days,
and he showed how much he loved her when he
Gave his favorite star her name
[!!end_part!!]
[repeat chorus]
[!!end_part!!]
[bridge]
It can be hard to hide when the sun is in your eyes
But, wonders will arrive when two worlds collide
[!!end_part!!]
[verse 3]
Me and Clyde met in the second grade,
that was ninety years ago today
I swear I see him with his arms out wide, as he sets a course beyond the Milky Way
[!!end_part!!]
[lift]
That one photo`s memory always stays,
(ya` know) the one where we pretend to fly
I will cherish all those golden days,
with the one who brought the heavens down
To live inside our hearts and lives
[!!end_part!!]
[repeat chorus]
[!!end_part!!]"
);

INSERT INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('ccatura', 'Hello', 'Song by Lionel Richie',
"[verse 1]
I've been alone with you inside my mind
And in my dreams I've kissed your lips a thousand times
I sometimes see you pass outside my door
Hello, is it me you're looking for?

[Chorus]
I can see it in your eyes, I can see it in your smile
You're all I've ever wanted and my arms are open wide
'Cause you know just what to say, and you know just what to do
And I want to tell you so much, I love you
I long to see the sunlight in your hair
And tell you time and time again how much I care
Sometimes I feel my heart will overflow

[verse 2]
Hello, I've just got to let you know
'Cause I wonder where you are and I wonder what you do
Are you somewhere feeling lonely or is someone loving you?
Tell me how to win your heart, for I haven't got a clue
But let me start by saying, I love you

[Chorus]
Hello, is it me you're looking for?
'Cause I wonder where you are and I wonder what you do
Are you somewhere feeling lonely or is someone loving you?
Tell me how to win your heart, for I haven't got a clue
But let me start by saying, I love you
I love you
I love you
Is it me you're looking for?
Hello, is it me you're looking for?

[Chorus]
'Cause I wonder where you are and I wonder what you do
Are you somewhere feeling lonely or is someone loving you?
Tell me how to win your heart, for I haven't got a clue
But let me start by saying, I love you
I love you
I love you
Hello, is it me you're looking for?

[ending]
Is it me, is it me, is it me
Is it me you're looking for?
Is it me, is it me"
);

INSERT INTO `songs`(`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('ccatura', 'Better When It`s Gone', 'By Charlie Katt',
"[Verse]
(It) recently occurred to me
(When I) go outside and feel the breeze
There's an air of freedom when I close my eyes
(I) drop my guard, I lift my head
For once my soul's not nearly dead
And my heart is telling me to improvise

(But) when I'm home something in me dies

[Chorus]
(It) recently occurred to me
(When I) go outside and feel the breeze
There's an air of freedom when I close my eyes
(I) drop my guard, I lift my head
For once my soul's not nearly dead
And my heart is telling me to improvise

(But) when I'm home something in me dies

[Bridge]
(It) recently occurred to me
(When I) go outside and feel the breeze
There's an air of freedom when I close my eyes
(I) drop my guard, I lift my head
For once my soul's not nearly dead
And my heart is telling me to improvise

(But) when I'm home something in me dies

(Repeat Chorus)"
);

-- song settings
-- INSERT INTO `song_settings`(`user_name`, `song_id`, `platform`, `setting`, `value`) VALUES ('ccatura', '3', 'mobile', 'speed', '4'); 
-- INSERT INTO `song_settings`(`user_name`, `song_id`, `platform`, `setting`, `value`) VALUES ('ccatura', '3', 'mobile', 'size', '16'); 


--inserts or replaces (if exists)
REPLACE INTO `song_settings` (`user_name`, `song_id`, `platform`, `setting`, `value`) VALUES ('ccatura','3','mobile','speed','2')



--create setlist
INSERT INTO `setlists` (`user_name`, `title`) VALUES ('ccatura', 'Christmas 2023');
INSERT INTO `setlists` (`user_name`, `title`) VALUES ('ccatura', 'Summer Festival 2023');


--create setlist links
CREATE TABLE setlist_link (
    user_name   VARCHAR(32) NOT NULL,
    setlist_id  INT NOT NULL,
    song_id     INT NOT NULL,
    FOREIGN KEY (user_name) REFERENCES users (user_name),
    FOREIGN KEY (setlist_id) REFERENCES setlists (id),
    FOREIGN KEY (song_id) REFERENCES songs (id)
);

INSERT INTO `setlist_links` (`user_name`, `setlist_id`, `song_id`) VALUES ('ccatura', '1', '1');
INSERT INTO `setlist_links` (`user_name`, `setlist_id`, `song_id`) VALUES ('ccatura', '1', '3');
INSERT INTO `setlist_links` (`user_name`, `setlist_id`, `song_id`) VALUES ('ccatura', '1', '4');

-- gets all the song title on setlist 1
SELECT songs.title FROM songs
JOIN setlist_links on song_id = songs.id
WHERE setlist_links.setlist_id = 1




















CREATE TABLE categories (
    id      INT NOT NULL auto_increment,
    name    VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE genres (
    id              INT NOT NULL auto_increment,
    name            VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE cat_genre (
    cat_id          INT NOT NULL,
    genre_id        INT NOT NULL,
    FOREIGN KEY (cat_id) REFERENCES categories (id),
    FOREIGN KEY (genre_id) REFERENCES genres (id),
    CONSTRAINT uq_cat_genre UNIQUE(cat_id, genre_id)
);

CREATE TABLE data (
    id              INT NOT NULL auto_increment,
    name            VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
-- took off:
-- cat_id          INT NOT NULL,
-- FOREIGN KEY (cat_id) REFERENCES categories (id)


CREATE TABLE answers (
    users_user_name VARCHAR(32) NOT NULL,
    data_id         INT NOT NULL,
    genre_id        INT NOT NULL,
    cat_id          INT NOT NULL,
    FOREIGN KEY (genre_id) REFERENCES genres (id),
    FOREIGN KEY (data_id)  REFERENCES data (id),
    FOREIGN KEY (cat_id)   REFERENCES categories (id),
    CONSTRAINT uq_answer UNIQUE(users_user_name, cat_id, genre_id)
);

CREATE TABLE messages (
    id                  INT NOT NULL auto_increment,
    user_name_from      VARCHAR(32) NOT NULL,
    user_name_to        VARCHAR(32) NOT NULL,
    subject             VARCHAR(128) NOT NULL,
    message             TEXT NOT NULL,
    timestamp           DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (user_name_from) REFERENCES users (user_name),
    FOREIGN KEY (user_name_to) REFERENCES users (user_name)
);


-- Make some users
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('ccatura', 'Charles Catura', 1973, 'abc123');
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('bcatura', 'Barles Catura', 1971, 'abc123');
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('acatura', 'Arles Catura', 1972, 'abc123');
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('dcatura', 'Darles Catura', 1979, 'abc123');
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('ecatura', 'Earles Catura', 1979, 'abc123');
INSERT INTO `users`(`user_name`, `name`, `year_born`, `pword`) VALUES ('fcatura', 'Farles Catura', 1980, 'abc123');


-- Make some categories
INSERT INTO `categories`(`name`) VALUES ('Books'),
                                        ('Movies'),
                                        ('Actors'),
                                        ('Music - Bands'),
                                        ('Video Game Consoles'),
                                        ('Video Games - Home'),
                                        ('Video Games - Arcade'),
                                        ('Toys'),
                                        ('Forgotten Restaurants'),
                                        ('Forgotten Stores');

INSERT INTO `categories`(`name`) VALUES ('Electronics');
INSERT INTO `categories`(`name`) VALUES ('Music - Singers');
INSERT INTO `categories`(`name`) VALUES ('TV Shows');




-- Make some genres
INSERT INTO `genres`(`name`) VALUES ('Horror'),
                                    ('Comedy'),
                                    ('Rom-com'),
                                    ('Documentary'),
                                    ('Action'),
                                    ('Crime'),
                                    ('Mystery'),
                                    ('Romance'),
                                    ('Sci-Fi'),
                                    ('History');

INSERT INTO `genres`(`name`) VALUES ('Rock');
INSERT INTO `genres`(`name`) VALUES ('R and B');
INSERT INTO `genres`(`name`) VALUES ('Jazz');
INSERT INTO `genres`(`name`) VALUES ('Metal');
INSERT INTO `genres`(`name`) VALUES ('Classical');
INSERT INTO `genres`(`name`) VALUES ('Rap');

INSERT INTO `genres`(`name`) VALUES ('Buffet');
INSERT INTO `genres`(`name`) VALUES ('Ice Cream');
INSERT INTO `genres`(`name`) VALUES ('Asian');
INSERT INTO `genres`(`name`) VALUES ('Vegetarian');
INSERT INTO `genres`(`name`) VALUES ('Fast Food');

INSERT INTO `genres`(`name`) VALUES ('Clothing');
INSERT INTO `genres`(`name`) VALUES ('Recreational');
INSERT INTO `genres`(`name`) VALUES ('Malls');
INSERT INTO `genres`(`name`) VALUES ('Convenient');
INSERT INTO `genres`(`name`) VALUES ('Gas Stations');

INSERT INTO `genres`(`name`) VALUES ('Adventure');
INSERT INTO `genres`(`name`) VALUES ('Role Playing');
INSERT INTO `genres`(`name`) VALUES ('Shoot ''em');
INSERT INTO `genres`(`name`) VALUES ('Sports');
INSERT INTO `genres`(`name`) VALUES ('Art');

INSERT INTO `genres`(`name`) VALUES ('Infant');
INSERT INTO `genres`(`name`) VALUES ('Toddler');
INSERT INTO `genres`(`name`) VALUES ('Outdoor');
INSERT INTO `genres`(`name`) VALUES ('Construction');
INSERT INTO `genres`(`name`) VALUES ('Electronic');

INSERT INTO `genres`(`name`) VALUES ('All');
INSERT INTO `genres`(`name`) VALUES ('Maze/Puzzle');



-- Make some genre-category links
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('1', '1');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('1', '3');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('1', '4');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('1', '7');

INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('2', '2');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('2', '3');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('2', '5');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('2', '9');

INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('3', '2');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('3', '3');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('3', '6');
INSERT INTO `cat_genre` (`cat_id`, `genre_id`) VALUES ('3', '10');


-- Make some data
INSERT INTO `data` (`name`) VALUES ('Tom Hanks');
INSERT INTO `data` (`name`) VALUES ('Tom Cruise');
INSERT INTO `data` (`name`) VALUES ('Jennifer Lawrence');

INSERT INTO `data` (`name`) VALUES ('Goosebumps');
INSERT INTO `data` (`name`) VALUES ('The Hardy boys');

INSERT INTO `data` (`name`) VALUES ('Die Hard');
INSERT INTO `data` (`name`) VALUES ('The Breakfast Club');
INSERT INTO `data` (`name`) VALUES ('Ferris Beuler''s Day Off');


-- Make some answers
INSERT INTO `answers` (`users_user_name`, `data_id`, `genre_id`, `cat_id`) VALUES ('ccatura', '1', '3', '3');


-- Join answers to genre
SELECT data.name as 'data_name', genres.name as 'genres_name'
FROM `answers`
INNER JOIN `data` ON data.id = answers.data_id
INNER JOIN `genres` ON genres.id = answers.genre_id
ORDER BY data.name


-- Join answers to category
-- SELECT data.name as 'data_name', genres.name as 'genres_name'
-- FROM `answers`
-- INNER JOIN `categories` ON categories.id = answers.cat_id
-- INNER JOIN `data`       ON data.id = answers.data_id
-- INNER JOIN `genres`     ON genres.id = answers.genre_id
-- WHERE categories.name = 'Actors'
-- ORDER BY data.name


-- counts - Join answers to category - finds the most popular in the answers
SELECT data.name, count(*) as totals
FROM answers
INNER JOIN `data` ON data.id = answers.data_id
WHERE data.cat_id = 3 -- this is for  actors
GROUP BY answers.data_id
ORDER BY totals DESC


-- Get specific data name and their genre votes
SELECT genres.name, count(*) as 'totals'
FROM answers
INNER JOIN `genres` ON genres.id = answers.genre_id
WHERE answers.data_id = 1 -- tom hanks
GROUP BY genres.name





-- joins boards to find genres related to categories
SELECT
categories.name as 'catergories_name',
genres.name as 'genres_name'
FROM `cat_genre`
INNER JOIN categories ON categories.id = cat_genre.cat_id
INNER JOIN genres ON genres.id = cat_genre.genre_id
ORDER BY categories.name



-- get all genres for each category
SELECT categories.name as 'cat_name', genres.name as 'genre_name' FROM `cat_genre`
INNER JOIN categories ON categories.id = cat_genre.cat_id
INNER JOIN genres ON genres.id = cat_genre.genre_id
ORDER BY categories.name, genres.name



-- Combine answers: This combines 111 and 112
-- First replaces all 112 answers with 111
-- Then deletes the wrong/misspelled data (112)
UPDATE `answers`
SET `data_id` = 111
WHERE `data_id` = 112;

DELETE FROM `data`
WHERE `id` = 112;