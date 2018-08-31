# Orders Counter by @fvlgnn || @cianaweb

* AMP (Apache2, MySQL5+, PHP7+)

* CodeIgniter 3.1.*
* Grocery Crud 1.6.*

* Bootstrap 3.*
* StartBootstrap - SB Admin

* jQuery 1.12.*
* font-awesome 4.7.*
* morris.js
* bootstrap-datepicker.js 

* import MySQL db from *./orderscounter.sql* file (some demonstration data and login user are already present)
* configure *application/config/database.php* file
* configure *application/config/email.php* file
* configure *application/config/configCustom.php* file in `email array();` set your sender address `'fromEmail'	=> 'sender@server.com'`
* configure *application/config/config.php* file. Set url `$config['base_url']` of webapp. Ex.  `$config['base_url'] = 'http://localhost/orderscounter/';` if it runs on `localhost` under `orderscounter` folder
* configure *./htaccess* file. Set the base path `RewriteBase` of webapp. Ex. `RewriteBase /orderscounter/` if it runs orderscounter` folder 
* First login
	* username: demo@server.com
	* password: password
* create a new *Admin* user and delete *demo@server.com* user