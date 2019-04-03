<?php

class DataApiTest extends TestCase
{
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
        $this->get('/data/labels');
        $this->assertResponseOk();
    }
}
