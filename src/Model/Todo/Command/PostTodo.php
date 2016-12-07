<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ProophessorDo\Model\Todo\Command;

use Prooph\ProophessorDo\Model\User\UserId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Prooph\ProophessorDo\Model\Todo\TodoId;

/**
 * Class PostTodo
 *
 * @package Prooph\ProophessorDo\Model\Todo
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class PostTodo extends Command implements PayloadConstructable
{
    use PayloadTrait;
    /**
     * @param string $assigneeId
     * @param string $text
     * @param string $todoId
     * @return PostTodo
     */
    public static function forUser($assigneeId, $text, $todoId)
    {
        return new self([
            'assignee_id' => (string)$assigneeId,
            'todo_id' => (string)$todoId,
            'text' => (string)$text
        ]);
    }

    /**
     * @return TodoId
     */
    public function todoId()
    {
        return TodoId::fromString($this->payload['todo_id']);
    }

    /**
     * @return UserId
     */
    public function assigneeId()
    {
        return UserId::fromString($this->payload['assignee_id']);
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->payload['text'];
    }
}
