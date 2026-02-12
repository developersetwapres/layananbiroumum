<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\NotificationCleanupService;
use Illuminate\Support\Facades\Schedule;
use App\Services\NotificationService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


/*
|--------------------------------------------------------------------------
| Notification Auto Cleanup (05:00)
|--------------------------------------------------------------------------
*/

Schedule::call(function () {
    app(NotificationCleanupService::class)->clearAutoNotifications();
})->dailyAt('05:00')->name('clear-auto-notifications');


/*
|--------------------------------------------------------------------------
| Generate Notifications (06:00)
|--------------------------------------------------------------------------
*/
Schedule::call(function () {
    $service = app(NotificationService::class);

    $service->sendRoomReminders();
    $service->sendPendingOverdueNotifications();
})->dailyAt('06:00')->name('generate-notifications');
