@echo off
rem Start MariaDB in a new minimized window
start /min cmd /c "console\mariadb\bin\mariadbd.exe"

rem Wait a few seconds to ensure MariaDB has started
timeout /t 1 /nobreak > nul

rem Start PHP built-in server
php -S localhost:8000 -t public
