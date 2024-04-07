<?php

namespace App\Tests\Functional\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CheckoutTest extends WebTestCase
{
    public function test_checkout_post_delivery(): void
    {
        $arr = array(
            'name'          => 'Jojn',
            'surname'       => 'Johnson',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidor@gay.com',
            'telephone'     => '9823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         =>  '4',
            'apartment'     => '1'
        );
        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
        );
        $this->assertResponseIsSuccessful();
    }

    public function test_checkout_post_response(): void
    {
        $arr = array(
            'name'          => 'Jojn',
            'surname'       => 'Johnson',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidor@gay.com',
            'telephone'     => '9823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         =>  '4',
            'apartment'     => '1'
        );
        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
        );
        $r = $client->getResponse();
        $r = $r->getContent();
        $r = json_decode($r, true);
        echo($r['status']);
        $this->assertEquals("OK", $r['status']);
    }

    public function test_checkout_post_response_out_of_data(): void
    {
        $arr = array(
            'name'          => 'Jojn',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidor@gay.com',
            'telephone'     => '9823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         => '4',
            'apartment'     => '1'
        );
        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
        );
        $r = $client->getResponse();
        $r = $r->getContent();
        $r = json_decode($r, true);
        echo($r['status']);
        $this->assertEquals("data integrity has been violated", $r['status']);
    }

    public function test_checkout_post_response_validation_failed(): void
    {
        $arr = array(
            'name'          => '',
            'surname'       => 'Johnson',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidor@gay.com',
            'telephone'     => '9823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         =>  '4',
            'apartment'     => '1'
        );
        $parameters = json_encode($arr);
        $client = static::createClient();
        $client->request(
            'POST',
            '/checkout',
            [],
            [],
            [],
            $parameters,
        );
        $r = $client->getResponse();
        $r = $r->getContent();
        $r = json_decode($r, true);
        echo($r['status']);
        $this->assertEquals("validation failed", $r['status']);
    }
}
