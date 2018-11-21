drop database if exists venue_allocations_db;
create database venue_allocations_db;
use venue_allocations_db;

create table slots
(
  slot_num   int        not null,
  start_time time       not null,
  end_time   time       not null,
  day        varchar(9) not null,
  constraint slots_slot_num_uindex
  unique (slot_num)
);

alter table slots
  add primary key (slot_num);

create table users
(
  user_id           varchar(15) not null
    primary key,
  user_role         varchar(15) not null,
  user_organisation text        not null,
  user_title        varchar(10) null,
  user_lname        text        not null,
  user_fname        text        not null,
  user_phone        varchar(10) not null,
  user_email        varchar(35) not null,
  constraint USERS_user_email_uindex
  unique (user_email)
);

create table courses
(
  course_code    varchar(9)  not null
    primary key,
  course_name    text        not null,
  course_length  varchar(4)  not null,
  active_period  varchar(4)  not null,
  faculty        text        not null,
  school         text        not null,
  coordinator_id varchar(15) not null,
  constraint courses_coordinator_id_uindex
  unique (coordinator_id),
  constraint courses_users_user_id_fk
  foreign key (coordinator_id) references users (user_id)
);

create table classes
(
  class_id    varchar(15) not null
    primary key,
  course_code varchar(9)  not null,
  lecturer_id varchar(15) not null,
  diagonal    varchar(10) not null,
  constraint CLASSES_courses_course_code_fk
  foreign key (course_code) references courses (course_code),
  constraint CLASSES_users_user_id_fk
  foreign key (lecturer_id) references users (user_id)
);

create table bookings
(
  booking_id         int auto_increment,
  booker_id          varchar(15) not null,
  class_id           varchar(15) not null,
  activity_type      varchar(10) not null,
  active_year_period varchar(4)  not null,
  constraint bookings_booking_id_uindex
  unique (booking_id),
  constraint bookings_classes_class_id_fk
  foreign key (class_id) references classes (class_id),
  constraint bookings_users_user_id_fk
  foreign key (booker_id) references users (user_id)
);

alter table bookings
  add primary key (booking_id);

create table user_access
(
  user_id  varchar(15) not null,
  password varchar(20) not null,
  constraint user_access_user_id_uindex
  unique (user_id),
  constraint user_access_users_user_id_fk
  foreign key (user_id) references users (user_id)
);

create table venue_requests
(
  request_id         int auto_increment,
  booking_id         int        not null,
  class_size         int        not null,
  data_projector     tinyint(1) not null,
  overhead_projector tinyint(1) not null,
  screens            tinyint(1) not null,
  sound              tinyint(1) not null,
  speakers           tinyint(1) not null,
  hdmi_cables        tinyint(1) not null,
  vga_cables         tinyint(1) not null,
  document_camera    tinyint(1) not null,
  constraint venues_request_request_id_uindex
  unique (request_id),
  constraint venues_request_bookings_booking_id_fk
  foreign key (booking_id) references bookings (booking_id)
);

alter table venue_requests
  add primary key (request_id);

create table slot_requests
(
  request_id int not null,
  slot_num   int not null,
  primary key (request_id, slot_num),
  constraint slot_requests_slots_slot_num_fk
  foreign key (slot_num) references slots (slot_num),
  constraint slot_requests_venue_requests_request_id_fk
  foreign key (request_id) references venue_requests (request_id)
);

create table venues
(
  venue_code         varchar(8)  not null
    primary key,
  building_name      text        not null,
  venue_size         int         not null,
  venue_type         varchar(15) not null,
  venue_campus       varchar(30) not null,
  venue_location     varchar(20) not null,
  data_projector     tinyint(1)  not null,
  overhead_projector tinyint(1)  not null,
  screens            tinyint(1)  not null,
  sound              tinyint(1)  not null,
  speakers           tinyint(1)  not null,
  hdmi_cables        tinyint(1)  not null,
  vga_cables         tinyint(1)  not null,
  document_camera    tinyint(1)  not null
);

create table allocations
(
  venue_code varchar(10) not null,
  request_id int         not null,
  year_block varchar(3)  not null,
  slot_num   int         not null,
  primary key (venue_code, request_id, year_block, slot_num),
  constraint allocations_venue_requests_request_id_fk
  foreign key (request_id) references venue_requests (request_id),
  constraint allocations_venues_venue_code_fk
  foreign key (venue_code) references venues (venue_code)
);

create index allocations_slots_slot_num_fk
  on allocations (slot_num);

