#!/usr/bin/env python

import sqlite3
import MySQLdb
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
#conn=sqlite3.connect('../information_v2.db')


a=form['username'].value
b=form['password'].value

md5=hashlib.md5()
md5.update(b)
pd=md5.hexdigest()

que='select * from 410users where UserName='+'"'+a+'"'+' AND Password='+'"'+pd+'"'+';'
result=db.Select(que)


if result:
	print 'Content-Type: application/json'
	print 'Set-Cookie: userName='+a+'; Max-Age=180; Path=/'
	print 'Set-Cookie: userPass='+b+'; Max-Age=180; Path=/'
	print ''

else:
	print 'Content-Type: application/json'

#conn.commit()
#conn.close()

print json.dumps(result)