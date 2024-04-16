<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartTest extends WebTestCase
{
    public function test_checkout_post_delivery(): void
    {
        $arr = array(
            'id'          => '1',
            'amount'      =>  1,
            'size'        => 'L'

        );
        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/cart/add',
            [],
            [],
            [],
            $parameters,
        );
        $r = $client->getResponse();
        $r = $r->getContent();
        $r = json_decode($r, true);
        echo($r['content']);
        $this->assertResponseIsSuccessful($r['content']);
    }
}
