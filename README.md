## Instruções para rodar o projeto
 - php (versão: 8.3.1)
 - laravel (vesão: 10.3.2)
 - mysql (versão: 8.0.30)

### ATENÇÃO
- Atenção a extensão pdo_mysql no php.ini

### rodar migrations e popular o banco
 - php artisan migrate

### subir o servidor php
 - php artisan serve

### no Postman verificar se a URL gerada pelo php artisan serve esta correta
 - Valor default: http://127.0.0.1:8000

### ULR completa para teste
 - http://127.0.0.1:8000/api/products
