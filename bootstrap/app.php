<?php

use App\Http\Middleware\AuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateExpiredBookingsCommand;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            "admin" => AdminMiddleware::class,
            "checkLogin" => AuthMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        UpdateExpiredBookingsCommand::class,
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('bookings:update-expired')->daily();
    })
    ->create();