<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGettingAllCategories()
    {
        // Sin auntenticar deberia dar un error 401.
        $this->call('GET', '/api/v1/categories');
        $this->assertResponseStatus(401);
    }
}
