import mysql.connector as mysql


def getVenueReq():
    db = mysql.connect(host="localhost",
                       user="venues_db_user",
                       passwd="venues!@#",
                       db="venue_allocations_db")
    print("connected")

    cursor = db.cursor()

    query = "SELECT venue_requests.request_id,venue_requests.booking_id,venue_requests.class_size,"
    query += "venue_requests.data_projector,venue_requests.overhead_projector,venue_requests.screens,venue_requests.sound," \
             "venue_requests.speakers,venue_requests.hdmi_cables,venue_requests.vga_cables,venue_requests.document_camera," \
             "slot_requests.slot_num,bookings.active_year_period " \
             "FROM venue_requests,slot_requests,bookings " \
             "WHERE slot_requests.request_id = venue_requests.request_id " \
             "AND bookings.booking_id = venue_requests.booking_id"

    cursor.execute(query)

    result = cursor.fetchall()
    res = []

    for i in result:
        res2 = []
        for x in i:
            res2.append(str(x))
        res.append(res2)
    return res


def getVenues():
    db = mysql.connect(host="localhost",
                       user="venues_db_user",
                       passwd="venues!@#",
                       db="venue_allocations_db")

    cursor = db.cursor()

    query1 = "SELECT * FROM venues"
    cursor.execute(query1)
    ven = cursor.fetchall()
    venues = []

    for v in ven:
        tmp = []
        for x in v:
            tmp.append(str(x))
        venues.append(tmp)
    return venues


def populate(venCode, requestId, duration, slotNum):
    db = mysql.connect(host="localhost",
                       user="venues_db_user",
                       passwd="venues!@#",
                       db="venue_allocations_db")

    cursor = db.cursor()
    query = "INSERT INTO allocations (venue_code, request_id, year_block, slot_num) VALUES ( " + str(venCode), str(requestId), str(duration), str(slotNum) + ")"
    cursor.execute(query)

    print("Done")