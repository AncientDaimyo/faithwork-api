<?php

namespace App\Tests\Functional\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CheckoutTest extends WebTestCase
{
    public function test_checkout_post_delivery(): void
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);


        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
            true
        );
        $this->assertResponseIsSuccessful();
    }
    public function test_checkout_post_response(): void
    {
        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);


        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
            true
        );
        $r = $client->getResponse();
        $this->assertEquals("OK",$r,$r);
    }
}
