<?php
/**
 * Created by PhpStorm.
 * User: motsilp
 * Date: 28 Sep 2018
 * Time: 05:08
 */

include "DBConnector.php";

class ApplicationViewer
{
    private $connector;

    public function __construct(){
        $this->connector = new DBConnector();
    }

    public function findApplicationsUser($user_id){
        do{
            $isConnected = $this->connector->createConnection();
        }while(!$isConnected);

        $connection = $this->connector->getConnection();

        mysqli_query($connection,"USE venue_allocations_db");

        $query = "SELECT classes.course_code, classes.class_id, diagonal, bookings.booking_id,
       bookings.class_size, scheduled_day, start_time, end_time, activity_type,
       active_year_period, data_projector, overhead_projector, screens, speakers,
       hdmi_cables, vga_cables, document_camera
        FROM venue_requests, bookings, classes, courses
        WHERE (courses.coordinator_id=?
        AND classes.course_code=courses.course_code
        AND bookings.class_id=classes.class_id
        AND venue_requests.booking_id=bookings.booking_id)
        ORDER BY courses.course_code
        OR (classes.lecturer_id=?
        AND bookings.class_id=classes.class_id
        AND venue_requests.booking_id=bookings.booking_id)";

        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $query))
        {
            print "Failed to prepare statement\n";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $table = "<table><tr>
                    <th>Course Code</th>
                    <th>Class ID</th>
                    <th>Diagonal</th>
                    <th>Booking ID</th>
                    <th>Class Size</th>
                    <th>Scheduled Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Activity Type</th>
                    <th>Active Term</th>
                    <th>Data Projector</th>
                    <th>Overhead Projector</th>
                    <th>Screens</th>
                    <th>Speakers</th>
                    <th>HDMI Cables</th>
                    <th>VGA Cables</th>
                    <th>Document Camera</th>
                    </tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                $table = $table."</tr>";
                foreach ($row as $r){
                    $table = $table."<td>".$r."</td>";
                }
                $table = $table."</tr>";
            }
        }
        $table = $table."</table>";

        mysqli_stmt_close($stmt);

        do{
            $isConnClosed = $this->connector->closeConnection();
        }while(!$isConnClosed);

        return $table;
    }

    public function findApplicationsPIMD(){
        do{
            $isConnected = $this->connector->createConnection();
        }while(!$isConnected);

        $connection = $this->connector->getConnection();

        mysqli_query($connection,"USE venue_allocations_db");

        $query = "SELECT classes.course_code, user_fname, user_lname, user_email, classes.class_id, diagonal, bookings.booking_id,
       bookings.class_size, scheduled_day, start_time, end_time, activity_type,
       active_year_period, data_projector, overhead_projector, screens, speakers,
       hdmi_cables, vga_cables, document_camera
        FROM venue_requests, bookings, classes, courses, users
        WHERE (classes.lecturer_id=users.user_id
        AND bookings.class_id=classes.class_id
        AND venue_requests.booking_id=bookings.booking_id)";

        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $query))
        {
            print "Failed to prepare statement\n";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $table = "<table><tr>
                    <th>Course Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Class ID</th>
                    <th>Diagonal</th>
                    <th>Booking ID</th>
                    <th>Class Size</th>
                    <th>Scheduled Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Activity Type</th>
                    <th>Active Term</th>
                    <th>Data Projector</th>
                    <th>Overhead Projector</th>
                    <th>Screens</th>
                    <th>Speakers</th>
                    <th>HDMI Cables</th>
                    <th>VGA Cables</th>
                    <th>Document Camera</th>
                    </tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                $table = $table."</tr>";
                foreach ($row as $r){
                    $table = $table."<td>".$r."</td>";
                }
                $table = $table."</tr>";
            }
        }
        $table = $table."</table>";

        mysqli_stmt_close($stmt);

        do{
            $isConnClosed = $this->connector->closeConnection();
        }while(!$isConnClosed);

        return $table;
    }

}