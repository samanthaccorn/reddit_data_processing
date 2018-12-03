import sys
import json
import re
import csv

def main():
    fields = ['author','subreddit','title','permalink','url']
    
    #Get command line arguements
    posts_file_name = ''
    lines = []
    try:
        posts_file_name = sys.argv[1]
    except:
        print('ERROR: Invalid posts file name')
        exit(0)

    tokens_file_name = ''
    lines = []
    try:
        tokens_file_name = sys.argv[2]
    except:
        print('ERROR: Invalid tokens file name')
        exit(0)

    interests_file_name = ''
    lines = []
    try:
        interests_file_name = sys.argv[2]
    except:
        print('ERROR: Invalid interests file name')
        exit(0)

    #Open and read the files
    posts_file = None
    try:
        posts_file = open(posts_file_name,'rb')
    except:
        print("ERROR: Unable to open file "+posts_file_name)
        exit(0)

    tokens_file = None
    try:
        tokens_file = open(tokens_file_name,'rb')
    except:
        print("ERROR: Unable to open file "+tokens_file_name)
        exit(0)

    interests_file = None
    try:
        interests_file = open(interests_file_name,'rb')
    except:
        print("ERROR: Unable to open file "+interests_file_name)
        exit(0)

    posts = posts_file.readlines()
    tokens = tokens_file.readlines()
    interests = interests_file.readlines()

    posts = posts[1:]
    interests = interests[1:]

    tokens_dict = {}
    for token in tokens:
        token = token.strip()
        token = token.split(',')
        tokens_dict[token[0]] = token[1].split(';;')

    print 'TOKENS:'
    for i in range(10):
        print tokens_dict.keys()[i],tokens_dict[tokens_dict.keys()[i]]
    print ''

    posts_dict = {}
    for post in posts:
        post = post.strip()
        data = post.split(',')
        try:
            title = data[2]
            permalink = data[3]
            img_url = data[5]
            img_hash = data[6]
            posts_dict[title.strip().replace('"','')] = (permalink,img_url,img_hash)
        except:
            x = 1

    print 'POSTS:'
    for i in range(10):
        print posts_dict.keys()[i],posts_dict[posts_dict.keys()[i]]
    print''

    post_interests = {}
    count = 0
    for interest_line in interests:
        interest_line = interest_line.strip()
        interest_name,interest_title = interest_line.split(',')
        token_titles = tokens_dict[interest_name]
        for title in token_titles:
            title = title.strip().replace('"','')
            post_interests[count] = '"'+title.strip()+'","'+interest_name+'"'
            count += 1
    posts_file.close()
    tokens_file.close()
    interests_file.close()

    print 'POST-INTERESTS:'
    for i in range(10):
        key = post_interests.keys()[i]
        print key,post_interests[key]
    print ''

    #Open write file
    w_file = None
    w_file_name = posts_file_name.split('.')[0] + '_post_interests.csv'
    w_file_count = 0
    try:
        w_file = open(w_file_name,'w')
    except:
        print("ERROR: Unable to open write file")
        exit(0)

    for key in post_interests.keys():
        data = post_interests[key]
        new_line = str(key)+','+data+'\n'
        try:
            w_file.write(new_line)
        except:
            x=1

    """    for key in search_dict.keys():
        new_line = key+',"'
        for item in search_dict[key]:
            new_line += item + ';;'
        new_line = new_line[:-2] + '"\n'
        try:
            w_file.write(new_line)
        except:
            x=1"""
    w_file.close()

if __name__=='__main__':
    main()
