<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\Database;

class FirebaseController extends Controller

{

//

public function index(){

// $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Laraveltesting-6aeda3a963f2.json');

// $firebase = (new Factory)

// ->withServiceAccount($serviceAccount)

// ->withDatabaseUri('https://e-clinic-5e825.firebaseio.com/')

// ->create();

// $database = $firebase->getDatabase();

// $newPost = $database

// ->getReference('blog/posts')

// ->push([

// 'title' => 'Post title',

// 'body' => 'This should probably be longer.'

// ]);

//$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-

//$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

//$newPost->getChild('title')->set('Changed post title');

//$newPost->getValue(); // Fetches the data from the realtime database

//$newPost->remove();


$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Laraveltesting-6aeda3a963f2.json');

$firebase = (new Factory)

->withServiceAccount($serviceAccount)

->withDatabaseUri('https://askurdr-21669.firebaseio.com/')

->create();

$database = $firebase->getDatabase();

$newPost = $database

->getReference('blog/posts')

->push([

'title' => 'Post title',

'body' => 'This should probably be longer.'

]);

echo"<pre>";

print_r($newPost->getvalue());

}

}

?>