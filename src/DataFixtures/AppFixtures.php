<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Team;
use App\Entity\Region;
use App\Entity\Competition;
use App\Entity\Matchs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // PWD = test
        $pwd = '$2y$13$wiWVplNfdpwyWjWFdTtY..TQvVVHDVkv/PEUtf7dSlvmC2KiqlJHq';

        $object = (new User())
            ->setEmail('user@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_USER"])
        ;
        $manager->persist($object);

        $object = (new User())
            ->setEmail('admin@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_ADMIN"])
        ;
        $manager->persist($object);

        $object = (new User())
            ->setEmail('moderator@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_MODERATOR"])
        ;
        $manager->persist($object);

        $object = (new Competition())
            ->setName('LEC')
        ;
        $manager->persist($object);

        $object = (new Region())
            ->setName('European west')
            ->setAcronym('EUW')
        ;
        $manager->persist($object);
        $manager->flush();

        $regions = $manager->getRepository(Region::class)->findAll();

        for ($i = 0; $i < 5; $i++) {
            $object = (new Team())
                ->setName($faker->name)
                ->setLogo('https://www.google.com/url?sa=i&url=https%3A%2F%2Ffr.wikipedia.org%2Fwiki%2FFnatic&psig=AOvVaw1Eq61oSnQ_nSWXr1wiecPR&ust=1675865248207000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCPCYtNjKg_0CFQAAAAAdAAAAABAD')
                ->setRegion($faker->randomElement($regions))
            ;
            $manager->persist($object);
        }

        $manager->flush();

        $teams = $manager->getRepository(Team::class)->findAll();
        $competitions = $manager->getRepository(Competition::class)->findAll();

        for ($i = 0; $i < 5; $i++) {
            $object = (new Matchs())
                ->setTeamOne($teams[0])
                ->setTeamTwo($teams[1])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(0)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
            ;
            $manager->persist($object);
        }

        $manager->flush();
    }
}
