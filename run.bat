@echo off
echo Menjalankan semua perintah...

:: Menjalankan PHP artisan serve
start "PHP Server" cmd /k "cd /d C:\Users\fitrailyasa\Documents\GitHub\simaps-ukaya && php artisan serve --host=127.0.0.1"

:: Menjalankan PHP artisan reverb:start dengan host dan port tertentu
start "Reverb" cmd /k "cd /d C:\Users\fitrailyasa\Documents\GitHub\simaps-ukaya && php artisan reverb:start --host=127.0.0.1 --port=9000"

:: Menjalankan PHP artisan queue:listen
start "Queue Listener" cmd /k "cd /d C:\Users\fitrailyasa\Documents\GitHub\simaps-ukaya && php artisan queue:listen"

:: Menjalankan npm run dev
start "NPM Run Dev" cmd /k "cd /d C:\Users\fitrailyasa\Documents\GitHub\simaps-ukaya && npm run dev"

echo Semua perintah telah dijalankan.
pause
