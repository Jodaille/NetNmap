<p align="center"><a href="documentation/HostsTable.png" target="_blank"><img src="documentation/HostsTable.png" width="400"></a></p>


<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About NetNmap

NetNmap simply parse [ nmap ](https://nmap.org/) XML ouptput and save hosts on (local) network in a MySQL/MariaDB table.

<p>Host (interface) retrieved by MAC address can be named. I have several esp8266/SonOff and never remember which is which</p>

<p>&nbsp;</p>

## Console/Cli parser

It uses Laravel, main simple code is done in:

[app/Console/Commands/NmapParser.php](app/Console/Commands/NmapParser.php)

<p>&nbsp;</p>

## Crontab example to scan network every 5 minutes

Script to scan, save XML and import results with parser [crontask.sh](crontask.sh)

```
*/5 * * * * ~/websites/NetNmap/crontask.sh >/dev/null 2>&1
```


or basically:
```
sudo nmap -oX storage/nmap.xml  -sn 192.168.1.0/24 && php artisan nmap:parse storage/nmap.xml
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

NetNmap is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
