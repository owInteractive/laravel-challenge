<?php

namespace Tests\Unit;

use App\Business\EventsExportBusiness;
use App\Constants\EventsConstants;
use App\Models\Events;
use App\Models\User;
use App\Repositories\EventsRepository;
use App\Services\ExportCSVService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class EventsExportBusinessTest extends TestCase
{
    /**
     * @covers \App\Business\EventsExportBusiness::__construct
     */
    public function testNewEventsExportBusiness()
    {
        $eventsRepositorySpy = Mockery::spy(EventsRepository::class);
        $exportCSVServiceSpy = Mockery::spy(ExportCSVService::class);

        $return = new EventsExportBusiness($eventsRepositorySpy, $exportCSVServiceSpy);
        $this->assertInstanceOf(EventsExportBusiness::class, $return);
    }

    /**
     * @covers \App\Business\EventsExportBusiness::exportEvents
     * @covers \App\Business\EventsExportBusiness::buildRows
     */
    public function testExportEvents()
    {
        Auth::shouldReceive('user')
            ->once()
            ->withNoArgs()
            ->andReturn((object)['id' => 1]);

        $user = new User();
        $user->id = 2;
        $user->name = 'User test';
        $user->email = 'email@test.com';

        $event = new Events();
        $event->id = 1;
        $event->title = 'Title';
        $event->description = 'Description';
        $event->start_date = '2020-02-18 17:07:43';
        $event->end_date = '2020-02-25 17:07:45';
        $event->user_id = 1;
        $collection = new Collection();
        $collection->add($user);
        $event->setAttribute('participants', $collection);

        $collection = new Collection();
        $collection->add($event);

        $eventsRepositoryMock = Mockery::mock(EventsRepository::class);
        $eventsRepositoryMock->shouldReceive('getEventsFromUser')
            ->once()
            ->with(1)
            ->andReturn($collection);

        $rows[] = [
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-18 17:07:43',
            'end_date' => '2020-02-25 17:07:45',
            'participants' => 'email@test.com',
        ];

        $csv = "title,description,start_date,end_date,participants\nTitle,Description,\"2020-02-18 17:07:43\",\"2020-02-25 17:07:45\",email@test.com\n";
        $exportCSVServiceMock = Mockery::mock(ExportCSVService::class);
        $exportCSVServiceMock->shouldReceive('exportCsv')
            ->once()
            ->with(EventsConstants::CSV_HEADERS, $rows)
            ->andReturn($csv);

        $eventsExportBusines = new EventsExportBusiness($eventsRepositoryMock, $exportCSVServiceMock);
        $return = $eventsExportBusines->exportEvents();
        $this->assertEquals($csv, $return);
        $this->assertInternalType('string', $return);
    }

}