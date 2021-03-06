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
            'review' => [
                'metadata' => [
                    'description' => 'Human review',
                ],
            ],
            'merged',
            'closed' => [
                'metadata' => [
                    'bg_color' => 'DeepSkyBlue',
                ],
            ],
          ],
          'transitions' => [
            'submit'=> [
              'from' => 'start',
              'to' => 'test',
            ],
            'update'=> [
              'from' => ['coding', 'test', 'review'],
              'to' => 'test',
              'metadata' => [
                'arrow_color' => 'Turquoise',
              ],
            ],
            'wait_for_review'=> [
              'from' => 'test',
              'to' => 'review',
              'metadata' => [
                'color' => 'Orange',
              ],
            ],
            'request_change'=> [
              'from' => 'review',
              'to' => 'coding',
            ],
            'accept'=> [
              'from' => 'review',
              'to' => 'merged',
              'metadata' => [
                'label' => 'Accept PR',
              ],
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
