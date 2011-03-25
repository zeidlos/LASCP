#!/bin/bash

#MARSOC Server Control Pannel
#Version: 0.2
#Date: 2011-02-27
#Author: Banshee
#URL: http://going4.com
#
#MARSOC Server Control Pannel is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Permissions beyond the scope of this license may be available at http://going4.com.
#
#http://creativecommons.org/licenses/by-nc-sa/3.0/

# Change dir to your ArmA2 directory
cd /data/a2oa
screen -A -m -d -S arma2oa_server /data/a2oa/server -cpuCount=8 -netlog -profiles. -maxplayers=60 -config=server.cfg -mod="$1" -cfg=basic.cfg -pid=/var/www/LASCP/inc/server.pid >&1
