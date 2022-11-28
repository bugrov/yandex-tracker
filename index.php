<?php

use BugrovWeb\YandexTracker\Api\Board;
use BugrovWeb\YandexTracker\Api\Queue;
use BugrovWeb\YandexTracker\Api\Tracker;
use BugrovWeb\YandexTracker\Helpers\TimeManager;

require './vendor/autoload.php';

$api = new Tracker('token', 'x-org-id');

// получить текущего юзера
try {
    $req = $api->user()
        ->getInfo()
        ->send();
    var_dump($req->getResponse());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

// создать задачу
try {
    $req = $api->issue()
        ->create()
        ->queue('TEST')
        ->summary('Тестовая задача')
        ->description('Тестовая задача')
        ->type('task')
        ->assignee('1234567890')
        ->send();
    var_dump($req->getResponse());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

// создать очередь
try {
    $req = $api->queue()
        ->create()
        ->key('SUPER')
        ->name('Super')
        ->lead('1234567890')
        ->defaultType('task')
        ->defaultPriority('normal')
        ->issueTypesConfig([
            [
                'issueType' => 'task',
                'workflow' => Queue::WORKFLOW_SOFTWARE_DEV,
                'resolutions' => ['fixed', 'wontFix', 'duplicate', 'later', 'overfulfilled', 'successful', 'dontDo']
            ],
            [
                'issueType' => 'bug',
                'workflow' => Queue::WORKFLOW_SUPPORT,
                'resolutions' => ['fixed', 'duplicate', 'wontFix', 'cantReproduce', 'later', 'overfulfilled', 'dontDo']
            ]
        ])
        ->send();
    var_dump($req->getResponse());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

// создать доску
try {
    $req = $api->board()
        ->post()
        ->name('Доска проектов TEST')
        ->defaultQueue('TEST')
        ->boardType(Board::BOARD_TYPE_KANBAN)
        ->filter([
            'queue' => 'TEST'
        ])
        ->send();
    var_dump($req->getResponse());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}

// внести время в задачу
try {
    $isoTime = (new TimeManager())
        ->minute(20)
        ->hour(1)
        ->second(32)
        ->getISOTime();
    $req = $api->worklog()
        ->new('TEST-1')
        ->start('2022-11-13T13:01:00Z')
        ->duration($isoTime)
        ->comment('TEST')
        ->send();
    var_dump($req->getResponse());
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}
