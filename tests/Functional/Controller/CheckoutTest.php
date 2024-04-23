<?php

namespace App\Tests\Functional\Controller;

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
            'telephone'     => '89823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         => '4',
            'apartment'     => '1',
            'products'      => array(
                                array('id' => '1', 'amount' => '1'),
                                array('id' => '2', 'amount' => '1'),
                                array('id' => '3', 'amount' => '1'))

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
        $this->assertResponseIsSuccessful($r['status']);
    }

    public function test_checkout_post_response(): void
    {
        $arr = array(
            'name'          => 'Jojn',
            'surname'       => 'Johnson',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidor@gay.com',
            'telephone'     => '89823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         =>  '4',
            'apartment'     => '1',
            'products'      => array(
                array('id' => '1', 'amount' => '1'),
                array('id' => '2', 'amount' => '1'),
                array('id' => '3', 'amount' => '1'))
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
            'apartment'     => '1',
            'products'      => array(
                array('id' => '1', 'amount' => '1'),
                array('id' => '2', 'amount' => '1'),
                array('id' => '3', 'amount' => '1'))
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
        $this->assertEquals("data integrity has been violated", $r['status'],$r['status']);
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
            'apartment'     => '1',
            'products'      => array(
                array('id' => '41', 'amount' => '1', 'size' => 'S'),
                array('id' => '41', 'amount' => '1', 'size' => 'S'),
                array('id' => '41', 'amount' => '1', 'size' => 'S'))
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

    public function test_checkout_post_response_wrong_email(): void
    {
        $arr = array(
            'name'          => 'John',
            'surname'       => 'Johnson',
            'patronomic'    => 'Johnovich',
            'email'         => 'pidorgays',
            'telephone'     => '9823807046',
            'city'          => 'St.Petersburg',
            'street'        => 'fucking str.',
            'house'         =>  '4',
            'apartment'     => '1',
            'products'      => array(
                array('id' => '1', 'amount' => '1'),
                array('id' => '2', 'amount' => '1'),
                array('id' => '3', 'amount' => '1'))
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
        $this->assertEquals("validation failed", $r['status'],$r['status']);
    }
}
