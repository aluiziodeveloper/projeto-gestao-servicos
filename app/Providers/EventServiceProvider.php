<?php

namespace GestaoServicos\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'GestaoServicos\Events\Event' => [
            'GestaoServicos\Listeners\EventListener',
        ],
        'GestaoServicos\Events\UserCreatedEvent' => [
            'GestaoServicos\Listeners\SendMailToDefinePassword',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
