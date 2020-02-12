<?php

namespace Tests\Unit;

use App\Business\EventsImportBusiness;
use App\Constants\EventsConstants;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ImportCSVService;
use Mockery;
use Tests\TestCase;

class EventsImportBusinessTest extends TestCase
{

    /**
     * @covers \App\Business\EventsImportBusiness::__construct
     */
    public function testNewEventsImportBusiness()
    {
        $importCSVServiceSpy = Mockery::spy(ImportCSVService::class);
        $userRepositorySpy = Mockery::spy(UserRepository::class);

        $eventsImportBusiness = new EventsImportBusiness($importCSVServiceSpy, $userRepositorySpy);

        $this->assertInstanceOf(EventsImportBusiness::class, $eventsImportBusiness);
    }

    /**
     * @covers \App\Business\EventsImportBusiness::extractEvents
     */
    public function testExtractEvents()
    {
        $data = "title,description,start_date,end_date,participants\nTest,Description,\"2020-02-11 20:32:05\",\"2020-02-11 20:32:06\",email@test.com\n";
        $rows[] = [
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-11 20:32:05',
            'end_date' => '2020-02-11 20:32:06',
            'participants' => 'teste@teste.com',
        ];
        $importCSVServiceMock = Mockery::mock(ImportCSVService::class);
        $importCSVServiceMock->shouldReceive('extractRows')
            ->once()
            ->with(EventsConstants::CSV_HEADERS, $data, EventsConstants::CSV_REQUIRED_VALUES)
            ->andReturn($rows);

        $userRepositoryMock = Mockery::mock(UserRepository::class);
        $userRepositoryMock->shouldReceive('getUserByEmail')
            ->once()
            ->with('teste@teste.com')
            ->andReturnUsing(function () {
                $user = new User();
                $user->id = 2;
                return $user;
            });

        $expected[] = [
            'title' => 'Title',
            'description' => 'Description',
            'start_date' => '2020-02-11 20:32:05',
            'end_date' => '2020-02-11 20:32:06',
            'participants' => [
                2
            ],
        ];

        $eventsImportBusiness = new EventsImportBusiness($importCSVServiceMock, $userRepositoryMock);
        $return = $eventsImportBusiness->extractEvents($data);
        $this->assertEquals($expected, $return);
    }

}