<?php

use App\Enums\IdeaStatusEnum;

return [
    'idea_status' => [
        IdeaStatusEnum::Waiting->value => 'в ожидании',
        IdeaStatusEnum::InWork->value => 'на рассмотрении',
        IdeaStatusEnum::Canceled->value => 'отклонено',
        IdeaStatusEnum::InQueue->value => 'в очереди',
        IdeaStatusEnum::Done->value => 'готово'
    ],
    'test' => 'suka'
];