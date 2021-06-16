# Wirtualna Biblioteka

## Instalacja

Do poprawnego działania aplikacji należy posiadać zainstalowne:

-   Framework Laravel 8.x.x (https://laravel.com/docs/8.x)
-   Język PHP 8.x.x (https://www.php.net/manual/en/install.php)

Kolejnymi krokami instalacji są

:warning: **Użytkownik bazy danych powinien posiadać uprawnienia do akcji takich jak:**

-   SELECT
-   INSERT
-   UPDATE
-   DELETE
-   CREATE
-   DROP
-   ALTER

```
# Przejście do katalogu z aplikacją
$ cd Diploma-project

# Instalacja zależności przy pomocy Composera
$ composer install

# Instalacja zależności przy pomocy NPM
$ npm install

# Zmiana nazwy pliku .env.example
$ .env.example -> .env

# Konfiguracja lokalnej bazy danych w pliku .env
$ DB_CONNECTION=mysql
$ DB_HOST=127.0.0.1
$ DB_PORT=3306
$ DB_DATABASE="NAZWA BAZY DANYCH"
$ DB_USERNAME="NAZWA UŻYTKOWNIKA"
$ DB_PASSWORD= "HASŁO UŻYTKOWNIKA"

# Uruchomienie migracji, w tym przypadku mamy do wyboru 2 opcje

* Migrację samej struktury bazy danych
php artisan migrate

* Migrację bazy danych wypełnionej użytkownikami
php artisan migrate --seed
```
