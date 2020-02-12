<?php

namespace Tests\Unit;

use App\Business\EventsBusiness;
use App\Models\Events;
use App\Models\User;
use App\Repositories\EventsRepository;
use App\Services\ExportCSVService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class EventsBusinessTest extends TestCase
{
    /**
     * @covers \App\Business\EventsBusiness::__construct
     */
    public function testNewEventsBusiness()
    {
        $eventsRepositorySpy = Mockery::spy(EventsRepository::class);

        $eventsBusiness = new EventsBusiness($eventsRepositorySpy);
        $this->assertInstanceOf(EventsBusiness::class, $eventsBusiness);
    }

    /**
     * @covers \App\Business\EventsBusiness::getTodayEvents
     * @covers \App\Business\EventsBusiness::getEventsFromDate
     */
    public function testGetTodayEvents()
    {
        $date = Carbon::create(2020, 02, 11, 01);
        Carbon::setTestNow($date);

        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('getEventsFromDate')
            ->once()
            ->with('2020-02-11 00:00:00', '2020-02-11 23:59:59')
            ->andReturnUsing(function () {
                $event = new Events();
                $event->id = 1;
                $event->title = 'Title Test';
                $event->description = 'Description Test';
                $event->start_date = '2020-02-11 12:53:10';
                $event->end_date = '2020-02-11 13:53:10';
                $event->user_id = 1;
                return $event;
            });

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->getTodayEvents();

        $this->assertInstanceOf(Events::class, $return);
        $this->assertEquals('Title Test', $return->title);
        $this->assertEquals('Description Test', $return->description);
        $this->assertEquals('2020-02-11 12:53:10', $return->start_date);
        $this->assertEquals('2020-02-11 13:53:10', $return->end_date);
        $this->assertEquals(1, $return->user_id);
        Carbon::setTestNow();
    }

    /**
     * @covers \App\Business\EventsBusiness::getFiveDayEvents
     * @covers \App\Business\EventsBusiness::getEventsFromDate
     */
    public function testGetFiveDayEvents()
    {
        $date = Carbon::create(2020, 02, 11, 01);
        Carbon::setTestNow($date);

        $event1 = new Events();
        $event1->id = 1;
        $event1->title = 'Title Test';
        $event1->description = 'Description Test';
        $event1->start_date = '2020-02-11 12:53:10';
        $event1->end_date = '2020-02-11 13:53:10';
        $event1->user_id = 1;

        $event2 = new Events();
        $event2->id = 2;
        $event2->title = 'Title Test 2';
        $event2->description = 'Description Test 2';
        $event2->start_date = '2020-02-13 12:53:10';
        $event2->end_date = '2020-02-14 13:53:10';
        $event2->user_id = 1;

        $collection = new Collection();
        $collection->add($event1);
        $collection->add($event2);

        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('getEventsFromDate')
            ->once()
            ->with('2020-02-11 00:00:00', '2020-02-16 23:59:59')
            ->andReturn($collection);

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->getFiveDayEvents();

        $this->assertInstanceOf(Collection::class, $return);
        $this->assertInstanceOf(Events::class, $return[1]);
        $this->assertEquals('Title Test 2', $return[1]->title);
        $this->assertEquals('Description Test 2', $return[1]->description);
        $this->assertEquals('2020-02-13 12:53:10', $return[1]->start_date);
        $this->assertEquals('2020-02-14 13:53:10', $return[1]->end_date);
        $this->assertEquals(1, $return[1]->user_id);
        Carbon::setTestNow();
    }

    /**
     * @covers \App\Business\EventsBusiness::getAllPaginated
     */
    public function testGetAllPaginated()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);

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
            'perPage' => 1,
            'currentPage' => 1,
            "path" => "http://url:port/events",
        ];

        $eventsRepositoryMock->shouldReceive('paginate')
            ->once()
            ->withNoArgs()
            ->andReturn($lenghtAwarePaginatorMock);

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);

        $return = $eventsBusiness->getAllPaginated();
        $this->assertEquals(1, $return->currentPage);
        $this->assertInstanceOf(Collection::class, $return->items[0]);
        $this->assertInstanceOf(Events::class, $return->items[0][0]);
        $this->assertEquals($event, $return->items[0][0]);
        $this->assertEquals(2, $return->total);
    }

    /**
     * @covers \App\Business\EventsBusiness::create
     * @covers \App\Business\EventsBusiness::formatDateToInsert
     */
    public function testCreateEmptyParticipants()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);

        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['id' => 1]);

        $requestData = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '18-02-2020 17:07:43',
            'end_date' => '25-02-2020 17:07:45',
        ];

        $data = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-18 17:07:43',
            'end_date' => '2020-02-25 17:07:45',
            'user_id' => 1,
        ];

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title Test';
        $event->description = 'Description Test';
        $event->start_date = '2020-02-11 12:53:10';
        $event->end_date = '2020-02-11 13:53:10';
        $event->user_id = 1;


        $eventsRepositoryMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($event);

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->create($requestData);

        $this->assertTrue($return);
    }

    /**
     * @covers \App\Business\EventsBusiness::create
     * @covers \App\Business\EventsBusiness::formatDateToInsert
     */
    public function testCreateWithParticipants()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);

        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['id' => 1]);

        $requestData = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '18-02-2020 17:07:43',
            'end_date' => '25-02-2020 17:07:45',
            'participants' => ['2', '3'],
        ];

        $data = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-18 17:07:43',
            'end_date' => '2020-02-25 17:07:45',
            'user_id' => 1,
        ];

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title Test';
        $event->description = 'Description Test';
        $event->start_date = '2020-02-11 12:53:10';
        $event->end_date = '2020-02-11 13:53:10';
        $event->user_id = 1;


        $eventsRepositoryMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($event);

        $eventsRepositoryMock->shouldReceive('syncParticipants')
            ->once()
            ->with($event, ["2", "3"])
            ->andReturnSelf();

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->create($requestData);

        $this->assertTrue($return);
    }

    /**
     * @covers \App\Business\EventsBusiness::find
     */
    public function testFind()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title Test';
        $event->description = 'Description Test';
        $event->start_date = '2020-02-11 12:53:10';
        $event->end_date = '2020-02-11 13:53:10';
        $event->user_id = 1;

        $eventsRepositoryMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($event);

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->find(1);

        $this->assertInstanceOf(Events::class, $return);
        $this->assertEquals($event, $return);
    }

    /**
     * @covers \App\Business\EventsBusiness::delete
     */
    public function testDeleteSuccess()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andReturnSelf();

        $expected = [
            'success' => true,
            'message' => 'Event 1 deleted!',
        ];

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->delete(1);
        $this->assertEquals($expected, $return);
    }

    /**
     * @covers \App\Business\EventsBusiness::delete
     */
    public function testDeleteException()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andThrow(\Exception::class, 'Error while deleting!');

        $expected = [
            'success' => false,
            'message' => 'Error on deleting Event with id: 1',
            'exception' => 'Error while deleting!',
        ];

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->delete(1);
        $this->assertEquals($expected, $return);
    }

    /**
     * @covers \App\Business\EventsBusiness::update
     */
    public function testUpdateEventNotFound()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturnNull();

        $expected = [
            'success' => false,
            'message' => 'Event with id: 1 not found!',
        ];

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->update(1, []);
        $this->assertEquals($expected, $return);
    }


    /**
     * @covers \App\Business\EventsBusiness::update
     */
    public function testUpdateWithEvent()
    {
        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $requestData = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '18-02-2020 17:07:43',
            'end_date' => '25-02-2020 17:07:45',
            'participants' => ['2', '3'],
        ];

        $data = [
            '_token' => '3qr9JTBHyDZcjYGzbnO3vaT4x5BsDqPYteKOVIwH',
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-18 17:07:43',
            'end_date' => '2020-02-25 17:07:45',
        ];

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title Test';
        $event->description = 'Description Test';
        $event->start_date = '2020-02-11 12:53:10';
        $event->end_date = '2020-02-11 13:53:10';
        $event->user_id = 1;

        $eventsRepositoryMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($event);

        $eventsRepositoryMock->shouldReceive('update')
            ->once()
            ->with($event, $data)
            ->andReturnSelf();

        $eventsRepositoryMock->shouldReceive('syncParticipants')
            ->once()
            ->with($event, ["2", "3"])
            ->andReturnSelf();

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->update(1, $requestData);
        $this->assertTrue($return);
    }

    /**
     * @covers \App\Business\EventsBusiness::createEventsFromCSV
     * @covers \App\Business\EventsBusiness::create
     */
    public function testCreateEventsFromCSV()
    {
        $events = [
            [
                'title' => 'Title',
                'description' => 'Description',
                'start_date' => '2020-02-18 17:07:43',
                'end_date' => '2020-02-25 17:07:45',
                'participants' => ['2', '3']
            ]
        ];

        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['id' => 1]);

        $data = [
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-18 17:07:43',
            'end_date' => '2020-02-25 17:07:45',
            'user_id' => 1,
        ];

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title';
        $event->description = 'Description';
        $event->start_date = '2020-02-18 17:07:43';
        $event->end_date = '2020-02-25 17:07:45';
        $event->user_id = 1;

        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($event);

        $eventsRepositoryMock->shouldReceive('syncParticipants')
            ->once()
            ->with($event, ["2", "3"])
            ->andReturnSelf();

        $eventsBusiness = new EventsBusiness($eventsRepositoryMock);
        $return = $eventsBusiness->createEventsFromCSV($events);
        $this->assertTrue($return);
    }
}
