@echo off
cd /d "%~dp0"
echo Opening http://localhost:8080 ...
start http://localhost:8080
php -S localhost:8080
