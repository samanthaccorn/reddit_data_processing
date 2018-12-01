import sys
import json
import re

def main():
    fields = ['author','subreddit','title','permalink','url']
    
    #Get command line arguements
    file_name = ''
    lines = []
    try:
        file_name = sys.argv[1]
    except:
        print('ERROR: Invalid input file name')
        exit(0)

    #Open and read the file
    file = None
    try:
        file = open(file_name,'rb')
    except:
        print("ERROR: Unable to open file")
        exit(0)

    search_dict = {}
    count = 0
    for line in file:
        count+=1
        if count < 2:
            pass
        d = line.split(',')
        title = ''
        try:
            title = d[2]
            title = title.lower()
        except:
            break
        raw_title = title

        title = title.replace(',',' ')
        title = title.replace('.',' ')
        title = title.replace('/',' ')
        title = title.replace('?',' ')
        title = title.replace('"',' ')
        title = title.replace('(',' ')
        title = title.replace(')',' ')
        title = title.replace('"',' ')
        title = title.replace('[',' ')
        title = title.replace(']',' ')
        title = title.replace('\\',' ')
        title = title.replace('+',' ')
        title = title.replace('=',' ')
        title = title.replace('-',' ')
        title = title.replace('_',' ')
        title = title.replace('*',' ')
        title = title.replace('#',' ')
        title = title.replace('!',' ')
        title = title.replace('\'',' ')
        title = title.replace('^',' ')
        title = title.replace('%',' ')
        title = title.replace('@',' ')
        title = title.replace('$',' ')
        title = title.replace(':',' ')
        
        tokens = title.split(' ')
        for token in tokens:
            if token in search_dict and raw_title not in search_dict[token]:
                search_dict[token].append(raw_title)
            else:
                search_dict[token] = [raw_title]

    file.close()

    #Open write file
    w_file = None
    w_file_name = file_name.split('.')[0] + '_tokens.csv'
    w_file_count = 0
    #try:
    w_file = open(w_file_name,'w')
    #except:
    #    print("ERROR: Unable to open write file")
    #    exit(0)

    for key in search_dict.keys():
        new_line = key+','
        for item in search_dict[key]:
            new_line += item + ','
        new_line = new_line[:-1] + '\n'
        try:
            w_file.write(new_line)
        except:
            x=1
    w_file.close()

if __name__=='__main__':
    main()
