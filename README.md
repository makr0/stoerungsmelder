# Der Störungsmelder

Live Demo: http://stoerungsmelder.r00tmakr0.org/
Das Ganze Ding hier basiert auf [Symfony][1].

## Installation unter Windows
### Voraussetzungen

  * PHP für Windows (für die kommandozeile)

  * XAMPP für Windows (für den Webserver)

  * [Composer] [2] (für die Installation diverser Komponenten)

### PHP installieren
PHP nach c:\php5 installieren. Siehe [windows.php.net][3].

### [XAMPP][4] Konfigurieren

  * in conf/httpd.conf vhost_alias_module aktivieren

  * in conf/extra/httpd-vhosts.conf folgendes eintragen
```
<VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/"
       ServerName localhost
</VirtualHost>
<VirtualHost *:80>
       ServerAlias *.localhost
       VirtualDocumentRoot "C:/xampp/htdocs/%1/web"
</VirtualHost>
```
  * Projekt nach C:/xampp/htdocs/stoerungsmelder.localhost kopieren oder auschecken

  * in diesem Verzeichnis: `composer install` ausführen. Kann länger dauern, der lädt das halbe Internet runter.

  * Wenn composer fertig ist, fragt er nach dem Database Login.

### Projekt initialisieren

  * `php app/console doctrine:database:create`
  * `php app/console doctrine:schema:create`
  * Admin-user hinzufügen (admin/admin)
  * php app/console -env=dev --append doctrine:fixtures:load

### fast fertig

  * stoerungsmelder.localhost in hosts-Datei einfügen:
```
# xampp vhosts
127.0.0.1 stoerungsmelder.localhost
```

  * http://stoerungsmelder.localhost im browser aufrufen

### Default User
Folgende User werden durch die Fixtures erstellt:

  * Administrator (admin:admin)
  * Arbeiter (worker:worker)
  * Reparatur (reparatur:reparatur)
  * Teamleiter (teamleiter:teamleiter)
  * Produktionsleiter (produktionsleiter:produktionsleiter)

Die Zugriffsrechte auf die verschiedenen Funktionen werden in  src/AppBundle/Resources/featureaccess.yml festgelegt.


[1]:  https://symfony.com/doc/2.7/book/
[2]:  https://getcomposer.org/Composer-Setup.exe
[3]:  http://windows.php.net/download/
[4]:  https://www.apachefriends.org/de/download.html
