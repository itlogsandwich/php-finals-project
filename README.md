# Phantom Route
## About
Finals school project created by @luc1ferxzx (Kyle) and I.

We created this website with security and privacy in mind.

Messages between users are hashed and encryped, likewise with their email (unusual, I know, but we wanted something interesting)

This is only for our school project and for fun.

**NOTE**: This website was deployed at ngrok and hosted manually. It is currently down and inactive.

**NOTE**: Images of the website can be seen at the bottom of the page. Heavily inspired by Silk Road.
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
git clone git@github.com:itlogsandwich/phantom-route.git
cd phantom-route
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
ensure MYSQL/MariaDB and Apache (XAMPP) is already running and listening.
```
start XAMPP

php artisan migrate
php artisan serve
```
### PS: As I was making this system, I forgot to implement seeders. Feel free to populate the database on your own or create your own seeders.

## Appearance
### Home Page
<img width="1107" height="946" alt="image" src="https://github.com/user-attachments/assets/b1e3758a-b32a-43ea-9269-1173b22641de" />

### Listings (All)
<img width="1108" height="475" alt="image" src="https://github.com/user-attachments/assets/ca45822c-b9e9-401d-ba80-aa09b1b5a625" />

### Create Listing
<img width="821" height="774" alt="image" src="https://github.com/user-attachments/assets/1d72d6f5-1005-4c88-96ba-e4f4c734d432" />

### View Listing (Products you're selling)
<img width="966" height="530" alt="image" src="https://github.com/user-attachments/assets/6a569e4a-4efe-4a76-90c5-50a74794a938" />

