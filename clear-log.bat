@echo off
echo Clearing Laravel log file...
if exist "storage\logs\laravel.log" (
    echo. > storage\logs\laravel.log
    echo Log cleared!
) else (
    echo Log file not found, creating new one...
    echo. > storage\logs\laravel.log
)

echo.
echo Now you can test the forgot password feature.
echo Email will be logged to: storage\logs\laravel.log
echo.
echo To view the log in real-time, run:
echo Get-Content "storage\logs\laravel.log" -Wait -Tail 10
pause
