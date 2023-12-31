<?php

/**
 * This file is part of the Sysgram package.
 *
 * @author                       Javlonbek Tuychiyev
 * @author                       Javlonbek Tuychiyev <https://t.me/technolang>
 * @copyright                    President Tuychiyev <j.a.tuychiyev@gmail.com>
 *
 * @package composer             composer require azimjanovich/sysgram
 * @package git                  https://github.com/azimjanovich/sysgram.git
 * @version sysgram              Sysgram v 1.3
 * @version php                  >= v 8.0.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @link https://core.telegram.org/bots/api                 Documentation for the function.
 * @see https://github.com/azimjanovich/sysgram/README.md        You can get the full guide to using the index from
 *
 */

/**
 *
 * Additions to variables can also be made here or at Telegram \ Data
 * @var object     $update
 * @var object     $message                update->message
 * @var string     $text                   update->message
 * @var string     $data                   update->callback_query
 * @var integer    $message_id             message->message_id
 * @var integer    $chat_id                message->chat->id
 * @var audio      $audio                  message->audio
 * @var voice      $voice                  message->voice
 * @var video      $video                  message->video
 * @var video      $photo                  message->photo
 * @var document   $document               message->document
 * @var object     $forward_from           message->forward_from
 * @var object     $forward_from_chat      message->forward_from_chat
 * @var object     $callback_query         message->callback_query
 * @var integer    $callback_chat_id       callback_query->message->chat->id
 * @var integer    $callback_message_id    callback_query->message->message_id
 * @var string     $frist_name             message->from->frist_name
 * @var string     $last_name              message->from->last_name
 * @var string     $full_name              message->from->frist_name,  message->from->last_name
 * @var string     $username               message->from->username
 * @var string     $phone_number           message->contact->phone_number
 *
 */

/**
 * Standardization of incoming data via Telegram bot
 */

/**
 *
 * Set hook telegram bot
 *
 */

namespace Sysgram\Telegram\Hooks;

class Data
{

    public object $update;
    public object $message;
    public string $text;
    public string $data;

    /**
     *
     * All message data
     *
     */
    public int $message_id;
    public int $chat_id;
    public $audio;
    public $voice;
    public $video;
    public $photo;
    public $document;
    public $forward_from;
    public $forward_from_chat;

    /**
     *
     * All callback data
     *
     */
    public int $callback_query;
    public int $callback_chat_id;
    public int $callback_message_id;


    /**
     *
     * All User data
     *
     */
    public $frist_name;
    public $last_name;
    public $full_name;
    public $username;
    public $phone_number;


    public function __construct()
    {
        $this->update =  json_decode(file_get_contents('php://input'));
        $this->message =  $this->update->callback_query ? $this->update->callback_query : $this->update->message;

        $this->text = mb_convert_encoding($this->message->text, 'UTF-8', 'auto');
        $this->data = mb_convert_encoding($this->message->data, 'UTF-8', 'auto');

        $this->message_id =  $this->message->message_id;
        $this->chat_id = $this->message->chat->id;
        $this->audio = $this->message->audio;
        $this->voice = $this->message->voice;
        $this->video = $this->message->video;
        $this->photo = $this->message->photo;
        $this->document = $this->message->document;
        $this->forward_from = $$this->message->forward_from;
        $this->forward_from_chat = $this->message->forward_from_chat;

        $this->callback_query = $this->update->callback_query;
        $this->callback_chat_id = $this->callback_query->message->chat->id;
        $this->callback_message_id = $this->callback_query->message->message_id;

        $this->frist_name = $this->message->from->first_name;
        $this->last_name = $this->message->from->last_name;
        $this->full_name = $this->frist_name . " " . $this->last_name;
        $this->username = $this->message->from->username;
        $this->phone_number = $this->message->contact->phone_number;
    }
}
