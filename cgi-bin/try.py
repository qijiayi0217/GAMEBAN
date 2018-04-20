#!/usr/bin/env python
import cgi
import json

print "Content-type: application/json"
print

form=cgi.FieldStorage()

words=form['words'].value

data11={}

if words=="Hi":
	data11['resp']='Hello World!'
elif words=="Bye":
	data11['resp']="Bye!"
else:
	data11['resp']="I don't know what you said!"

print json.dumps(data11)