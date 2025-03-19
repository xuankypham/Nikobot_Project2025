import numpy as np



from cv2_enumerate_cameras import enumerate_cameras
import cv2
from collections import Counter  # Import Counter from collections module

def get_webcamID_logitect():
	camID_index = -1
	pos =-1

	#print(" Get webcam index")
	for camera_info in enumerate_cameras(cv2.CAP_MSMF):  # any Python
		#print(f'{camera_info.index}: {camera_info.name}')

		pos = camera_info.name.find("C920")
		if pos > -1:
			camID_index = camera_info.index
		else:
			camID_index =-1

	return camID_index







def convert_BBxyxy_to_CWH(x1, y1, x2, y2):
    w = x2 - x1
    h = y2 - y1
    cx = int(x1 + w / 2)
    cy = int(y1 + h / 2)
    return cx, cy, w, h


def count_objects_in_image(object_classes, image):
    counter = Counter(object_classes)
    # print("Object Count in Image:")
    # print(counter)
    n = 0
    obj_count =[]
    for obj, count in counter.items():
        # print(f"{obj}: {count}")
        cv2.putText(image, f'{obj}: ', (50, 50 + n), cv2.FONT_HERSHEY_SIMPLEX, 1, (255, 0, 0), 1)
        cv2.putText(image, f'{count}', (200, 50 + n), cv2.FONT_HERSHEY_SIMPLEX, 1, (255, 0, 0), 1)

        n = n + 50

        # cv2.imshow("img", image)
        obj_count.append(obj)
        obj_count.append(count)

    #print(objquantity)
    return obj_count


def drawCircle_center_image(cord, image):
    cx, cy, w, h = convert_BBxyxy_to_CWH(cord[0], cord[1], cord[2], cord[3])
    cv2.circle(image, (cx, cy), 5, (255, 0, 0), 2)
    #cv2.putText(image, label,(cord[0]+5, cord[1]+20),cv2.FONT_HERSHEY_SIMPLEX,1,(255,0,0),1)
    return cx,cy


def draw_bb_image(cord, label,prob1,image):
    x1 = cord[0]
    y1 = cord[1]
    x2 = cord[2]
    y2 = cord[3]
    cv2.rectangle(image,(x1,y1),(x2,y2),(0,0,255),2,1)
    cv2.putText(image,label +", Conf: " + str(prob1),(x1+10,y1+20),cv2.FONT_HERSHEY_SIMPLEX,1,(255,0,0),2,1)


def find_element_in_matrix(Matrix, element,distance):  #  THis function is used to  to sort min distance of element
    indexmatrix = []
    elementdistance=[]
    Min_distance=0


    if len(Matrix) > 0:
        index = 0

        for i in range(len(Matrix)):
            if Matrix[i] == element:
                indexmatrix.append(i)
        #print("index_matrix:")
        #print(indexmatrix)
        if len(indexmatrix)>0:
            for i in indexmatrix:
                elementdistance.append(distance[i])
            #print("Element_distance")
            #print(elementdistance)

            Min_distance = min(elementdistance)  # Min Matrix element

    return Min_distance,indexmatrix




#------------------------------RP Lidar-------------------


def find_min(marks):

    minimum_val = marks[0]
    for i in range(1, len(marks)):
        if (marks[i] < minimum_val):
            minimum_val = marks[i]
    result = marks.index(minimum_val)
    return result,minimum_val


def arrage_2array_increase(arr_deg,arr_dist):
    new_array_deg = []  #
    new_array_dist = []  # distance
    array_temp = arr_deg.copy()
    arr_dist_temp = arr_dist.copy()

    for i in range(len(array_temp)):
        index, minval = find_min(array_temp)
        new_array_deg.append(array_temp[index])
        array_temp.pop(index)

        new_array_dist.append(arr_dist_temp[index])
        arr_dist_temp.pop(index)
    return new_array_deg,new_array_dist


def remove_zero_in_matrix_keep_one(array1,array2):
    index = 0
    pos = []
    for i in array1:
        if i == 0:
            pos.append(index)
        index += 1

    newarray1=[]
    newarray2= []
    for i in range(len(pos)-1 ,len(array1)):
        newarray1.append(array1[i])
        newarray2.append(array2[i])

    return newarray1,newarray2








# RP LIDAR_-----------------------------------LIDAR-----------



# This function to calculate average distance from angle to angle
def calculate_distance_lidar(rplidar_angle, rplidar_distant, Angle1, Angle2, type):
    index1 = Angle1
    index2 = Angle2

    if type=="A1":
        for i in range(len(rplidar_angle)):

            if (rplidar_angle[i] > Angle1 and rplidar_angle[i] < Angle1 + 5):
                index1 = i
                #print(index1)

            if (rplidar_angle[i] > Angle2 and rplidar_angle[i] < Angle2 + 5):
                index2 = i
                #print(index2)
    #  Now we have index loop the index to find distance and average distance.

    dist_slice = []  # in range 150 t0 210o
    for i in range(index1, index2):
        dist_slice.append(rplidar_distant[i])
    #print(dist_slice)


    Mtrix = np.matrix(dist_slice)
    average_safe_distance = Mtrix.mean()
    #print(average_safe_distance)
    #average_safe_distance=0.5
    return average_safe_distance


#------------------------RPLIDAR------------------------
def receive_from_rplidar_data(data, type):
    if ("angle" in data.keys()):
        rplidar_angle = data["angle"]
        rplidar_distant = data["distant"]

        #print(len(rplidar_angle) )
        #print(len(rplidar_distant))

        # FOR SAFETY STOP CAR
        # Get Angle from   330   to 30o   , find the Average Distance FWD  -30 to 30o Stop Car

        # Get Angle from   150   to 210o   , find the Average Distance AFT  -30 to 30o Stop Car

        # FWD-------------------330------------360-----
        average_safe_distance_fwd1= 5
        average_safe_distance_fwd2 = 5
        average_safe_distance_aft = 5
        if (type=="A1"):
            Angle1=320
            Angle2=355
            average_safe_distance_fwd1= calculate_distance_lidar(rplidar_angle, rplidar_distant, Angle1, Angle2,type)
        else:
            if len(rplidar_distant)==360:
                average_safe_distance_fwd1= calculate_distance_lidar(rplidar_angle, rplidar_distant, 330, 359,type)

        Angle1 = 0
        Angle2 = 30
        if len(rplidar_distant)>30:
            average_safe_distance_fwd2 = calculate_distance_lidar(rplidar_angle, rplidar_distant, Angle1,
                                                              Angle2,type)
        average_safe_distance_fwd = (average_safe_distance_fwd1 + average_safe_distance_fwd2) / 2
        #print("Averager FWD Distance")
        #print(average_safe_distance_fwd)
        #---------------------------------------------------------
        #-----AFT-------
        Angle1 = 150
        Angle2 = 180
        if len(rplidar_distant) >180:
            average_safe_distance_aft = calculate_distance_lidar(rplidar_angle, rplidar_distant, Angle1,
                                                                  Angle2,type)

        #print("Averager AFT Distance")
        #print(average_safe_distance_aft)

        # Safety Stop ROBOT
        return average_safe_distance_fwd/1000,average_safe_distance_aft/1000








def readtxt_file_line(path_file):
    array_line = []
    with open(path_file, 'r') as txtfile:
        lines = txtfile.readlines()
        for index, line in enumerate(lines):
            # print("line {}: {} ".format(index, line.strip()))
            array_line.append(line.strip())  # Remove White Space
    return array_line
