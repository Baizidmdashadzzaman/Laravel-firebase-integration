<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)
          ->withServiceAccount(storage_path('app/firebase/serviceAccountKey.json'))
          ->withDatabaseUri('https://bellivo-app-chat-default-rtdb.firebaseio.com/');

        $this->database = $factory->createDatabase();
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
