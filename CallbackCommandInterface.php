<?php

namespace LArtie\Backend\Callbacks;

use Telegram\Bot\Api as Telegram;
use Telegram\Bot\Objects\CallbackQuery;
use Telegram\Bot\Objects\Update;

/**
 * Interface CallbackQueryInterface
 */
interface CallbackCommandInterface
{
    /**
     * @return array
     */
    public function getArguments() : array;

    /**
     * @param array $arguments
     * @return CallbackCommand
     */
    public function setArguments(array $arguments);

    /**
     * Get Callback Query Command Name
     *
     * The name of the Telegram callback query command.
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Set Callback Query Command Name
     *
     * @param string $name
     * @return CallbackCommand
     */
    public function setName(string $name);

    /**
     * Unique identifier for the query to be answered
     *
     * @return integer
     */
    public function getCallbackQueryId() : int;

    /**
     * Unique identifier for the query to be answered
     *
     * @param int $callbackQueryId
     * @return CallbackCommand
     */
    public function setCallbackQueryId(int $callbackQueryId);

    /**
     * Make command
     *
     * @param Telegram $telegram
     * @param Update $update
     * @param CallbackQuery $callbackQuery
     * @param array $arguments
     * @return
     */
    public function make(Telegram $telegram, Update $update, CallbackQuery $callbackQuery, array $arguments = []);
}