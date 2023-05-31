# ANARCHIV_APP By Russi Enzo
***

Software di gestione di un Database di soggetti con fotografie e collegamento a luoghi,veicoli, gruppi appartenenza e eventi.
Utilizza il Framework Laravel


### Requisiti installazione

- Server Web (IIS, APACHE)
- Php
- Sqlite3

Utilizzando XAMPP si può utilizzare su qualsiasi PC

- Installare composer

Il Database di appoggio è Sqlite3.


### Installazione


Scaricare decomprimere il repository in formato .zip in una cartella dei siti web rinominandola anarchiv-app

Nel file .env aggiornare il percorso del database 

```
# se usate xampp
DB_CONNECTION=sqlite
DB_DATABASE=C:\xampp\htdocs\anarchiv-app\database\anarchivdb.db

# usate IIS
DB_CONNECTION=sqlite
DB_DATABASE=C:\inetpub\wwwroot\anarchiv-app\database\anarchivdb.db


```

Poi lanciare i seguenti comandi per inizializzare il Database e creare l'utente **Admin** con passaword iniziale **password**.


```
composer update

php artisan migrate:fresh

php artisan db:seed --class:DatabaseSeeder

php artisan key:generate

```

se tutto è andato a buon fine l'applicazione sarà reperibile al link ***http://[ip del pc]/anarchiv-app/public***

***

