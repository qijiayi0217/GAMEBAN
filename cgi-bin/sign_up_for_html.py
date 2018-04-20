#!/usr/bin/env python

import MySQLdb
#import sqlite3
import hashlib
import cgi
import json

class DBOperater:
    '''operate mysql'''

    def __init__(self):
        self.conn = MySQLdb.connect(host="127.0.0.1", user="root", passwd="qjy19950217", db="410db")
        self.cur = self.conn.cursor()

    def Select(self, strSql):
        self.cur.execute(strSql)

        return self.cur.fetchall()

    def Insert(self, strSql):
        self.cur.execute(strSql)
        self.conn.commit()

    def Update(self, strSql):
        self.cur.execute(strSql)
        self.conn.commit()

    def __del__(self):
        self.cur.close()
        self.conn.close()

db=DBOperater()

form=cgi.FieldStorage()
data=[]
print 'Content-Type: application/json'
print ''

a=form['username'].value
b=form['password'].value
age=form['age'].value
gender=form['sex'].value
#a="test1"
#b="123456"
#age=22
#gender="male"


result=db.Select("select UserName from 410users")
if result:
	for tup in result:
		if a in tup:
			msg="Can't Sign up"
		else:
			md5=hashlib.md5()
			md5.update(b)
			pd=md5.hexdigest()
			que="insert into 410users values('"+a+"','"+pd+"','"+str(age)+"','"+gender+"','');"
			#print que
			db.Insert(que)
			data.append(pd)
			print json.dumps(data)
			#print "success"
else:
	md5=hashlib.md5()
	md5.update(b)
	pd=md5.hexdigest()
	que="insert into 410users values('"+a+"','"+pd+"','"+str(age)+"','"+gender+"','');"
	#print que
	db.Insert(que)
	data.append(pd)
	print json.dumps(data)
	#print "success"



	# que='select * from users where username='+'"'+a+'"'+' AND hashpasswd='+'"'+pd+'"'+';'
	# rows=c.execute(que)

	# lst=[]
	# for row in rows:
	# 	lst.append(row)




