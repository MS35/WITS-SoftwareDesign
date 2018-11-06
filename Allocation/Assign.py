import numpy as np
import math
import random


class VenueRequest:
    def __init__(self, bookingId, size, requestId):
        self.bookingId = bookingId
        self.size = size
        self.colored = False
        self.resquestId = requestId


class SlotRequest:
    def __init__(self, request_id, slot_num):
        self.requestId = request_id
        self.slotNum = slot_num


class BookingDetails:
    def __init__(self, requestId, courseCode, classSize, duration, dataProjector, OHP, screens, sound, speakers, HDMI, VGA, docCamera,slotNumber):
        self.colored = False
        self.reqId = requestId
        self.courseCode = courseCode
        self.classSize = classSize
        self.dur = duration
        self.projector = dataProjector
        self.ohp = OHP
        self.screens = screens
        self.sound = sound
        self.speaker = speakers
        self.hdmi = HDMI
        self.vga = VGA
        self.camera = docCamera
        self.slotNum = slotNumber


class VenuesDetais:
        def __init__(self, venueCode, venueSize, dataProjector, OHP, screens, sound, speakers, HDMI, VGA, docCamera):
            self.code = venueCode
            self.vSize = venueSize
            self.projector = dataProjector
            self.ohp = OHP
            self.screens = screens
            self.sound = sound
            self.speaker = speakers
            self.hdmi = HDMI
            self.vga = VGA
            self.camera = docCamera


def FindCompColor(objct):
    #from venues table in the database get available venues
    global index
    file = open("Venue info.txt", "r")
    info = file.readlines()
    clean = list(map(str.strip, info))
    clean.pop(0)  # remove the heading

    v = []
    for i in range(0, len(clean)):
        v.append(clean[i].split(","))

    objArr = [objct.projector, objct.ohp, objct.screens, objct.sound, objct.speaker, objct.hdmi, objct.vga, objct.camera]

    venue = []
    for k in range(0, len(v)):
        if int(objct.classSize) - 10 <= int(v[k][1]) <= int(objct.classSize) + 10:
            venue.append(v[k])

    minDist = []
    norms = []
    #for actual allocating have a for loop that goes through all the venues in venue array
    for i in range(0, len(venue)):
        availVenue = VenuesDetais(venue[i][0], venue[i][1], venue[i][2], venue[i][3], venue[i][4], venue[i][5],
                                  venue[i][6], venue[i][7], venue[i][8], venue[i][9])
        venueArr = [availVenue.projector, availVenue.ohp, availVenue.screens, availVenue.sound, availVenue.speaker,
                    availVenue.hdmi, availVenue.vga, availVenue.camera]
        values = []

        for j in range(0, 8):
            val1 = int(venueArr[j])
            val2 = int(objArr[j])
            values.append((val1 - val2) ** 2)
        norms.append(math.sqrt(sum(values)))

    if len(norms) == 0:
        minDist.append(None)
    else:
        minDist.append(min(norms))

    if len(norms) == 0:
        return ["No venue"]
    else:
        for k in range(0, len(norms)):
            if minDist[0] is norms[k]:
                index = k
        temp = venue[index]
        del venue[index]
        return temp


def main():
    file = open("CSAMBookings.txt", "r")
    mat = file.readlines()

    #generate 19 random course choices
    randCourse = random.sample(range(1, len(mat)), 19)
    sample = []
    for i in range(1, len(mat)):
        if i in randCourse:
            sample.append(mat[i])

    check = list(map(str.strip, sample))
    bookings = []

    for j in range(0, len(check)):
        bookings.append(check[j].split(","))

    allocations = []
    for k in range(0, len(bookings)):
        obj = BookingDetails(bookings[k][0], bookings[k][1], bookings[k][2], bookings[k][3], bookings[k][4], bookings[k][5],
                             bookings[k][6], bookings[k][7], bookings[k][8], bookings[k][9], bookings[k][10], bookings[k][11], bookings[k][12])
        venue = FindCompColor(obj)
        allocations.append(venue)

    merge = []
    for ind in range(0, len(bookings)):
        string = str(allocations[ind][0] + "," + bookings[ind][0] + "," + bookings[ind][3] + "," + bookings[ind][12])
        merge.append(string)
    print(merge)
    with open('Allocations.txt', 'w') as f:
        for item in merge:
            f.write("%s\n" % item)


if __name__ == '__main__':
    main()