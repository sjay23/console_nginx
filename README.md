
**Instructions on how to install the project:**

```
git clone 
copy .env.example and rename .env

docker-composer build
docker-composer up -d
docker-compose exec logger_backend bash

composer install
```

**Start Command Task**

*Write nginx log to Clickhouse Command*
```
php yii write-nginx-logs-to-db/index
```
*Read nginx log from Clickhouse Command*
```
php yii read-nginx-logs/index --startDate=2024-01-30 --finishDate=2024-01-31
```
or
```
php yii read-nginx-logs/index --startDate=2024-01-3010:00:00 --finishDate=2024-01-3113:00:00
```

*Read count nginx log from Clickhouse Command*
```
php yii read-count-nginx-logs/index --startDate=2024-01-01 --finishDate=2024-01-31
```
or
```
php yii read-count-nginx-logs/index --startDate=2024-01-0110:00:00 --finishDate=2024-01-3113:00:00
```

По міграції зробив через, не знайшов бібліотеку щоб корректно виконала міграцію
/.docker/clickhouse/init.sh


Потрапити в кліент clickhouse можно через комманду
```
docker-compose run clickhouse-client
```
