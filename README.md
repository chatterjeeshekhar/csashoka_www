# Computer Science Department Website
#### Organization: Ashoka University

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

Revamped Website for Computer Science Department at Ashoka University

### Installation

This project requires `PHP 5.6+` and `MySQL 5.4` to work as expected.

Installing the Database:

```
git clone https://github.com/chatterjeeshekhar/csashoka_www
cd csashoka_www/database
mysql -u [username] -p csashoka < csashoka.sql
```


Modifying the Address on Database:

```
mysql -u [username] -p
USE csashoka;
UPDATE cs_options SET option_value='https://cs.ashoka.edu.in' WHERE option_name IN ('siteurl', 'home');
```

On a virual machine, install Apache using the following:

```
sudo apt-get install apache2 (for Debian/Ubuntu)
sudo yum install httpd (for RHEL/CentOS)
```

### Configuration (Virtual Machine)

Configure the Apache Configuration File by navigating to `\etc\apache2\apache2.conf` (in Debian/Ubuntu) or `\etc\httpd\httpd.conf` (in RHEL/CentOS) and add the following lines of code at the end of the configuration:

```
<VirtualHost *:80>
    DocumentRoot /var/www/html/csashoka
    ServerName cs.ashoka.edu.in
</VirtualHost>
```

Restart the server by executing the following command:

```
sudo service apache2 restart (for Debian/Ubuntu)
sudo service httpd restart (for RHEL/CentOS)
```

### Configuration (WordPress Installation)

Navigate to the project directory and copy the configration file

```
cd /var/www/html/csashoka
cp wp-config-backup.php wp-config.php
```

Edit the file in your editor of choice and the modify the following lines of code with your records (lines 26-32):

```
/** MySQL database username */
define('DB_USER', 'XXXXXX');

/** MySQL database password */
define('DB_PASSWORD', 'XXXXXX');

/** MySQL hostname */
define('DB_HOST', 'XXXXXX');
```

### SSL Installation (Required)

A detailed instruction guide to install Free SSL by the [LetsEncrypt](https://letsencrypt.org/getting-started/) is available [here on CertBot](https://certbot.eff.org/)

### Running the Application

Restart the server by executing the following command:

```
sudo service apache2 restart (for Debian/Ubuntu)
sudo service httpd restart (for RHEL/CentOS)
```

Navigate to [cs.ashoka.edu.in](https://cs.ashoka.edu.in)

### Contributions
Shekhar Chatterjee ([GitHub](https://github.com/chatterjeeshekhar)) (Design and Development)
Archit Checker ([GitHub](https://github.com/checker5965)) (Content)
