#!/bin/bash
curl -v -d "action=launch" -k -u admin:admin --anyauth --location "https://""$1"":8443/engine/job/""$2" 
