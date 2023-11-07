# php-backend-test-task
Volga-Dnepr backend test task

Запустить тест:
```
docker exec vda_test-phpservice-1 ./vendor/bin/phpunit
```
Пример запроса:
```
curl --location --request GET 'http://localhost:7777/api/aircraft_airports?tail=TEST-001&date_from=2023-01-01%2022:00&date_to=2023-01-02%2015:00'
```
Пример запроса с интервалом времени между двумя перелетами:
```
curl --location --request GET 'http://localhost:7777/api/aircraft_airports?tail=TEST-001&date_from=2023-01-01%2021:00&date_to=2023-01-01%2022:00'
```
Пример запроса с интервалом времени после крайней посадки:
```
curl --location --request GET http://localhost:7777/api/aircraft_airports?tail=TEST-001&date_from=2023-05-31%2010:00&date_to=2023-05-31%2012:00
```
