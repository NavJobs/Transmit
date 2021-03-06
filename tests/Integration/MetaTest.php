<?php

namespace NavJobs\Transmit\Test\Integration;

use NavJobs\Transmit\Serializers\ArraySerializer;

class MetaTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_add_meta()
    {
        $array = $this->fractal
            ->collection($this->testBooks, new TestTransformer())
            ->serializeWith(new ArraySerializer())
            ->addMeta(['key' => 'value'])
            ->toArray();

        $expectedArray = [
            ['id' => 1, 'author' => 'Philip K Dick'],
            ['id' => 2, 'author' => 'George R. R. Satan'],
        'meta' => ['key' => 'value'], ];

        $this->assertEquals($expectedArray, $array);
    }

    /**
     * @test
     */
    public function it_can_handle_multiple_meta()
    {
        $array = $this->fractal
            ->collection($this->testBooks, new TestTransformer())
            ->serializeWith(new ArraySerializer())
            ->addMeta(['key1' => 'value1'], ['key2' => 'value2'])
            ->addMeta(['key3' => 'value3'])
            ->addMeta(['key4' => 'value4'])
            ->toArray();

        $expectedArray = [
            ['id' => 1, 'author' => 'Philip K Dick'],
            ['id' => 2, 'author' => 'George R. R. Satan'],
            'meta' => [
                'key1' => 'value1',
                'key2' => 'value2',
                'key3' => 'value3',
                'key4' => 'value4',
            ],
        ];


        $this->assertEquals($expectedArray, $array);
    }
}
