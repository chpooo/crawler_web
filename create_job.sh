#!/bin/bash
curl -v -d "createpath="$2"&action=create" -k -u admin:admin --anyauth --location "https://""$1"":8443/engine" 
