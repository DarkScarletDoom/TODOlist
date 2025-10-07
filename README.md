Инструкция по запуску проекта:
1) Cоздать .env файл скопировав .env.docker
2) Внутри контейнера приложения выполнить:
```console
composer i
php artisan generate:key
npm install
npm run build
```
