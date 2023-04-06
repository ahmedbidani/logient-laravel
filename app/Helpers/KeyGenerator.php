<?php

namespace App\Helpers;

use Hashids\Hashids;
use App\Models\ShortLink;

class KeyGenerator
{
    /**
     * The library class that is used for generating
     * the unique hash.
     *
     * @var Hashids
     */
    private $hashids;

    /**
     * KeyGenerator constructor.
     */
    public function __construct()
    {
        $this->hashids = new Hashids('Logient/ShortLink', 5, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
    }

    /**
     * Generate a unique and random URL key using the
     * Hashids package. We start by predicting the
     * unique ID that the ShortURL will have in
     * the database. Then we can encode the ID
     * to create a unique hash. On the very
     * unlikely chance that a generated
     * key collides with another key,
     * we increment the ID and then
     * attempt to create a new
     * unique key again.
     *
     * @return string
     */
    public function generateRandom(): string
    {
        $ID = $this->getLastInsertedID();

        do {
            $ID++;
            $key = $this->hashids->encode($ID);
        } while (ShortLink::where('short_url', $key)->exists());

        return $key;
    }

    /**
     * Get the ID of the last inserted ShortURL. This
     * is done so that we can predict what the ID of
     * the ShortLink that will be inserted will be
     * called. From doing this, we can create a
     * unique hash without a reduced chance of
     * a collision.
     *
     * @return int
     */
    protected function getLastInsertedID(): int
    {
        if ($lastInserted = ShortLink::latest()->select('id')->first()) {
            return $lastInserted->id;
        }

        return 0;
    }
}