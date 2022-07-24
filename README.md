# GoCache CDN Module for Magento 2

## Install

```
$ bin/composer require gocache/cdn:2.3.7.4
$ bin/magento module:enable GoCache_CDN
$ bin/magento setup:upgrade
$ bin/magento cache:flush
```

For configure the module:
In the Magento Admin => Stores => Configuration => Advanced => System

In Full Page Cache session is possible to set Caching Application to 'GoCache CDN' and in 'Configuração da GoCache' you must set the GoCache Token, GoCache Main Domain, and other parameters
