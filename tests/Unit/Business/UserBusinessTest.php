<?php

namespace Tests\Unit;

use App\Business\UserBusiness;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserBusinessTest extends TestCase
{
    /**
     * @covers \App\Business\UserBusiness::__construct
     */
    public function testNewUserBusiness()
    {
        $userRepositorySpy = Mockery::spy(UserRepository::class);

        $userBusiness = new UserBusiness($userRepositorySpy);
        $this->assertInstanceOf(UserBusiness::class, $userBusiness);
    }

    /**
     * @covers \App\Business\UserBusiness::create
     */
    public function testCreate()
    {
        $user = new User();
        $user->name = 'Teste';
        $user->email = 'email@test.com';

        $data = [
            'name' => 'Teste',
            'email' => 'email@test.com',
            'password' => '123',
        ];

        $userRepositoryMock = Mockery::mock(UserRepository::class);
        $userRepositoryMock->shouldReceive('create')
            ->once()
            ->andReturn($user);

        $userBusiness = new UserBusiness($userRepositoryMock);
        $return = $userBusiness->create($data);

        $this->assertInstanceOf(User::class, $return);
        $this->assertEquals($user, $return);
    }

    /**
     * @covers \App\Business\UserBusiness::getWhereNotCurrentUser
     */
    public function testGetWhereNotCurrentUser()
    {
        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['id' => 1]);

        $user = new User();
        $user->id = 2;
        $user->name = 'User test 2';
        $user->email = 'email@test2.com';

        $collection = new Collection();
        $collection->add($user);

        $userRepositoryMock = Mockery::mock(UserRepository::class);
        $userRepositoryMock->shouldReceive('getWhereNotUserId')
            ->once()
            ->with(1)
            ->andReturn($collection);

        $userBusiness = new UserBusiness($userRepositoryMock);
        $return = $userBusiness->getWhereNotCurrentUser();

        $this->assertInstanceOf(Collection::class, $return);
        $this->assertInstanceOf(User::class, $return[0]);
        $this->assertEquals($user, $return[0]);
    }

    /**
     * @covers \App\Business\UserBusiness::update
     */
    public function testUpdateWithoutPassword()
    {
        $data = [
            'name' => 'Name Test edit',
            'email' => 'email@testedit.com',
        ];

        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['email' => 'email@test.com']);

        $user = new User();
        $user->name = 'Name Test';
        $user->email = 'email@test.com';

        $userRepositoryMock = Mockery::mock(UserRepository::class);
        $userRepositoryMock->shouldReceive('getUserByEmail')
            ->once()
            ->with('email@test.com')
            ->andReturn($user);
        $userRepositoryMock->shouldReceive('update')
            ->once()
            ->with($user, $data)
            ->andReturnSelf();

        $userBusiness = new UserBusiness($userRepositoryMock);
        $return = $userBusiness->update($data);
        $this->assertTrue($return);
    }

    /**
     * @covers \App\Business\UserBusiness::update
     */
    public function testUpdateWithPassword()
    {
        $data = [
            'new_password' => '123',
        ];

        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['email' => 'email@test.com']);

        $user = new User();
        $user->name = 'Name Test';
        $user->email = 'email@test.com';

        $userRepositoryMock = Mockery::mock(UserRepository::class);
        $userRepositoryMock->shouldReceive('getUserByEmail')
            ->once()
            ->with('email@test.com')
            ->andReturn($user);
        $userRepositoryMock->shouldReceive('update')
            ->once()
            ->andReturnSelf();

        $userBusiness = new UserBusiness($userRepositoryMock);
        $return = $userBusiness->update($data);
        $this->assertTrue($return);
    }


}