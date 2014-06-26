#!/bin/bash
curl -v -d "action=teardown" -k -u admin:admin --anyauth --location "https://""$1"":8443/engine/job/""$2" 
