@echo off
: estos es un comentario esto es para ver la ruta
:echo %0
:echo %~s0
:echo %~d0%~p0

php spark migrate:refresh
php spark db:seed Cargos
php spark db:seed Sedes
php spark db:seed Areas
php spark db:seed Usuarios
php spark db:seed Configuracion

echo Update migration
pause
exit
