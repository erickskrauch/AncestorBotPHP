<?php
/**
 * "Give random reward" command
 */

return(
    new class($handler) extends Ancestor\CommandHandler\Command {
        function __construct(Ancestor\CommandHandler\CommandHandler $handler)
        {
            parent::__construct($handler, 'gold', 'Gives a random reward.');
        }
        function run(\CharlotteDunois\Yasmin\Models\Message $message, array $args): void
        {
            $embedResponse = new \CharlotteDunois\Yasmin\Models\MessageEmbed();
            $embedResponse->setTitle(\Ancestor\RandomData\RandomDataProvider::GetRandomRewardQuote());
            $embedResponse->setImage(\Ancestor\RandomData\RandomDataProvider::GetRandomReward());
            $message->channel->send('', array('embed' => $embedResponse));
        }
    }
);