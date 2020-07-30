<?php
declare(strict_types=1);

namespace GestaoServicos\Events;

use GestaoServicos\Models\User;

class UserCreatedEvent
{
    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
