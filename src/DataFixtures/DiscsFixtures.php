<?php

namespace App\DataFixtures;
use App\Entity\Artist;
use App\Entity\Disc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DiscsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        include 'record.php';
        $artistRepo = $manager->getRepository(Artist::class);
        foreach($artist as $art){
            $artistDB = new Artist();
            $artistDB->setId($art['artist_id']);
            $artistDB->setName($art['artist_name']);
            $artistDB->setUrl($art['artist_url']);
            $manager-> persist($artistDB);

            $manager->persist($artistDB);

            // Pour empecher l'auto-incrementation
            $metadata=$manager->getClassMetaData(Artist::class);
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        }
        $manager->flush();
        
        foreach($disc AS $d){
            $discDB =new Disc();
            $discDB-> setTitle($d['disc_title']);
            $discDB-> setLabel($d['disc_label']);
            $discDB-> setPicture($d['disc_picture']);
            $artist = $artistRepo->find($d['artist_id']);
            $discDB->setArtist($artist);
            $manager->persist($discDB);
        }
        $manager->flush();
    }
}
