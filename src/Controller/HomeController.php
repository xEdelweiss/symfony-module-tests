<?php

declare(strict_types=1);

namespace App\Controller;

use App\Event\HomeVisitedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class HomeController extends AbstractController
{
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(): Response
    {
        $this->dispatcher->dispatch(new HomeVisitedEvent());
        return $this->render('blog/home.html.twig');
    }
}
