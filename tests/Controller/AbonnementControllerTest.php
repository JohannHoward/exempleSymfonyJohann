<?php

namespace App\Test\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbonnementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/abonnement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Abonnement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Abonnement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'abonnement[Date_debut]' => 'Testing',
            'abonnement[Date_Fin]' => 'Testing',
            'abonnement[Categorie]' => 'Testing',
            'abonnement[Chaine]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Abonnement();
        $fixture->setDate_debut('My Title');
        $fixture->setDate_Fin('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setChaine('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Abonnement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Abonnement();
        $fixture->setDate_debut('Value');
        $fixture->setDate_Fin('Value');
        $fixture->setCategorie('Value');
        $fixture->setChaine('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'abonnement[Date_debut]' => 'Something New',
            'abonnement[Date_Fin]' => 'Something New',
            'abonnement[Categorie]' => 'Something New',
            'abonnement[Chaine]' => 'Something New',
        ]);

        self::assertResponseRedirects('/abonnement/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_debut());
        self::assertSame('Something New', $fixture[0]->getDate_Fin());
        self::assertSame('Something New', $fixture[0]->getCategorie());
        self::assertSame('Something New', $fixture[0]->getChaine());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Abonnement();
        $fixture->setDate_debut('Value');
        $fixture->setDate_Fin('Value');
        $fixture->setCategorie('Value');
        $fixture->setChaine('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/abonnement/');
        self::assertSame(0, $this->repository->count([]));
    }
}
