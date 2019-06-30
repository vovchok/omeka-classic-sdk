<?php

namespace OmekaClassicTest\Representation;


use OmekaClassic\Representation\User;
use OmekaClassicTest\TestCase;
use OmekaClassic\Exception\LogicException;

class UserTest extends TestCase
{
    public function testGet()
    {
        $user = new User(static::$transport);
        $user->get(1); // 1 Super User

        $this->assertTrue($user->isActive());
    }

    public function testCreate()
    {
        $this->expectException(LogicException::class);

        $user = new User(static::$transport);
        $user->create();
    }

    public function testUpdate()
    {
        $this->expectException(LogicException::class);

        $user = new User(static::$transport);
        $user->get(1); // 1 Super User

        $user->update();
    }

    public function testDelete()
    {
        $this->expectException(LogicException::class);

        $user = new User(static::$transport);
        $user->get(1); // 1 Super User

        $user->delete();
    }
}
