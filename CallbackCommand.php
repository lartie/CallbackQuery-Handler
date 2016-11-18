<?php

namespace LArtie\Backend\Callbacks;

use Telegram\Bot\Answers\Answerable;
use Telegram\Bot\Api as Telegram;
use Telegram\Bot\Objects\CallbackQuery;
use Telegram\Bot\Objects\Update;

/**
 * Class CallbackCommand
 * @package LArtie\FlyingHighBot\Callbacks
 *
 * Абстракция задающая структуру классов для обработки колбеков в telegram bot api
 */
abstract class CallbackCommand implements CallbackCommandInterface
{
    use Answerable;

    /**
     * The name of the Telegram callback query command.
     *
     * @var string
     */
    protected $name;

    /**
     * Unique identifier for the query to be answered
     *
     * @var integer
     */
    protected $callbackQueryId;

    /**
     * Arguments passed to the command.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * This object represents an incoming callback query from a callback button in an inline keyboard.
     * If the button that originated the query was attached to a message sent by the bot, the field message will be presented.
     * If the button was attached to a message sent via the bot (in inline mode), the field inline_message_id will be presented.
     *
     * @var CallbackQuery
     */
    protected $callbackQuery;

    /**
     * @var bool
     */
    protected $autoAnswer = false;

    /**
     * @return array
     */
    public function getArguments() : array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * Get Callback Query Command Name
     *
     * The name of the Telegram callback query command.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set Callback Query Command Name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Unique identifier for the query to be answered
     *
     * @return integer
     */
    public function getCallbackQueryId() : int
    {
        return $this->callbackQueryId;
    }

    /**
     * Unique identifier for the query to be answered
     *
     * @param int $callbackQueryId
     * @return $this
     */
    public function setCallbackQueryId(int $callbackQueryId)
    {
        $this->callbackQueryId = $callbackQueryId;
        return $this;
    }

    /**
     * @param Telegram $telegram
     * @param Update $update
     * @param CallbackQuery $callbackQuery
     * @param array $arguments
     */
    public function make(Telegram $telegram, Update $update, CallbackQuery $callbackQuery, array $arguments = [])
    {
        $this->telegram = $telegram;
        $this->arguments = $arguments;
        $this->update = $update;
        $this->callbackQuery = $callbackQuery;

        $this->handle();

        if ($this->autoAnswer) {
            $this->getTelegram()->answerCallbackQuery([
                'callback_query_id' => $this->callbackQuery->getId(),
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    abstract public function handle();
}