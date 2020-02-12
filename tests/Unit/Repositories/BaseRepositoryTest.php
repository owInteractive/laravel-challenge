<?php

namespace Tests\Unit\Repositories;

use App\Models\Events;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Tests\TestCase;

class BaseRepositoryTest extends TestCase
{
    /**
     * @covers \App\Repositories\BaseRepository::__construct
     */
    public function testNewBaseRepository()
    {
        $modelSpy = Mockery::spy(Model::class);
        $baseRepositoryMock = Mockery::mock(BaseRepository::class, [$modelSpy]);
        $this->assertInstanceOf(BaseRepository::class, $baseRepositoryMock);
    }

    /**
     * @covers \App\Repositories\BaseRepository::create
     */
    public function testCreate()
    {
        $data = [
            'title' => 'Title',
            'description' => 'Description',
        ];


        $eventMock = Mockery::mock(Events::class);
        $eventMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturnUsing(function () {
                $events = new Events();
                $events->title = 'Title';
                $events->description = 'Description';
                return $events;
            });

        $baseRepositoryMock = Mockery::mock(BaseRepository::class, [$eventMock])->makePartial();
        $return = $baseRepositoryMock->create($data);
        $this->assertInstanceOf(Events::class, $return);
        $this->assertEquals('Title', $return->title);
        $this->assertEquals('Description', $return->description);
    }

    /**
     * @covers \App\Repositories\BaseRepository::get
     */
    public function testGet()
    {
        $collection = new Collection();
        $collection->add(new Events());

        $eventMock = Mockery::mock(Events::class);
        $eventMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn($collection);

        $baseRepositoryMock = Mockery::mock(BaseRepository::class, [$eventMock])->makePartial();
        $return = $baseRepositoryMock->get();
        $this->assertInstanceOf(Collection::class, $return);
        $this->assertInstanceOf(Events::class, $return[0]);
    }

    /**
     * @covers \App\Repositories\BaseRepository::update
     */
    public function testupdate()
    {
        $data = [
            'name' => 'Test',
        ];

        $userSpy = Mockery::spy(User::class);
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('update')
            ->once()
            ->with($data)
            ->andReturn(true);

        $baseRepositoryMock = Mockery::mock(BaseRepository::class, [$userSpy])->makePartial();
        $return = $baseRepositoryMock->update($userMock, $data);
        $this->assertTrue($return);
    }
}