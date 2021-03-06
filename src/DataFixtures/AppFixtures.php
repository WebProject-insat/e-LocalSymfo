<?php

namespace App\DataFixtures;

use App\Entity\Announcement;
use App\Entity\City;
use App\Entity\Gender;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager )
    {
        $cityName = ['Tunis' , 'Manouba' , 'Ariana' , 'Ben Arous' , 'Sfax' ,'Beja' , 'Siliana' , 'Jendouba' , 'Kef' , 'Medenine' ,'Benzart' ,'Gafsa' ,'Tataouine'] ;
        $cities = [] ;
        $bool = [true , false] ;
        // $product = new Product();
        // $manager->persist($product);
        $faker = \Faker\Factory::create() ;
        $gend1 = new Gender() ;
        $gend1->setType('Male') ;
        $manager->persist($gend1) ;
        $gend2 = new Gender() ;
        $gend2->setType('Female') ;
        $manager->persist($gend2) ;
        $gend3 = new Gender() ;
        $gend3->setType('Other') ;
        $manager->persist($gend3) ;
        $genders = [$gend1 , $gend2 , $gend3] ;
        for($b=0 ; $b < count($cityName) ; $b++){
            $city = new City() ;
            $city->setName($cityName[$b])
                 ->setImage('http://placeholdt.it/350x150')
                 ->setAvgPrice(0)
                 ->setNbAnnouncements(0)
                ;
            $cities[] = $city ;
            $manager->persist($city);
        }
        for($i=0 ; $i<60 ; $i++){
            $user = new User();
            $j=mt_rand(0,2) ;
            $name = $faker->name ;
            $user->setGender($genders[$j])
                 ->setUsername($name)
                 ->setPassword($name ."123")
                 ->setEmail($faker->email)
                 ->setPhoneNumber(mt_rand(10000000, 99999999))
                 ->setAge(mt_rand(16 , 100))
                 ->setProfession($faker->sentence(2))
                 ->setAbout($faker->paragraph())
                 ->setCreatedAt($faker->dateTimeBetween('-4 months'));

            $manager->persist($user);
            for($a=0 ; $a<mt_rand(0,2) ; $a++){
                $city=$cities[mt_rand(0,count($cities)-1)] ;
                $announcement = new Announcement() ;
                $now = new \DateTime() ;
                $interval = $now->diff($user->getCreatedAt()) ;
                $days = $interval->days ;
                $minimum = '-' . $days . 'days' ;
                $announcement->setRoomNb(mt_rand(1,4))
                             ->setSurface(mt_rand(400 , 4000) / 10)
                             ->setPrice(mt_rand(1000 , 15000) / 10)
                             ->setFurnished($bool[mt_rand(0,1)])
                             ->setSmoker($bool[mt_rand(0,1)])
                             ->setGarden($bool[mt_rand(0,1)])
                             ->setGarage($bool[mt_rand(0,1)])
                             ->setBalcon($bool[mt_rand(0,1)])
                             ->setAvailabilityDate($faker->dateTimeBetween('+5 days' , '+3 months'))
                             ->setMaxRoomates(mt_rand(1,5))
                             ->setUserOwner($user)
                             ->setPostedAt($faker->dateTimeBetween($minimum))
                             ->setLocatedAt($city)
                             ->setDescription($faker->paragraph());
                $manager->persist($announcement) ;

            }

        }
        $manager->flush();


    }
}
