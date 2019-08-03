<?php
$container->loadFromExtension('framework', [
    'workflows' => [
        'pull_request' => [
          'type' => 'state_machine',
          'supports' => ['App\Entity\PullRequest'],
          'places' => [
            'start',
            'coding',
            'test',
            'review',
            'merged',
            'closed',
          ],
          'transitions' => [
            'submit'=> [
              'from' => 'start',
              'to' => 'test',
            ],
            'update'=> [
              'from' => ['coding', 'test', 'review'],
              'to' => 'test',
            ],
            'wait_for_review'=> [
              'from' => 'test',
              'to' => 'review',
            ],
            'request_change'=> [
              'from' => 'review',
              'to' => 'coding',
            ],
            'accept'=> [
              'from' => 'review',
              'to' => 'merged',
            ],
            'reject'=> [
              'from' => 'review',
              'to' => 'closed',
            ],
            'reopen'=> [
              'from' => 'start',
              'to' => 'review',
            ],
          ],
        ],
    ],
]);
