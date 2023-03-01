<p align="center"><a href="https://laravel.com" target="_blank"><img src="documentation/HostsTable.png" width="400"></a></p>


<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About NetMap

NetMap simply parse [nmap](https://nmap.org/) XML ouptput and save hosts on (local) network in a MySQL/MariaDB table.

A name can be associated with host (interface) retrieved by MAC address.


## Console/Cli parser


[app/Console/Commands/NmapParser.php](app/Console/Commands/NmapParser.php)

## Crontab scan network every 5 minutes

Example script to scan, save XML and import results with parser [crontask.sh](crontask.sh)

```
*/5 * * * * ~/websites/NetNmap/crontask.sh >/dev/null 2>&1
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
