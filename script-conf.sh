#!/bin/bash

SERVERNAME=/Users/javiergonzalez/Developpement/php/edenblue.fr

chown -R javiergonzalez:staff $SERVERNAME
chmod -R 755 $SERVERNAME
chmod -R 777 $SERVERNAME/log/spy.log
chmod -R 777 $SERVERNAME/admin/FileUpload/server/php/files
chmod -R 777 $SERVERNAME/photos
chmod -R 777 $SERVERNAME/uploads
