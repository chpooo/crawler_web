#!/bin/bash
mv crontab /etc/crontab
service crond restart
