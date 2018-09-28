# WitsSoftwareDesign
[![Build Status](https://travis-ci.org/MS35/WitsSoftwareDesign.svg?branch=dev)](https://travis-ci.org/MS35/WitsSoftwareDesign)
<a href='https://coveralls.io/github/MS35/WitsSoftwareDesign?branch=dev'>
<img src='https://coveralls.io/repos/github/MS35/WitsSoftwareDesign/badge.svg?branch=dev' alt='Coverage Status' />
</a>

Contributers: Motheo Sekgetho
              Masingita Rikhotso
              Lehlohonolo Motsi
              Thandi Tshabalala (Scrum Master)
              Muhammed Variawa
              
Project     : Class Venue Allocation

Decription  : Who ever is in charge of assiging lecture venues and
              tests, as per request by the lecturers, should
              be able to have some form of platform whereby he/she
              may simply press a button and most of their problems will be solved
              
How to run code: Code can not be downloaded straight from a download from github and run. If you want to run the code on the lamp.ms.wits.ac.za/~s1312548 file server one must:
1. Download the code from github.
2. Remove "namespace..." from every php file in source folder.
3. Include "include_once("DBCreator.php")" into the access.php file.
4. Remove, "drop database if exists venue_allocations_db;
           create database venue_allocations_db;
           use venue_allocations_db;" from venue_allocations_db.sql and add add "use s1312548;".
