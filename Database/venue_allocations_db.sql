create database venue_allocations_db;
use venue_allocations_db;

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
  class_id    int auto_increment
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
  booking_id         int auto_increment
    primary key,
  class_id           int         not null,
  class_size         int         not null,
  scheduled_day      varchar(10) not null,
  start_time         time        not null,
  end_time           time        not null,
  activity_type      varchar(10) not null,
  active_year_period varchar(4)  not null,
  constraint BOOKINGS_classes_class_id_fk
  foreign key (class_id) references classes (class_id)
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
  data_projector     tinyint(1)  null,
  overhead_projector tinyint(1)  null,
  screens            tinyint(1)  null,
  speakers           tinyint(1)  null,
  hdmi_cables        tinyint(1)  null,
  vga_cables         tinyint(1)  null,
  document_camera    tinyint(1)  null
);

create table allocations
(
  venue_code varchar(10) not null,
  booking_id int         not null,
  primary key (venue_code, booking_id),
  constraint ALLOCATIONS_bookings_booking_id_fk
  foreign key (booking_id) references bookings (booking_id),
  constraint ALLOCATIONS_venues_venue_code_fk
  foreign key (venue_code) references venues (venue_code)
);


