INSERT INTO make( make_name, city, country)VALUES( "Genuine", "Chicago", "USA");
INSERT INTO make( make_name, city, country)VALUES( "Vespa", "Pontedera", "Italy");
INSERT INTO make( make_name, city, country)VALUES( "SYM", "Hsinchu", "Taiwan");
INSERT INTO make( make_name, city, country)VALUES( "Piaggio", "Pontedera", "Italy");
INSERT INTO make( make_name, city, country)VALUES( "Kymco", "Kaohsiung", "Taiwan");
INSERT INTO make( make_name, city, country)VALUES( ?, ?, ?);

INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( "Stella", 148, 50, (SELECT id FROM make WHERE make_name="Genuine"));
INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( "Sprint 150", 155, 60, (SELECT id FROM make WHERE make_name="Vespa"));
INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( "HD 200 Evo", 171, 72, (SELECT id FROM make WHERE make_name="SYM"));
INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( "BV 350", 330, 86, (SELECT id FROM make WHERE make_name="Piaggio"));
INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( "Like 200i", 163, 70, (SELECT id FROM make WHERE make_name="Kymco"));
INSERT INTO model( model_name, displacement, top_speed, make_id)VALUES( ?, ?, ?, ?);

INSERT INTO member( fname, lname, join_date)VALUES("Laura", "Weiler", "1984-01-21");
INSERT INTO member( fname, lname, join_date)VALUES("Angel", "Rigby", "2015-01-06");
INSERT INTO member( fname, lname, join_date)VALUES("Jennifer", "Bowser", "2002-02-02");
INSERT INTO member( fname, lname, join_date)VALUES("Ray", "Mullican", "2015-07-16");
INSERT INTO member( fname, lname, join_date)VALUES("Carol", "Speidel", "2003-10-24");
INSERT INTO member( fname, lname, join_date)VALUES(?, ?, ?);

INSERT INTO scooter( color, year, model_id, member_id)VALUES("Green", 2008, (SELECT id FROM model WHERE model_name="Stella"), (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"));
INSERT INTO scooter( color, year, model_id, member_id)VALUES("Yellow", 2015, (SELECT id FROM model WHERE model_name="Sprint 150"), (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"));
INSERT INTO scooter( color, year, model_id, member_id)VALUES("Red", 2009, (SELECT id FROM model WHERE model_name="HD 200 Evo"), (SELECT id FROM member WHERE fname="Angel" AND lname="Rigby"));
INSERT INTO scooter( color, year, model_id, member_id)VALUES("White", 2015, (SELECT id FROM model WHERE model_name="Like 200i"), (SELECT id FROM member WHERE fname="Ray" AND lname="Mullican"));
INSERT INTO scooter( color, year, model_id, member_id)VALUES("Cream", 2014, (SELECT id FROM model WHERE model_name="BV 350"), (SELECT id FROM member WHERE fname="Carol" AND lname="Speidel"));
INSERT INTO scooter( color, year, model_id, member_id)VALUES(?, ?, ?, ?);

INSERT INTO ride(destination, distance, ride_date)VALUES("Wimberley", 38, "1993-12-27");
INSERT INTO ride(destination, distance, ride_date)VALUES("Georgetown", 34, "2002-05-31");
INSERT INTO ride(destination, distance, ride_date)VALUES("Gruene", 47, "2005-04-06");
INSERT INTO ride(destination, distance, ride_date)VALUES("In Town", 8, "2006-11-29");
INSERT INTO ride(destination, distance, ride_date)VALUES("The Oasis", 17, "2011-05-15");
INSERT INTO ride(destination, distance, ride_date)VALUES(?, ?, ?);

INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"), (SELECT id FROM ride WHERE destination="Wimberley"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"), (SELECT id FROM ride WHERE destination="Georgetown"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"), (SELECT id FROM ride WHERE destination="Gruene"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"), (SELECT id FROM ride WHERE destination="In Town"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Laura" AND lname="Weiler"), (SELECT id FROM ride WHERE destination="The Oasis"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Jennifer" AND lname="Bowser"), (SELECT id FROM ride WHERE destination="Georgetown"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Jennifer" AND lname="Bowser"), (SELECT id FROM ride WHERE destination="Gruene"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Carol" AND lname="Speidel"), (SELECT id FROM ride WHERE destination="Gruene"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Carol" AND lname="Speidel"), (SELECT id FROM ride WHERE destination="In Town"));
INSERT INTO member_ride(member_id, ride_id)VALUES( (SELECT id FROM member WHERE fname="Carol" AND lname="Speidel"), (SELECT id FROM ride WHERE destination="The Oasis"));
INSERT INTO member_ride(member_id, ride_id)VALUES( ?, ?);


