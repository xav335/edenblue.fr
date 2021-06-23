#!/bin/bash

SERVERNAME=${PWD}
printf $SERVERNAME

user=$(whoami)
printf " "$user

group=$(id -g -n)
printf " "$group

####SERVERNAME=/Volumes/640Go/developpement/php/htdocs/edenblue.fr
####chown -R javier:admin $SERVERNAME
#SERVERNAME=/Users/javiergonzalez/Developpement/php/edenblue.fr
#chown -R javiergonzalez:staff $SERVERNAME

chown -R $user:$group $SERVERNAME
chmod -R 755 $SERVERNAME
chmod -R 777 $SERVERNAME/log
chmod -R 777 $SERVERNAME/admin/FileUpload/server/php/files
chmod -R 777 $SERVERNAME/photos
chmod -R 777 $SERVERNAME/uploads
