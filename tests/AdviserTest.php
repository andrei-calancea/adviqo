<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Adviser;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class AdviserTest extends ApiTestCase
{
    /*The trait will refresh the database content to initial one before each test*/
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/advisers');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/contexts/Adviser',
            '@id' => '/advisers',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 2
        ]);

        // Because test fixtures are automatically loaded between each test, you can assert on them
        $this->assertCount(2
            , $response->toArray()['hydra:member']);
    }

    public function testCreateAdviser(): void
    {
        $response = static::createClient()->request('POST', '/advisers', ['json' => [
            'name' => 'John Doe',
            'description' => 'ccevf',
            'availability' => true,
            'pricePerMinute' => 43.82,
            'language' => 'en',
            'profileImage' => 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'name' => 'John Doe',
            'description' => 'ccevf',
            'availability' => true,
            'pricePerMinute' => 43.82,
            'language' => 'en',
            'profileImage' => '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',
        ]);
    }

    public function testUpdateAdviser(): void
    {
        $client = static::createClient();
        // findIriBy allows to retrieve the IRI of an item by searching for some of its properties.
        // ISBN 9786644879585 has been generated by Alice when loading test fixtures.
        // Because Alice use a seeded pseudo-random number generator, we're sure that this ISBN will always be generated.
        $iri = $this->findIriBy(Adviser::class, ['id' => '1']);

        $client->request('PUT', $iri, ['json' => [
            'name' => 'Mark Twain',
            'pricePerMinute' => 34.21,
            'language' => 'fr',
            'profileImage' => 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'id' => 1,
            'name' => 'Mark Twain',
            'pricePerMinute' => 34.21,
            'language' => 'fr',
            'profileImage' => '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',
        ]);
    }

    public function testDeleteBook(): void
    {
        $client = static::createClient();
        $iri = $this->findIriBy(Adviser::class, ['id' => '1']);

        $client->request('DELETE', $iri);

        $this->assertResponseStatusCodeSame(204);
        $this->assertNull(
            static::$container->get('doctrine')->getRepository(Adviser::class)->findOneBy(['id' => '1'])
        );
    }
}
