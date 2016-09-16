<?php

class AuthTest extends TestCase
{
    /**
     * Test home login.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/auth/login')
            ->see('Welcome to Borgert CMS')
            ->seeStatusCode(200);
    }

    /**
     * Test authentication
     * @return void
     */
    public function testAuth()
    {
        $this->visit('/auth/login')
            ->type('john@example.com', 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->see('Dashboard');
    }

    /**
     * Test logout system
     * @return void
     */
    public function testLogout()
    {
        $this->visit('/auth/logout')
            ->see('Welcome to Borgert CMS')
            ->seeStatusCode(200);
    }

}
