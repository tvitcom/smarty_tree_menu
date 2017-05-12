# smarty_tree_menu
Render hierarhical menu with pdo/mysqli database drivers and smarty templates

## INSTALL
- create webroot folder /var/www/treemenu/webroot
- cd webroot folder and clone source files from https://github.com/tvitcom/smarty_tree_menu
- create web config to web-application webroot folder /var/www/treemenu/webroot
- create database: "treemenu" and user: "treemenu" with password: "pass_to_treemenu"
- edit files TreeMysqliManager.php and TreePdoManage.php in getInstanse method for edit host and port parameters
- import db file "smart_tree_menu.sql" from webroot/data folder into treemenu database
- run bash script: webroot/deploy.sh
- will be ready!
