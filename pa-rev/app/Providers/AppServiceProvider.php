<?php

namespace App\Providers;

use App\Models\NotifPendaftaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckAbsensiSession;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Services\WhatsAppService;
use App\Services\AbsensiNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        
        Event::listen(
            Logout::class,
            function (Logout $event) {
                if ($event->user && $event->user->hasRole('guru_pembina')) {
                    session()->forget('has_opened_attendance');
                }
            }
        );


        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                Log::debug('View composer for notifications', ['user_id' => $user->id]);

                $notifications = NotifPendaftaran::where('receiver_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

                $unreadCount = NotifPendaftaran::where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->count();

                Log::debug('Notifications data', [
                    'count' => $notifications->count(),
                    'unread' => $unreadCount
                ]);

                $view->with([
                    'notifications' => $notifications,
                    'unreadNotificationsCount' => $unreadCount
                ]);
            }
        });
    }
}
