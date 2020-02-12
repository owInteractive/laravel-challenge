<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Mockery;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @covers \App\Repositories\UserRepository::__construct
     */
    public function testNewUserRepository()
    {
        $userSpy = Mockery::spy(User::class);
        $userRepository = new UserRepository($userSpy);
        $this->assertInstanceOf(UserRepository::class, $userRepository);
    }

    /**
     * @covers \App\Repositories\UserRepository::getWhereNotUserId
     */
    public function testGetWhereNotUserId()
    {
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturnSelf();
        $userMock->shouldReceive('where')
            ->once()
            ->with('id', '!=', 1)
            ->andReturn(new User());

        $userRepository = new UserRepository($userMock);
        $return = $userRepository->getWhereNotUserId(1);
        $this->assertInstanceOf(User::class, $return);
        $this->assertEquals(new User(), $return);
    }

    /**
     * @covers \App\Repositories\UserRepository::getUserByEmail
     */
    public function testGetUserByEmail()
    {
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('where')
            ->once()
            ->with('email', 'email@test.com')
            ->andReturnSelf();
        $userMock->shouldReceive('first')
            ->once()
            ->withNoArgs()
            ->andReturn(new User());

        $userRepository = new UserRepository($userMock);
        $return = $userRepository->getUserByEmail('email@test.com');
        $this->assertInstanceOf(User::class, $return);
        $this->assertEquals(new User(), $return);
    }
}