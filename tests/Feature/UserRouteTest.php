<?php 

//////////////////////////////////////////////////////////
// Testing Routes as an authenticated user    ////////////
//////////////////////////////////////////////////////////

use App\Models\User;

describe('Routes that require authentication', function () {

    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('authenticated user can access clicker hero page', function () {
        $this->actingAs($this->user)
            ->get('/clickhero')
            ->assertOk();
    });
    it('authenticated user can access contact page', function () {
        $this->actingAs($this->user)
            ->get('/contact')
            ->assertOk();
    });
    it('authenticated user can access dashboard page', function () {
        $this->actingAs($this->user)
            ->get('/dashboard')
            ->assertOk();       
    });

});