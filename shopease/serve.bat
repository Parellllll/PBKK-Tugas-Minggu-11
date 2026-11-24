@echo off
echo Menjalankan Tugas 11 ShopEase Authentication System pada http://localhost:8081 ...
C:\xampp\php\php.exe -d extension=intl -d extension=gd -d extension=sqlite3 -S localhost:8081 -t public vendor\codeigniter4\framework\system\rewrite.php

