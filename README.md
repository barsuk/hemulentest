## Hemulen it. Тестовое задание (см. issue/1)

Испытано на стенде: базовая ОС - Ubuntu 20.04 1, версия docker 20.10.14, docker-compose 1.25.0

0. `git clone https://github.com/linacoder/hemulentest.git`
1. `cd hemulentest`
2. В .env WWWGROUP=1000, WWWUSER=1000 . Если иначе - проверить `bash$: id -a` и исправить на нужное.
3. `chmod +x test.sh`
4. `./test.sh` -- или запускаем последовательно команды из этого файла, кроме циклов.
5. Заходим на localhost:8484 , логинимся с учётками из консоли или, если вывод недоступен, из файла seed_users.txt.
6. Загружаем файл test.xml в переданном формате.
7. На вкладке Lists проверяем реестры.
