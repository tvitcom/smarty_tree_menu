#!/bin/sh

# @author: tvictom
# @licanse: Apache2.0 LICENSE (http://www.apache.org/licenses/LICENSE-2.0)
## Deploy smarty_tree_menu web application: ##
# befor run this script you will be create webroot folder on /var/www/treemenu/webroot
# and put or git clone source files of smarty_tree_menu application

rm -rf templates_c cache
mkdir -m 777 templates_c cache
echo 'deploy - ok!';

