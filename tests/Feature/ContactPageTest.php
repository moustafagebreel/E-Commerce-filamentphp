<?php

namespace Tests\Feature;

use App\Livewire\ContactPage;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_user_can_submit_contact_form(): void
    {
        Livewire::test(ContactPage::class)
            ->set('name', 'John Smith')
            ->set('email', 'john@example.com')
            ->set('subject', 'Question about shipping')
            ->set('message', 'Hello, how long does shipping take?')
            ->call('submitMessage')
            ->assertHasNoErrors()
            ->assertSee('Thank you!');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'john@example.com',
            'subject' => 'Question about shipping',
        ]);
    }
}
