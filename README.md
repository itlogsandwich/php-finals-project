# Black Market System

Finals school projected created by @luc1ferxzx (Kyle) and I.

We created this website with security and privacy in mind.

Messages between users are hashed and encryped, likewise with their email (unusual, I know, but we wanted something interesting)

Let it be clear that this is only for our SCHOOL PROJECT and is by no means associated with any ILLEGAL ACTIVITIES.

This website was deployed at ngrok and hosted manually. It is currently down and inactive.

## Prerequisites

### Windows Or Linux
- MySQL/MariaDB 
- Apache
- PHP
- Alternatively, XAMPP simplifies it for Windows (NOT RECOMMENDED, breaks randomly)

## Quick setup

### Linux

Clone and navigate to the system
```
git clone https://github.com/itlogsandwich/black-market-system
cd black-market-system
```
Before migrating your database and starting the server,
ensure MYSQL/MariaDB and Apache is already running and listening.
```
sudo systemctl start mariadb.service //mariadb
sudo systemctl start httpd.service //apache

php artisan migrate
php artisan serve
```
### Windows
Clone and navigate to the system
```
git clone https://github.com/itlogsandwich/black-market-system
cd black-market-system
```
Before migrating your database and starting the server,
ensure MYSQL/MariaDB and Apache is already running and listening.
```
start XAMPP

php artisan migrate
php artisan serve
```
### NOTE: As I was making this system, I forgot to implement seeders. Feel free to populate the database on your own or create your own seeders.

