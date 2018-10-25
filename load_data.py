import sys
import json
import sqlite3

def main():
    fields = ['author','subreddit','title','permalink']
    
    #Get command line arguements
    file_name = ''
    lines = []
    try:
        file_name = sys.argv[1]
    except:
        print('ERROR: Invalid input file name')
        exit(0)

    #Set up the database and table
    conn = sqlite3.connect('test.db')
    c = conn.cursor()
    c.execute('''CREATE TABLE posts (author,subreddit,title,permalink)''')

    #Open and read the file
    try:
        file = open(file_name,'r')

        for line in file:
            #print(line)
            data = []
            command = "INSERT INTO posts VALUES ("
            d = json.loads(line)
            for field in fields:
                d.append(d[field])
                command += d[field] + ','
            command = command[:-1] + ')'
            c.execute(command)

        file.close()
    except:
        print("ERROR: Unable to process file contents")
        exit(0)

if __name__=='__main__':
    main()
