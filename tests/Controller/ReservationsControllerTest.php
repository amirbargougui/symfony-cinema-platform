<?php

namespace App\Test\Controller;

use App\Entity\Reservations;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/reservationss/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Reservations::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation[filmid]' => 'Testing',
            'reservation[datereservation]' => 'Testing',
            'reservation[heurereservation]' => 'Testing',
            'reservation[nombreplacesreservees]' => 'Testing',
            'reservation[nombreplacesdisponibles]' => 'Testing',
            'reservation[idutilisateur]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setFilmid('My Title');
        $fixture->setDatereservation('My Title');
        $fixture->setHeurereservation('My Title');
        $fixture->setNombreplacesreservees('My Title');
        $fixture->setNombreplacesdisponibles('My Title');
        $fixture->setIdutilisateur('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setFilmid('Value');
        $fixture->setDatereservation('Value');
        $fixture->setHeurereservation('Value');
        $fixture->setNombreplacesreservees('Value');
        $fixture->setNombreplacesdisponibles('Value');
        $fixture->setIdutilisateur('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation[filmid]' => 'Something New',
            'reservation[datereservation]' => 'Something New',
            'reservation[heurereservation]' => 'Something New',
            'reservation[nombreplacesreservees]' => 'Something New',
            'reservation[nombreplacesdisponibles]' => 'Something New',
            'reservation[idutilisateur]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservationss/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFilmid());
        self::assertSame('Something New', $fixture[0]->getDatereservation());
        self::assertSame('Something New', $fixture[0]->getHeurereservation());
        self::assertSame('Something New', $fixture[0]->getNombreplacesreservees());
        self::assertSame('Something New', $fixture[0]->getNombreplacesdisponibles());
        self::assertSame('Something New', $fixture[0]->getIdutilisateur());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservations();
        $fixture->setFilmid('Value');
        $fixture->setDatereservation('Value');
        $fixture->setHeurereservation('Value');
        $fixture->setNombreplacesreservees('Value');
        $fixture->setNombreplacesdisponibles('Value');
        $fixture->setIdutilisateur('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reservationss/');
        self::assertSame(0, $this->repository->count([]));
    }
}
