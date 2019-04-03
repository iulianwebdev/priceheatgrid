<?php

use Illuminate\Http\Response;

class DataApiTest extends TestCase
{
    protected $postUri;
    protected $getUri;

    protected function setUp() : void
    {
        parent::setUp();
        $this->postUri = '/data';
        $this->getUri = '/data/labels';
    }

    /**
     * Test end-point method is accessible
     *
     * @return void
     */
    public function testEndPointExistsPOST()
    {
        $this->post('/data');
        $this->assertResponseOk();
    }

    /**
     * Test end-point for get is accessable
     *
     * @return void
     */
    public function testEndPointExistGET()
    {
        $this->get($this->getUri);
        $this->assertResponseOk();
    }

    public function testLabelsAreReturnedCorrectly()
    {
        $this->get($this->getUri);

        $expected = json_encode([
            '0% - 5%',
            '5% - 25%',
            '25% - 75%',
            '75% - 95%',
            '95% - 100%',
        ]);
        $this->assertEquals($expected, $this->response->getContent());
    }
    
    public function testShowDataValidatorBailsOnWrongDataType()
    {
        $data = [
            [1, 2, 3123],
            ['a', 1, 2]
        ];
        $this->post($this->postUri, compact('data'));

        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
