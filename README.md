# newsletter
## Simple newsletter platform write in Laravel

* Subscribers
* Mailing lists
* Email templates powered by TinyMce with [Filemanager](https://github.com/UniSharp/laravel-filemanager)
* Campaigns

All emails are sended by cron task so remember to set cron every minute

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

Number of emails send in one task (every minute) is set in .env 'MAILS_ONE_TASK' variable.