
# coding: utf-8

# In[16]:

import numpy as np
import argparse
from sklearn.externals import joblib
from sklearn import preprocessing


# In[17]:

# construct the argument parser and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--id", required = True,
	help = "id")
ap.add_argument("-t", "--target", required = True,
	help = "targetName")
ap.add_argument("-f", "--features", required = True,
	help = "features")
args = vars(ap.parse_args())


# In[18]:

# 声明target
TARGET_COMMENTCOUNT = "CommmentCount"
TARGET_COSTTIME = "CostTime"
TARGET_SERVICESCORE = "ServiceScore"
TARGET_DISHSCORE = "DishScore"


# In[19]:

# 读取硬盘中训练好的模型
def getCLF(id, targetName, interval):
    path = "C:\\InforGate\\InforGate\\wwwroot\\smda\\web\\takeout\\clf\\" + str(id) + "_" + targetName + "_" + str(interval) + ".pkl"
    clf = joblib.load(path.decode("utf8").encode("gb2312"))
    return clf


# In[20]:

#单样本预测
def predict(id, targetName, features):
    result = -1
    maxPro = -0.1
    for i in range(4):
        clf = getCLF(id, targetName, i)
        pro = clf.predict_proba(np.array(features).reshape(1, -1))[0][1]
        if pro > maxPro:
            maxPro = pro
            result = i
    return result


# In[21]:

# features = [16, 18]
# id = 1454382456
id = args["id"]
targetName = args["target"]
features = args["features"].split(",")
result = predict(id, targetName, features)
print result


# In[ ]:



