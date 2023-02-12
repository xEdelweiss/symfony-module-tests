<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Event\HomeVisitedEvent;
use App\Event\NotUsedEvent;
use App\Tests\FunctionalTester;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener;
use Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector;
use Symfony\Component\Console\EventListener\ErrorListener;

final class EventsCest
{
    public function dontSeeEvent(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEvent('kernel.exception');
        $I->dontSeeEvent(new NotUsedEvent());
        $I->dontSeeEvent([NotUsedEvent::class, NotUsedEvent::class]);
    }

    public function dontSeeEventListenerCalled(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEventListenerCalled(ErrorListener::class);
        $I->dontSeeEventListenerCalled(new ErrorListener());
        $I->dontSeeEventListenerCalled([ErrorListener::class, ErrorListener::class]);
    }

    public function dontSeeEventTriggered(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEventTriggered(ErrorListener::class);
        $I->dontSeeEventTriggered(new ErrorListener());
        $I->dontSeeEventTriggered([ErrorListener::class, ErrorListener::class]);
    }

    public function dontSeeOrphanEvent(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->submitForm('form[name=login]', [
            'email' => 'john_doe@gmail.com',
            'password' => '123456',
            '_remember_me' => false
        ]);
        $I->dontSeeOrphanEvent();
    }

    public function seeEvent(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeEvent('kernel.request');
        $I->seeEvent(new HomeVisitedEvent());
        $I->seeEvent([HomeVisitedEvent::class, HomeVisitedEvent::class]);
    }

    public function seeEventListenerCalled(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeEventListenerCalled(SecurityListener::class);
        $I->seeEventListenerCalled(new RouterDataCollector());
        $I->seeEventListenerCalled([SecurityListener::class, RouterDataCollector::class]);
    }

    public function seeEventTriggered(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeEventTriggered(SecurityListener::class);
        $I->seeEventTriggered(new RouterDataCollector());
        $I->seeEventTriggered([SecurityListener::class, RouterDataCollector::class]);
    }

    public function seeOrphanEvent(FunctionalTester $I)
    {
        $I->markTestIncomplete('To do: use a new event for this assertion');
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeOrphanEvent('security.authentication.success');
    }
}
