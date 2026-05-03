<?php


/////////////////////////////////////////////////////////
// Testing Routes as a guest user    ////////////////////
/////////////////////////////////////////////////////////

describe('guest accessable routes', function () {
    it('Homepage reacheable', function () {
        $response = $this->get('/');

        $response->assertOk();
    });
    it('Projects page reacheable', function () {
        $response = $this->get('/projects');

        $response->assertOk();
    });
    it('Resume page reacheable', function () {
        $response = $this->get('/resume'); 

        $response->assertOk();
    });
    it('IP Info page reacheable', function () {
        $response = $this->get('/whatIsMyIP'); 

        $response->assertOk();
    });
    it('Contact page reachable', function() {
        $response = $this->get('/contact');
        $response->assertOk();
    });
});

describe('guest routes that should redirect to login', function () {
    it('Admin page redirects to login', function () {
        $response = $this->get('/admin'); 

        $response->assertRedirect('/login');
    });
    it('ClickerHero page redirects to login', function () {
        $response = $this->get('/clickhero'); 

        $response->assertRedirect('/login');
    });
});


