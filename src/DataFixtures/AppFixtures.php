<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
	/**
	 * @param ObjectManager $manager
	 */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
//	    $items = array(
//		    array(
//			    'Audi',
//			    array(
//				    'Cabriolet', 'Q2', 'Q3', 'Q5', 'Q7', 'Q8', 'R8', 'Rs3', 'Rs4', 'Rs5', 'Rs7', 'S3', 'S4', 'S4 Avant',
//				    'S4 Cabriolet', 'S5', 'S7', 'S8', 'SQ5', 'SQ7', 'Tt', 'Tts', 'V8'
//			    )
//		    ),
//		    array(
//			    'BMW',
//			    array(
//				    'M3', 'M4', 'M5', 'M535', 'M6', 'M635', 'Serie 1', 'Serie 2', 'Serie 3', 'Serie 4', 'Serie 5',
//				    'Serie 6', 'Serie 7', 'Serie 8'
//			    )
//		    ),
//		    array(
//			    'Citroen',
//			    'C1', 'C15', 'C2', 'C25', 'C25D', 'C25E', 'C25TD', 'C3', 'C3 Aircross', 'C3 Picasso', 'C4',
//			    'C4 Picasso', 'C5', 'C6', 'C8', 'Ds3', 'Ds4', 'Ds5'
//		    )
//	    );
        $items =
            [
                0 => [
                    0 =>'Audi',
                    1 => [
                        'Cabriolet', 'Q2', 'Q3', 'Q5', 'Q7', 'Q8', 'R8', 'Rs3', 'Rs4', 'Rs5', 'Rs7', 'S3', 'S4', 'S4 Avant',
                        'S4 Cabriolet', 'S5', 'S7', 'S8', 'SQ5', 'SQ7', 'Tt', 'Tts', 'V8'
                    ]
                ],
                1 => [
                    0 => 'BMW',
                    1 => [
                        'M3', 'M4', 'M5', 'M535', 'M6', 'M635', 'Serie 1', 'Serie 2', 'Serie 3', 'Serie 4', 'Serie 5',
                        'Serie 6', 'Serie 7', 'Serie 8'
                    ]
                ],
                2 => [
                    0 => 'Citroen',
                    1 => [
                        'C1', 'C15', 'C2', 'C25', 'C25D', 'C25E', 'C25TD', 'C3', 'C3 Aircross', 'C3 Picasso', 'C4',
                        'C4 Picasso', 'C5', 'C6', 'C8', 'Ds3', 'Ds4', 'Ds5'
                    ]
                ]
            ];

        $categories = array('Emploi', 'Immobilier', 'Automobile');


        //    	Persistence des catégories sauf Automobile
        for ($c = 0; $c < 2; $c++) {
            $category = new Categorie();
            $category->setNom($categories[$c]);
            $manager->persist($category);
        }

        //	    Persistence de la catégorie Automobile
        $categorie_auto = new Categorie();
        $categorie_auto->setNom($categories[2]);
        $manager->persist($categorie_auto);

        //	    Création et persistence d'une annonce par modèle ($mo) de chaque marque ($m)
        //	    Attribution de la catégorie automobile à chaque annonce créée
        for ($m = 0; $m < 3; $m++) {
            for ($mo = 0; $mo < count($items[$m][1]); $mo++) {
                $item = new Annonce();
                $item->setContenu($faker->text());
                $item->setTitre($faker->text(20));
                $item->setCategorie($categorie_auto);
                $item->setMarque($items[$m][0]);
                $item->setModele($items[$m][1][$mo]);

                $manager->persist($item);
            }
        }
        $manager->flush();
    }
}
