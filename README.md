# Drive-in Cinema

## 🚀 Overview
Drive-in Cinema REST API

## 📦 Installation
   ```sh
   git clone https://github.com/feherdominik97/drive-in-cinema.git
   cd drive-in-cinema
   ````
   ```sh
   cp .env-example .env
   composer install
   npm i
   docker-compose up -d --build
   docker-compose exec app php artisan migrate:fresh --seed
   ```

Documentation: http://localhost:8000/api/documentation
