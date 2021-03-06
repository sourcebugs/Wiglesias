<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\AbstractBaseTest;

/**
 * Class BackendControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Controller
 * @author   Wils Iglesias <wiglesias83@gmail.com>
 */
class BackendControllerTest extends AbstractBaseTest
{
    /**
     * Test admin login request is successful
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', '/admin/login');

        $this->assertStatusCode(200, $client);
    }

    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideSuccessfulUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/contact/message/list'),
            array('/admin/contact/message/1/show'),
            array('/admin/contact/message/1/answer'),
            array('/admin/web/tag/list'),
            array('/admin/web/tag/create'),
            array('/admin/web/tag/1/show'),
            array('/admin/web/tag/1/edit'),
            array('/admin/web/tag/1/delete'),
            array('/admin/web/post/list'),
            array('/admin/web/post/create'),
            array('/admin/web/post/1/edit'),
            array('/admin/web/post/1/delete'),
            array('/admin/users/list'),
            array('/admin/users/create'),
            array('/admin/users/1/edit'),
            array('/admin/users/1/delete'),
        );
    }

    /**
     * Test HTTP request is not found
     *
     * @dataProvider provideNotFoundUrls
     * @param string $url
     */
    public function testAdminPagesAreNotFound($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Not found Urls provider
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/contact/message/create'),
            array('/admin/contact/message/1/edit'),
            array('/admin/contact/message/1/delete'),
            array('/admin/contact/message/batch'),
            array('/admin/users/show'),
            array('/admin/users/batch'),
        );
    }
}
