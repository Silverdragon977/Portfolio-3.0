<?php
/////////////////////////////////////////////////////////////
////    Testing Game Routes    //////////////////////////////
/////////////////////////////////////////////////////////////
use App\Models\User;

describe('Clicker Hero game routes', function () {

    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    /////////////////////////////////////////////////
    //   clickHero/save route tests    //////////////
    /////////////////////////////////////////////////

    it('guest cannot save clicker hero data', function () {

        $response = $this->post('/clickerhero/save', []);

        $response->assertRedirect('/login');
    });
    it('authenticated user can save clicker hero data', function () {
        $data = [
            'score' => 10,
            'multiplier' => 1,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ];

        $this->actingAs($this->user)
            ->post('/clickerhero/save', $data)
            ->assertOk();
        $this->assertDatabaseHas('clicker_games', [
            'user_id' => $this->user->id,
            'score' => 10,
            'multiplier' => 1,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ]);
    });
    //
    // Good to test to make sure bad data is not accepted and does not cause errors
    // Check to make sure that the updateOrCreate is working as intended and that it updates the existing record instead of creating a new one
    it('updateOrCreate is working as intended', function () {
        $data = [
            'score' => 10,
            'multiplier' => 1,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ];
        $this->actingAs($this->user)
            ->post('/clickerhero/save', $data)
            ->assertOk();
        $updatedData = [
            'score' => 20,
            'multiplier' => 2,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ];
        $this->actingAs($this->user)
            ->post('/clickerhero/save', $updatedData)
            ->assertOk();
        $this->assertDatabaseHas('clicker_games', [
            'user_id' => $this->user->id,
            'score' => 20,
            'multiplier' => 2,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ]);
        // Assert that there is only one record for this user
        $this->assertDatabaseCount('clicker_games', 1);
    });


    ////////////////////////////////////////////////
    //    clickHero/load route tests    ////////////
    ////////////////////////////////////////////////    

    it('authenticated user can load clicker hero data correctly', function () {

    $this->actingAs($this->user)
        ->get('/clickerhero/load')
        ->assertOk()
        ->assertJsonStructure([
            'score',
            'multiplier',
            'passive_income_level',
            'prestige_level',
            'background_color',
            'frame_choice',
        ]);
    });
    it('guest cannot load clicker hero data', function () {

        $response = $this->get('/clickerhero/load');

        $response->assertRedirect('/login');
    });
});

