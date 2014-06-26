#!/bin/bash
curl -v -d "action=rescan" -k -u admin:admin --anyauth --location "https://""$1"":8443/engine" > $1 
