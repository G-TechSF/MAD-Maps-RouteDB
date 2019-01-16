create table routes
(
	db_id int auto_increment
		primary key,
	name tinytext null,
	routes_id tinytext null,
	Map_Code tinytext null,
	Map_Name tinytext null,
	Associated_Cities text null,
	SeriesID tinytext null,
	Ride_Code tinytext null,
	Ride_Number tinytext null,
	City tinytext null,
	State tinytext null,
	Ride_length tinytext null,
	intro text null,
	teaser text null,
	road_warnings text null,
	side_trips text null,
	suggested_stops text null,
	mad_world text null,
	KML_file longblob null
)
;

create table ifttt
(
	id bigint auto_increment
		primary key,
	name text null,
	url text null,
	constraint ifttt_id_uindex
		unique (id)
)
;


