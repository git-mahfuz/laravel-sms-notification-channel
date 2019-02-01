## SMS Notification Channel in Laravel

#### SMS Provider Name: XYZ (for example)
If you want to send SMS via Laravel Notification class with the help of a custom notification channel along with **mail** and **database** driver you can check below classes as reference:

- `App\Notifications\NotifyLoginActivity;`
- `App\Channels\SmsChannel;`
- `App\Http\Controllers\HomeController` - An example use case

[Related reference in Laravel Documentation](https://laravel.com/docs/5.7/notifications#custom-channels).

##### - Thanks!
