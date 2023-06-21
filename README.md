# blog-system

### Das Blog-System beinhaltet folgende Funktionen:
Registrierung, Anmeldung, Beiträge erstellen/bearbeiten/löschen, Kommentare verfassen, Authentifizierung, Validierung, Paginierung

## Projekt lokal einrichten und ausführen

### 1. Entwicklungsumgebung im Terminal lokal einrichten:

```
git clone git@github.com:ErikD51/blog-system.git
cd blog-system
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan cache:clear && php artisan config:clear
php artisan serve
```

### 2. Eine leere Datenbank 'blogsystem' erstellen

### 3. In der .env Datei die Datenbankzugangsdaten einrichten:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogsystem
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}
```

### 4. Die Tabellen migrieren:
```
php artisan migrate
```

### 5. Die URL http://localhost:8000/ aufrufen
