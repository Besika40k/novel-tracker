<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * The home page sends visitors to the list.
     */
    public function test_the_home_page_redirects_to_the_novel_list(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/novels');
    }
}
