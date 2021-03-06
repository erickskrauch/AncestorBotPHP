<?php
/**
 * Roll random integer.
 * !roll or !roll [MIN] [MAX] or !roll [MAX]  — rolls a random integer (default !roll is from 1 to 6)
 */

return (
new class($handler) extends Ancestor\CommandHandler\Command {
    private $title = '***The dice strikes the ground!***';

    function __construct(Ancestor\CommandHandler\CommandHandler $handler) {
        parent::__construct($handler, 'roll', '``roll`` or ``roll [MIN] [MAX]`` or ``roll [MAX]`` - rolls a random integer (default ``roll`` is from 1 to 6)');
    }

    function run(\CharlotteDunois\Yasmin\Models\Message $message, array $args): void {
        $embedResponse = new \CharlotteDunois\Yasmin\Models\MessageEmbed();
        $embedResponse->setFooter($this->handler->client->user->username, $this->handler->client->user->getAvatarURL());
        $result = false;
        $argsLen = count($args);
        if ($argsLen === 1 && ctype_digit($args[0])) {
            $result = mt_rand(1, intval($args[0]));
        } elseif ($argsLen >= 2 && ctype_digit($args[0] . $args[1])) {
            $result = mt_rand(intval($args[0]), intval($args[1]));
        } else {
            $result = mt_rand(1, 6);
        }
        if (!is_int($result)){
            $message->reply('Invalid input');
            return;
        }
        $embedResponse->addField($this->title, '🎲**' . $result . '**');
        $message->channel->send('', array('embed' => $embedResponse));
    }


}
);