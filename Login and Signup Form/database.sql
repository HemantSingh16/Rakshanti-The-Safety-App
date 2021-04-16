CREATE TABLE `Social_police` (
  `U_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Social_police`
  ADD PRIMARY KEY (`U_id`),
  ADD KEY `track_time` (`track_time`);



  INSERT INTO `social_police` (`U_id`, `track_time`, `track_lng`, `track_lat`) VALUES
(1, '2021-03-15 14:31:49', '73.0989627', '19.0143879'),
(2, '2021-03-15 14:31:49', '73.856743', '18.520430'),
(3, '2021-03-15 14:31:49', '79.088158', '21.145800'),
(4, '2021-03-15 14:31:49', '73.117516', '18.989401'),
(5, '2021-03-15 14:31:49', '77.216721', '28.644800'),
(6, '2021-03-15 14:31:49', '73.0989627', '19.0143879'),
(7, '2021-03-02 16:34:50', '73.069908', '19.047321');


CREATE TABLE `wsa`.`victim_sp_relations` ( 
  `Victim_id` INT(11) NOT NULL , 
  `Sp_id` INT(11) NOT NULL , 
  `status` INT(3) NOT NULL DEFAULT '0' , 
  `response_status` INT(3) NOT NULL DEFAULT '0' ,
  CONSTRAINT Victim_Sp_Relation PRIMARY KEY (Victim_id,Sp_id)
) ENGINE = InnoDB;