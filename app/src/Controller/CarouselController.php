<?php

namespace App\Controller;

use App\Repository\GalaxyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class CarouselController extends AbstractController
{
    #[Route('/carousel', name: 'app_carousel')]
        public function index(GalaxyRepository $galaxyRepository, CacheInterface $cache): Response
        {
            $carousel = $cache->get('carousel_page', function (ItemInterface $item) use ($galaxyRepository) {
                $item->expiresAfter(3600);
                $data = $galaxyRepository->findCarouselData();
                $carousel = [];
                foreach ($data as $row) {
                    $key = $row['title'];
                    if (!isset($carousel[$key])) {
                        $carousel[$key] = [
                            'title' => $row['title'],
                            'description' => $row['description'],
                            'files' => []
                        ];
                    }
                    if ($row['filename_disk']) {
                        $carousel[$key]['files'][] = $row['filename_disk'];
                    }
                }
            return array_values($carousel);
        });

        return $this->render('carousel/index.html.twig', [
            'carousel' => $carousel
        ]);
    }
}
