import sys
import json


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

    #Open and read the file
    try:
        file = open(file_name,'r')

        for line in file:
            #print(line)
            d = json.loads(line)
            for field in fields:
                print(d[field])

        file.close()
    except:
        print("ERROR: Unable to process file contents")
        exit(0)

if __name__=='__main__':
    main()
