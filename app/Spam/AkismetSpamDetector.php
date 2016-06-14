<?php

namespace Lio\Spam;

use Lio\Users\User;
use TijsVerkoyen\Akismet\Akismet;

class AkismetSpamDetector implements SpamDetector
{
    /**
     * @var \TijsVerkoyen\Akismet\Akismet
     */
    private $akismet;

    public function __construct(Akismet $akismet)
    {
        $this->akismet = $akismet;
    }

    /** @inheritdoc */
    public function detectsSpam($value, User $user = null)
    {
        $name = $user ? $user->name : null;
        $email = $user ? $user->email : null;

        if (! $this->akismet->verifyKey()) {
            return false;
        }

        return $this->akismet->isSpam($value, $name, $email);
    }
}
