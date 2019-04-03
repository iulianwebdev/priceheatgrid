<?php

use Illuminate\Http\Response;

class DataApiTest extends TestCase
{
    protected $postUri;
    protected $getUri;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postUri = '/data';
        $this->getUri = '/data/labels';
    }

    /**
     * Test end-point for get is accessable.
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

    /**
     * check that validation works for non-int values.
     */
    public function testShowDataValidatorBailsOnWrongDataType()
    {
        $data = [
            [1, 2, 3123],
            ['a', 1, 2],
        ];
        $this->post($this->postUri, compact('data'));
        // dd($this->response);
        $this->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testShowDataValidationPasses()
    {
        $data = [
            [1, 2, 3123],
            [1, 1, 2],
        ];
        $this->post($this->postUri, compact('data'));
        // dd($this->response);
        $this->assertResponseOk();
    }
}
