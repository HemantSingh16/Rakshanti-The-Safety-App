CREATE TABLE `relative_tracker` (
  `U_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `relative_tracker`
  ADD PRIMARY KEY (`U_id`),
  ADD KEY `track_time` (`track_time`);