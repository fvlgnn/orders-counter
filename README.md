# OrdersCounter

**by @fvlgnn || @cianaweb**

---

## System

- AMP/EMP (Apache2/Nginx, MySQL5+/MariaDB10+, PHP7+)

---

## Framework

- CodeIgniter 3.1.*
- Grocery Crud 1.6.*

---

## Style

- Bootstrap 3.*
- StartBootstrap - SB Admin
- font-awesome 4.7.*

---

## JavaScrip

- jQuery 1.12.*
- morris.js
- bootstrap-datepicker.js 
---

## Setup

- First login
	- username: `demo@domain.com`
	- password: `password`
- create a new _Admin_ user and delete _demo@domain.com_ user
- Set CodeIgniter Environment _production/development_ in `.htaccess` first row

### Standalone

- import MySQL db from `orderscounter.sql` file (some demonstration data and login user are already present)
- configure `application/config/database.php` file
- configure `application/config/email.php` file
- configure `application/config/configCustom.php` file in `email array();` set your sender address `'fromEmail'	=> 'sender@domain.com'`
- configure `application/config/config.php` file. Set url `$config['base_url']` of webapp. Ex.  `$config['base_url'] = 'http://localhost/orderscounter/';` if it runs on `localhost` under `orderscounter` folder 

### Docker

- `docker-compose up --build -d`
- go to `http://localhost/`

---

## Description

- **Dashboard**: Insert orders (automaticaly split for first and second shift)
- **Statistics**: Show all orders statistics
- **Settings**: Set Orders, Items (foods/drinks), Types(tipology of foods/drinks), Users
- **User/Profile**: Edit your profile or change password
