<?php

namespace Tests\Unit\Services;

use App\Services\ExportCSVService;
use League\Csv\Writer;
use Mockery;
use Tests\TestCase;

class ExportCSVServiceTest extends TestCase
{

    /**
     * @covers \App\Services\ExportCSVService::exportCsv
     */
    public function testExportCsv()
    {
        $headers = ['owner', 'title', 'description', 'start_date', 'end_date', 'participants'];
        $rows[] = ['owner@test.com', 'Title', 'Description', '2020-02-18 17:07:43', '2020-02-25 17:07:45', 'email@test.com'];
        $expected = "owner,title,description,start_date,end_date,participants\nowner@test.com,Title,Description,\"2020-02-18 17:07:43\",\"2020-02-25 17:07:45\",email@test.com\n";

        $writerMock = Mockery::mock('alias:' . Writer::class);
        $writerMock->shouldReceive('createFromString')
            ->andReturnSelf();
        $writerMock->shouldReceive('insertOne')
            ->andReturnSelf();
        $writerMock->shouldReceive('insertAll')
            ->andReturnSelf();
        $writerMock->shouldReceive('getContent')
            ->andReturn($expected);

        $exportCSVService = new ExportCSVService();
        $return = $exportCSVService->exportCsv($headers, $rows);
        $this->assertEquals($expected, $return);
    }

}