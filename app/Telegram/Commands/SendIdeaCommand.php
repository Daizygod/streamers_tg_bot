<?php

namespace App\Telegram\Commands;

use App\Enums\IdeaStatusEnum;
use App\Models\Idea;
use Carbon\Carbon;
use Telegram\Bot\Commands\Command;

/**
 * Class HelpCommand.
 */
final class SendIdeaCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected string $name = 'send_idea';

    /**
     * @var array Command Aliases
     */
    protected array $aliases = ['sendIdea'];

    /**
     * @var string Command Description
     */
    protected string $description = 'Отправить идею что посмотреть';
    protected string $pattern = '{text: .*}';

    /**
     * {@inheritdoc}
     */
    public function handle(): void
    {
        $pattern = '~[a-z]+://\S+~';

        $ideaText = $this->argument('text', null);

        try {

            if (!is_null($ideaText) && strlen($ideaText) < 20) {
                $this->replyWithMessage(['text' => 'Можешь расписать подробнее?']);
            } elseif (is_null($ideaText)) {
                $this->replyWithMessage(['text' => 'Напиши текст что посмотреть:' . PHP_EOL . '/send_idea посмотри фильм "Гонка"']);
            } else {

                $linksCount = preg_match_all($pattern, $ideaText, $links);

                $alreadySended = false;
                if ($linksCount === 1) {

                    $link = $links[0][0];

                    if(str_ends_with($link, '/')) {
                        $link = substr($link, 0, -1);
                    }

                    $alreadySended = Idea::query()
                        ->whereNotIn('status', [IdeaStatusEnum::Canceled])
                        ->whereLike('message', "%$link%")
                        ->exists();
                }

                if ($alreadySended) {
                    $this->replyWithMessage(['text' => 'Такое уже было отсмотрено/отклонено']);
                } else {

                    $sameTextExists = Idea::query()
                        ->whereNotIn('status', [IdeaStatusEnum::Canceled])
                        ->where('message', $ideaText)
                        ->exists();

                    if ($sameTextExists) {
                        $this->replyWithMessage(['text' => 'Такое уже было отсмотрено/отклонено']);
                    } else {
                        $newIdea = new Idea();
                        $newIdea->message = $ideaText;
                        $newIdea->sender_tg = $this->getUpdate()->getMessage()->from->username;
                        $newIdea->created_at = Carbon::now()->timestamp;
                        $newIdea->status = IdeaStatusEnum::Waiting;

                        $newIdea->save();

                        $this->replyWithMessage(['text' => 'Принято']);
                    }
                }

            }

        } catch (\Exception $e) {

        }
    }
}
