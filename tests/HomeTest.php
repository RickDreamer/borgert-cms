<?php

class HomeTest extends TestCase
{
    /**
     * A basic functional test home enter.
     *
     * @return void
     */
    public function testHomeEnter()
    {
        $this->visit('/')
             ->see('Borgert CMS')
             ->seeStatusCode(200);
    }
}
