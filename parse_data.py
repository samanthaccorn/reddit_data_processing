import sys
import json
import imagehash
import requests
import os

from PIL import Image

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
        file = open(file_name,'r')
    except:
        print("ERROR: Unable to open file")
        exit(0)

    #Open write file
    w_file = None
    w_file_name = file_name
    w_file_count = 0
    try:
        name = w_file_name+'_'+str(w_file_count)+'.csv'
        w_file = open(name,'w')
    except:
        print("ERROR: Unable to open write file")
        exit(0)

    titles = ''
    for field in fields:
        titles += field + ','
    titles = titles + 'img_url,img_hash' + '\n'
    w_file.write(titles)
    
    count = 0
    for line in file:
        count+=1
        data = []
        d = json.loads(line)
        new_line = ''
        no_url = False
        for field in fields:
            try:
                test = d['url']
            except:
                no_url = True
                break
            try:
                string = d[field].replace('"',"'")
                new_line += '"' + string + '"' + ','
                data.append(d[field])
            except:
                data.append("\N")
                new_line += '\N,'
        if no_url:
            pass

        h = -1
        img_url=''
        try:
            preview = d['preview']
            images = preview['images']
            images = images[0]
            source = images['source']
            img_url = source['url']
        
            h = get_image_hash(img_url)
        except Exception as e:
            #print(e)
            pass

        new_line = new_line + img_url + ',' + str(h) + '\n'
        try:
            if h!=-1:
                w_file.write(new_line)
        except:
            x=1

        if count > 340000 and w_file_count < 10:
            w_file.close()
            w_file_count+=1
            name=w_file_name+'_'+str(w_file_count)+'.csv'
            w_file = open(name,'w')
            count = 0

    file.close()
    w_file.close()

def get_image_hash(url):
    file_name = 'temp.png'

    with open(file_name,'wb') as handle:
        response = requests.get(url,stream=True)

        if not response.ok:
            print response

        for block in response.iter_content(1024):
            if not block:
                break

            handle.write(block)

    hash = imagehash.average_hash(Image.open(file_name))

    os.remove(file_name)

    return int(str(hash),16)

if __name__=='__main__':
    if sys.argv[1]=='-t':
        url = sys.argv[2]
        print(get_image_hash(url))
        exit(0)

    main()
