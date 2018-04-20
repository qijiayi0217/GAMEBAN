import sqlite3

conn=sqlite3.connect('/Users/jameszonglin/Documents/ampps/www/information_v2.db')
c=conn.cursor()

# c.execute('drop table users;')

c.execute('create table if not exists games(gameID varchar(20) not null,name varchar(20),score varchar(20),description text,primary key(gameID))')

c.execute('insert into games values("steam004","Dead By daylight",9.6,"Scary");')

# c.execute('create table if not exists comments(username varchar(20) not null, comment text not null, addtime datetime not null, primary key(username,comment),foreign key(username) references users(username))')
# c.execute('insert into comments values("qijiayi0217","hahahah","2001-12-20 00:00:00");')
rows=c.execute("select * from games;")

for row in rows:
	print row

conn.commit()
conn.close()