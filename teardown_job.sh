#!/bin/bash
curl -v -d "action=teardown" -k -u admin:admin --anyauth --location "https://""$1"":8443/engine/job/""$2" 
if [ "$2" = "www_evpartner_com_news" ]
then
	ssh root@$1 "cd /root/zju_chpoo/crawler/jobs/"$2"/latest/warcs/;piconv -f gb2312 -t utf-8 ./* > 1.warc"
fi

if [ "$2" = "www_ddqc_cc_news" ]
then
	ssh root@$1 "cd /root/zju_chpoo/crawler/jobs/"$2"/latest/warcs/;piconv -f gb2312 -t utf-8 ./* > 1.warc"
fi


if [ "$2" = "www_evdavs_com_news" ]
then
	ssh root@$1 "cd /root/zju_chpoo/crawler/jobs/"$2"/latest/warcs/;piconv -f gb2312 -t utf-8 ./* > 1.warc"
fi


if [ "$2" = "auto_sina_com_cn" ]
then
	ssh root@$1 "cd /root/zju_chpoo/crawler/jobs/"$2"/latest/warcs/;piconv -f gb2312 -t utf-8 ./* > 1.warc"
fi


if [ "$2" = "www_sovev_com_news" ]
then
	ssh root@$1 "cd /root/zju_chpoo/crawler/jobs/"$2"/latest/warcs/;piconv -f gb2312 -t utf-8 ./* > 1.warc"
fi
