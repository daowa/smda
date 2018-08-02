
# coding: utf-8

# In[1]:


import sys
reload(sys)
sys.setdefaultencoding('utf8')
import numpy as np
from matplotlib import pyplot as plt
from mpl_toolkits.mplot3d import Axes3D
from mpl_toolkits.mplot3d import proj3d
from sklearn import preprocessing
import argparse
import warnings
warnings.filterwarnings("ignore")


# In[2]:

import MySQLdb

conn=MySQLdb.connect(host='222.204.246.156',user='mysqlsmda',passwd='123456',db='smda',port=3306,charset='utf8')
cur=conn.cursor()

def init():
    conn=MySQLdb.connect(host='222.204.246.156',user='mysqlsmda',passwd='123456',db='smda',port=3306,charset='utf8')
    cur=conn.cursor()

def close():
    cur.close()
    conn.close()


# In[3]:

ap = argparse.ArgumentParser()
ap.add_argument("-i", "--id", required = True,help = "id")
ap.add_argument("-s", "--station", required = True,help = "station")
ap.add_argument("-f", "--features", required = True,help = "features")
args = vars(ap.parse_args())


# In[4]:

X_test_minmax = []
shopid = args["id"]
# station = args["station"].decode("utf8").encode("gb2312")
station = args["station"].decode("gb2312").encode("utf8")
temps = args["features"]
tar = []
for i in temps.split(","):
    tar.append(i)
# tar = [feature]
# print type(shopid)
# print type(station)
# print type(tar)

# shopid = 1454382456
# station = '徐家汇'
# tar = (6,0,0,11,2,9,1.5,0,0)


# In[5]:

#归一化

try:
    init()
    X_train = []
    #查询
    cur.execute("select *,case when isworkday='工作日' then 0 when isworkday='周末' then 1 else 2 END     from feature_day where station_name=\"" + station + "\"")
#     print "select *,case when isworkday='工作日' then 0 when isworkday='周末' then 1 else 2 END \
#     from feature_day where station_name=\"" + station + "\""
    raw = cur.fetchall()
    for r in range(len(raw)):
        temp = [raw[r][3],raw[r][4],raw[r][5],raw[r][6],raw[r][7],raw[r][8],raw[r][9],raw[r][10],raw[r][12]]
        X_train.append(temp)
#     close()
#         print temp
#     print X_train
    min_max_scaler = preprocessing.MinMaxScaler()
    X_train_minmax = min_max_scaler.fit_transform(X_train)
    X_test_minmax = min_max_scaler.transform(X_train)
#     print X_test_minmax
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])


# In[6]:

# X_test_minmax


# In[7]:

target = min_max_scaler.transform(tar)
results = []
for i in range(len(X_test_minmax)):
#     print i, len(X_test_minmax[i])
    res = 0
    for n in range(len(X_test_minmax[i])):
        res = res + abs((target[n]-X_test_minmax[i][n])**2)
    result = res**(1./2)
    results.append(result)
# print results
        
          
        
    


# In[8]:

# results[236]
# X_train[236]
# raw[results.index(min(results))][0]


# In[9]:

outputs=[]
cur.execute("select *,date(day) from feature_day where id=\"" + str(raw[results.index(min(results))][0]) + "\"")
hisweather = cur.fetchall()[0]
# output.append(hisweather)
hisweatherout = "历史上最接近的一天是："+str(hisweather[12])+"，平均温度："+str(round(hisweather[3],1))+"度，降雨、风速相近的"+hisweather[11]
# print hisweatherout+";"
outputs.append(hisweatherout)
cur.execute("select count(*),avg(dish_score),avg(service_score),avg(cost_time) from tb_baiduwaimai where waimai_release_id=\"" + str(shopid) + "\" and date(arrive_time)=\"" + str(hisweather[12]) + "\" and cost_time between 1 and 300")
hisshop = cur.fetchall()
outputs.append(str(hisshop[0][0])+";"+str(hisshop[0][1])+";"+str(hisshop[0][2])+";"+str(hisshop[0][3]))
# print str(hisshop[0][0])+";"+str(hisshop[0][1])+";"+str(hisshop[0][2])+";"+str(hisshop[0][3])+";"
cur.execute("select (service_score+dish_score)/2,content from tb_baiduwaimai where waimai_release_id =\"" + str(shopid) + "\" and cost_time between 1 and 300 and content <> '' and date(arrive_time)=\"" + str(hisweather[12]) + "\" ORDER BY (service_score+dish_score)/2 limit 0,1")
hisbadcontent = cur.fetchall()
if(len(hisbadcontent)!=0):
#     print hisbadcontent[0][1]
    outputs.append(hisbadcontent[0][1])
else:
#     print "差评数据量不足;"
    outputs.append("差评数据量不足")

cur.execute("select (service_score+dish_score)/2,content from tb_baiduwaimai where waimai_release_id =\"" + str(shopid) + "\" and cost_time between 1 and 300 and content <> '' and date(arrive_time)=\'" + str(hisweather[12]) + "\' ORDER BY (service_score+dish_score)/2 desc limit 0,1")
hisgoodcontent = cur.fetchall()
if(len(hisgoodcontent)!=0):
#     print hisgoodcontent[0][1]
    outputs.append(hisgoodcontent[0][1])
else:
#     print "好评数据量不足;"
    outputs.append("好评数据量不足")

output = outputs[0]+";"+outputs[1]+";"+outputs[2]+";"+outputs[3]
# output.encode("gb2312")
print output.encode("utf8")


# In[10]:

close()


# In[ ]:



