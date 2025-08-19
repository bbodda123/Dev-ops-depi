# Nginx + PHP-FPM Configuration Documentation

## 📌 Overview

This project contains configuration files for **Nginx** and **PHP-FPM** that work together to serve a PHP application.  
Nginx acts as the **web server** and reverse proxy, while PHP-FPM (FastCGI Process Manager) handles the PHP code execution.

---

## 🛠 Components

### 1. **Nginx Configuration Files**

These files define how Nginx should handle requests and serve your PHP application.

#### Example: `/etc/nginx/sites-available/myapp.conf`

```nginx
server {
    listen 90;
    server_name TcpPhp;

    root /mnt/c/depi/scripts/One/secondTask;
    index tcp.php;

    location / {
        try_files $uri $uri/ /tcp.php;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```
