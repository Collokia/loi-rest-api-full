<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response as HttpResponse;

class CategoriesControllerTest extends TestCase
{

    const URI = "/api/v1/categories";

    /**
     * Tratar de obtener todas las categorías sin pasar los parámetros de cabeceras.
     *
     * @return void
     */
    public function testGetAllCategoriesWithoutHeaders()
    {
        // Sin parámetros de cabeceras deberia dar un error 401.
        $this->get(self::URI);
        $this->assertResponseStatus(401);
    }

    /**
     * Tratar de obtener todas las categorías pasando el token y no así el parámetro Content-Type 'application/json'.
     *
     * @return void
     */
    public function testGetAllCategoriesWithoutJsonParam()
    {
        // Sin parámetros de cabeceras deberia dar un error 401.
        $this->get(self::URI, $this->headers(false, \App\Models\User::first()));
        $this->assertResponseStatus(401);
    }


    /**
     * Tratar de obtener todas las categorías pasando el parámetro Content-Type 'application/json' y no asi el token.
     *
     * @return void
     */
    public function testGetAllCategoriesWithoutAuthorizationParam()
    {
        // Sin usuario para generar el token debería dar un error 401.
        $this->get(self::URI, $this->headers(true, null));
        $this->assertResponseStatus(401);
    }


    /**
     * Obtener todas las categorías con éxito, pasando los parámetros de Content-Type y de Authorization (Token).
     *
     * @return void
     */
    public function testGetAllCategoriesSuccessfull(){

        // Test authenticated access.
        $this->get( self::URI , $this->headers(true, \App\Models\User::first()))
            ->seeJson()
            ->assertResponseOk();
    }
}
