<?php

namespace Tests\Unit\Services;

use App\Services\ImportCSVService;
use Exception;
use League\Csv\Reader;
use Mockery;
use Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ImportCSVServiceTest extends TestCase
{
    /**
     * @covers \App\Services\ImportCSVService::extractRows
     */
    public function testExtractRowsWrongHeader()
    {
        $readerMock = Mockery::mock('alias:' . Reader::class);
        $readerMock->shouldReceive('createFromString')
            ->andReturnSelf();
        $readerMock->shouldReceive('setHeaderOffset')
            ->andReturnSelf();
        $readerMock->shouldReceive('getHeader')
            ->andReturn(['title', 'description']);

        $headers = ['owner', 'title', 'description'];
        $this->expectException(Exception::class);
        
        $importCSVService = new ImportCSVService();
        $importCSVService->extractRows($headers, 'title,description', []);
    }


    /**
     * @covers \App\Services\ImportCSVService::extractRows
     * @covers \App\Services\ImportCSVService::isValidRecord
     */
    public function testExtractRowsEmptyRequiredValues()
    {
        $expected = [['title' => 'title', 'description' => 'description']];
        $getRecordsMock = (object)$expected;
        $readerMock = Mockery::mock('alias:' . Reader::class);
        $readerMock->shouldReceive('createFromString')
            ->andReturnSelf();
        $readerMock->shouldReceive('setHeaderOffset')
            ->andReturnSelf();
        $readerMock->shouldReceive('getHeader')
            ->andReturn(['title', 'description']);
        $readerMock->shouldReceive('getRecords')
            ->andReturn($getRecordsMock);


        $headers = ['title', 'description'];
        $importCSVService = new ImportCSVService();
        $return = $importCSVService->extractRows($headers, 'title,description', []);
        $this->assertEquals($expected, $return);
    }

    /**
     * @covers \App\Services\ImportCSVService::extractRows
     * @covers \App\Services\ImportCSVService::isValidRecord
     */
    public function testExtractRowsEmptyRequiredValue()
    {
        $expected = [['title' => 'title', 'description' => '']];
        $getRecordsMock = (object)$expected;
        $readerMock = Mockery::mock('alias:' . Reader::class);
        $readerMock->shouldReceive('createFromString')
            ->andReturnSelf();
        $readerMock->shouldReceive('setHeaderOffset')
            ->andReturnSelf();
        $readerMock->shouldReceive('getHeader')
            ->andReturn(['title', 'description']);
        $readerMock->shouldReceive('getRecords')
            ->andReturn($getRecordsMock);


        $headers = ['title', 'description'];
        $this->expectException(Exception::class);
        $importCSVService = new ImportCSVService();
        $importCSVService->extractRows($headers, 'title,description', ['description']);
    }

    /**
     * @covers \App\Services\ImportCSVService::extractRows
     * @covers \App\Services\ImportCSVService::isValidRecord
     */
    public function testExtractRowsAllRequiredValuesMatch()
    {
        $expected = [['title' => 'title', 'description' => 'description']];
        $getRecordsMock = (object)$expected;
        $readerMock = Mockery::mock('alias:' . Reader::class);
        $readerMock->shouldReceive('createFromString')
            ->andReturnSelf();
        $readerMock->shouldReceive('setHeaderOffset')
            ->andReturnSelf();
        $readerMock->shouldReceive('getHeader')
            ->andReturn(['title', 'description']);
        $readerMock->shouldReceive('getRecords')
            ->andReturn($getRecordsMock);


        $headers = ['title', 'description'];
        $importCSVService = new ImportCSVService();
        $return = $importCSVService->extractRows($headers, 'title,description', ['title', 'description']);
        $this->assertEquals($expected, $return);
    }

}