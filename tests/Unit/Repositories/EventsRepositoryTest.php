<?php

namespace Tests\Unit\Repositories;

use App\Models\Events;
use App\Models\User;
use App\Repositories\EventsRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class EventsRepositoryTest extends TestCase
{
    /**
     * @covers \App\Repositories\EventsRepository::__construct
     */
    public function testNewEventsRepository()
    {
        $eventsSpy = Mockery::spy(Events::class);
        $eventsRepository = new EventsRepository($eventsSpy);
        $this->assertInstanceOf(EventsRepository::class, $eventsRepository);
    }

    /**
     * @covers \App\Repositories\EventsRepository::getEventsFromDate
     */
    public function testGetEventsFromDate()
    {
        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('whereBetween')
            ->once()
            ->with('start_date', ['2020-02-11 11:00:00', '2020-02-14 11:00:00'])
            ->andReturnSelf();
        $eventsMock->shouldReceive('orderBy')
            ->once()
            ->with('start_date')
            ->andReturnSelf();
        $eventsMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturnUsing(function () {
                $event = new Events();
                $event->start_date = '2020-02-12 11:00:00';
                $collection = new Collection();
                $collection->add($event);
                return $collection;
            });

        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->getEventsFromDate('2020-02-11 11:00:00', '2020-02-14 11:00:00');
        $this->assertInstanceOf(Collection::class, $return);
        $this->assertInstanceOf(Events::class, $return[0]);
        $this->assertEquals('2020-02-12 11:00:00', $return[0]->start_date);
    }

    /**
     * @covers \App\Repositories\EventsRepository::paginate
     */
    public function testPaginate()
    {
        $event = new Events();
        $event->id = 1;
        $event->title = 'Title Test';
        $event->description = 'Description Test';
        $event->start_date = '2020-02-11 12:53:10';
        $event->end_date = '2020-02-11 13:53:10';
        $event->user_id = 1;

        $event2 = new Events();
        $event->id = 2;
        $event->title = 'Title Test 2';
        $event->description = 'Description Test 2';
        $event->start_date = '2020-02-12 12:53:10';
        $event->end_date = '2020-02-12 13:53:10';
        $event->user_id = 1;

        $collection = new Collection();
        $collection->add($event);
        $collection->add($event2);

        $lenghtAwarePaginatorMock = (object)[
            'total' => 2,
            'lastPage' => 2,
            'items' => [$collection],
            "from" => 1,
            'perPage' => 10,
            'currentPage' => 1,
            "path" => "http://url:port/events",
            "next_page_url"=>"http://url:port/events?page=2",
        ];

        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('paginate')
            ->once()
            ->with(10)
            ->andReturn($lenghtAwarePaginatorMock);
        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->paginate();
        $this->assertEquals($lenghtAwarePaginatorMock, $return);
    }

    /**
     * @covers \App\Repositories\EventsRepository::find
     */
    public function testFind()
    {
        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('with')
            ->once()
            ->with('user', 'participants')
            ->andReturnSelf();
        $eventsMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn(new Events());

        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->find(1);
        $this->assertInstanceOf(Events::class, $return);
        $this->assertEquals(new Events(), $return);
    }

    /**
     * @covers \App\Repositories\EventsRepository::delete
     */
    public function testDelete()
    {
        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturnSelf();
        $eventsMock->shouldReceive('delete')
            ->once()
            ->withNoArgs()
            ->andReturn(true);

        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->delete(1);
        $this->assertTrue($return);
    }

    /**
     * @covers \App\Repositories\EventsRepository::syncParticipants
     */
    public function testSyncParticipants()
    {
        $expected = [
            "attached" => [1, 3],
            "detached" => [],
            "updated" => []
        ];

        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('participants')
            ->once()
            ->withNoArgs()
            ->andReturnSelf();
        $eventsMock->shouldReceive('sync')
            ->once()
            ->with([1, 3])
            ->andReturn($expected);

        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->syncParticipants($eventsMock, [1, 3]);
        $this->assertEquals($expected, $return);
    }

    /**
     * @covers \App\Repositories\EventsRepository::getEventsFromUser
     */
    public function testGetEventsFromUser()
    {
        $event = new Events();
        $event->id = 1;
        $event->title = 'Title';
        $event->description = 'Description';
        $event->start_date = '2020-02-18 17:07:43';
        $event->end_date = '2020-02-25 17:07:45';
        $event->user_id = 1;

        $user = new User();
        $user->id = 1;
        $user->name = 'User test1';
        $user->email = 'email@test1.com';

        $collection = new Collection();
        $collection->add($user);
        $event->setAttribute('user', $collection);

        $userParticipant = new User();
        $userParticipant->id = 2;
        $userParticipant->name = 'User test2';
        $userParticipant->email = 'email@test2.com';
        $collection = new Collection();
        $collection->add($userParticipant);
        $event->setAttribute('user', $collection);

        $collection = new Collection();
        $collection->add($event);


        $eventsMock = Mockery::mock(Events::class);
        $eventsMock->shouldReceive('where')
            ->once()
            ->with('user_id', 1)
            ->andReturnSelf();
        $eventsMock->shouldReceive('with')
            ->once()
            ->with('user', 'participants')
            ->andReturnSelf();
        $eventsMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn($collection);

        $eventsRepository = new EventsRepository($eventsMock);
        $return = $eventsRepository->getEventsFromUser(1);
        $this->assertInstanceOf(Collection::class, $return);
        $this->assertInstanceOf(Events::class, $return[0]);
        $this->assertEquals($event, $return[0]);
    }
}
