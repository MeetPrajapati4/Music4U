-- reset liked_id
SET @row_number = 0;

UPDATE songs
SET Music_Id = (@row_number := @row_number + 1)
WHERE Music_Id > 0
ORDER BY Music_Id;

-- create playlist
CREATE TABLE `playlist` (
  `Playlist_Id` INT NOT NULL AUTO_INCREMENT,  -- Unique identifier for each playlist
  `User_Id` INT NOT NULL,  -- Identifier for the user who owns the playlist
  `Music_Id` INT NOT NULL,  -- Identifier for the music included in the playlist
  `PlaylistName` VARCHAR(255) NOT NULL,  -- Name of the playlist
  `Created_By` VARCHAR(255) NOT NULL,  -- Name of the user/admin who created the playlist
  `Created_By_Type` ENUM('User', 'Admin') NOT NULL,  -- Specifies if the creator is a user or admin
  PRIMARY KEY (`Playlist_Id`),  -- Primary key constraint on Playlist_Id
  FOREIGN KEY (`User_Id`) REFERENCES `Asusers` (`User_Id`) ON DELETE CASCADE,  -- User_Id foreign key constraint
  FOREIGN KEY (`Music_Id`) REFERENCES `songs` (`Music_Id`) ON DELETE CASCADE  -- Music_Id foreign key constraint
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;  -- Table storage engine and character set

-- Display playlist
SELECT 
  p.Playlist_Id,
  p.PlaylistName,
  p.User_Id,
  p.Music_Id,
  p.Created_By_Id,
  p.Created_By_Type,
  u.User_Name AS Created_By_User_Name
FROM 
  `playlist` p
LEFT JOIN 
  `Asusers` u ON p.Created_By_Id = u.User_Id AND p.Created_By_Type = 'User';


CREATE TABLE PlaylistSongs (
    Play_Id INT,
    List_Id INT,
    Song_Id INT,
    PlaylistName VARCHAR(255),
    PRIMARY KEY (Play_Id, Song_Id),  -- Composite primary key (Play_Id + Song_Id)
    FOREIGN KEY (List_Id) REFERENCES Playlist(Playlist_Id ),  -- Foreign key to Playlist table
    FOREIGN KEY (Song_Id) REFERENCES Songs(Music_Id)     -- Foreign key to Songs table
    FOREIGN KEY (PlaylistName) REFERENCES Playlist(PlaylistName)     -- Foreign key to Songs table
);
