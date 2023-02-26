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
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // PWD = test
        $pwd = '$2y$13$wiWVplNfdpwyWjWFdTtY..TQvVVHDVkv/PEUtf7dSlvmC2KiqlJHq';

//USER FIXTURES

        $object = (new User())
            ->setEmail('user@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_USER"])
            ->setBalance(0)
        ;
        $manager->persist($object);

        $object = (new User())
            ->setEmail('admin@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_ADMIN"])
            ->setBalance(0)
        ;
        $manager->persist($object);

        $object = (new User())
            ->setEmail('super-admin@user.fr')
            ->setPassword($pwd)
            ->setRoles(["ROLE_SUPER_ADMIN"])
            ->setBalance(0)
        ;
        $manager->persist($object);

// COMPETITION FIXTURES

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

// TEAMS FIXTURES        

        $object = (new Team())
            ->setName('100 Thieves')
            ->setLogo('100-thieves')
            ->setRegion($faker->randomElement($regions))
        ;
        $manager->persist($object);

        $object = (new Team())
            ->setName('DRX')
            ->setLogo('drx')
            ->setRegion($faker->randomElement($regions))
        ;
        $manager->persist($object);
        $object = (new Team())
            ->setName('JD-Gaming')
            ->setLogo('jd-gaming')
            ->setRegion($faker->randomElement($regions))
        ;
        $manager->persist($object);

        $object = (new Team())
            ->setName('Fnatic')
            ->setLogo('fnatic')
            ->setRegion($faker->randomElement($regions))
        ;
        $manager->persist($object);

        $object = (new Team())
            ->setName('T1')
            ->setLogo('t1')
            ->setRegion($faker->randomElement($regions))
        ;
        $manager->persist($object);
    
        $manager->flush();

        
        $teams = $manager->getRepository(Team::class)->findAll();
        $competitions = $manager->getRepository(Competition::class)->findAll();

        //PASSED MATCH
            $object = (new Matchs())
                ->setTeamOne($teams[0])
                ->setTeamTwo($teams[1])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(1)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
                ->setDate(new \DateTime('@'.strtotime('now')))
            ;
            $manager->persist($object);

        $object = (new Matchs())
                ->setTeamOne($teams[2])
                ->setTeamTwo($teams[1])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(1)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
                ->setDate(new \DateTime('@'.strtotime('now')))
            ;
            $manager->persist($object);

            $object = (new Matchs())
                ->setTeamOne($teams[0])
                ->setTeamTwo($teams[3])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(1)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
                ->setDate(new \DateTime('@'.strtotime('now')))
            ;
            $manager->persist($object);

            $object = (new Matchs())
                ->setTeamOne($teams[4])
                ->setTeamTwo($teams[2])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(1)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
                ->setDate(new \DateTime('@'.strtotime('now')))
            ;
            $manager->persist($object);

            $object = (new Matchs())
                ->setTeamOne($teams[2])
                ->setTeamTwo($teams[1])
                ->setTeamOneRating(Rand(1,5))
                ->setTeamTwoRating(Rand(1,5))
                ->setTeamOneScore(0)
                ->setTeamTwoScore(1)
                ->setTeamWinner(null)
                ->setBestOf(1)
                ->setCompetition($competitions[0])
                ->setDate(new \DateTime('@'.strtotime('now')))
            ;
            $manager->persist($object);

        // INCOMMING MATCH

        $object = (new Matchs())
            ->setTeamOne($teams[2])
            ->setTeamTwo($teams[1])
            ->setTeamOneRating(Rand(1,5))
            ->setTeamTwoRating(Rand(1,5))
            ->setTeamOneScore(1)
            ->setTeamTwoScore(2)
            ->setTeamWinner(null)
            ->setBestOf(1)
            ->setCompetition($competitions[0])
            ->setDate(new \DateTime('@'.strtotime('2024-02-21 02:19:39.000')))
        ;
        $manager->persist($object);

        $object = (new Matchs())
            ->setTeamOne($teams[2])
            ->setTeamTwo($teams[3])
            ->setTeamOneRating(Rand(1,5))
            ->setTeamTwoRating(Rand(1,5))
            ->setTeamOneScore(1)
            ->setTeamTwoScore(2)
            ->setTeamWinner(null)
            ->setBestOf(1)
            ->setCompetition($competitions[0])
            ->setDate(new \DateTime('@'.strtotime('2024-02-21 02:19:39.000')))
        ;
        $manager->persist($object);

        $object = (new Matchs())
            ->setTeamOne($teams[4])
            ->setTeamTwo($teams[3])
            ->setTeamOneRating(Rand(1,5))
            ->setTeamTwoRating(Rand(1,5))
            ->setTeamOneScore(1)
            ->setTeamTwoScore(2)
            ->setTeamWinner(null)
            ->setBestOf(1)
            ->setCompetition($competitions[0])
            ->setDate(new \DateTime('@'.strtotime('2024-02-21 02:19:39.000')))
        ;
        $manager->persist($object);

        $object = (new Matchs())
            ->setTeamOne($teams[4])
            ->setTeamTwo($teams[2])
            ->setTeamOneRating(Rand(1,5))
            ->setTeamTwoRating(Rand(1,5))
            ->setTeamOneScore(1)
            ->setTeamTwoScore(2)
            ->setTeamWinner(null)
            ->setBestOf(1)
            ->setCompetition($competitions[0])
            ->setDate(new \DateTime('@'.strtotime('2024-02-21 02:19:39.000')))
        ;
        $manager->persist($object);

        $object = (new Matchs())
            ->setTeamOne($teams[0])
            ->setTeamTwo($teams[1])
            ->setTeamOneRating(Rand(1,5))
            ->setTeamTwoRating(Rand(1,5))
            ->setTeamOneScore(1)
            ->setTeamTwoScore(2)
            ->setTeamWinner(null)
            ->setBestOf(1)
            ->setCompetition($competitions[0])
            ->setDate(new \DateTime('@'.strtotime('2024-02-21 02:19:39.000')))
        ;
        $manager->persist($object);
        $manager->flush();
    }
}
