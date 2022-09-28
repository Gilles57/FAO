<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Rubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création des rubriques
        $rubriques = [];

        $rubrique0 = new Rubrique();
        $rubrique0->setNom('Animations');
        $rubrique0->setColor('#9682f4');
        $manager->persist($rubrique0);
        $rubriques[0] = $rubrique0;

        $rubrique1 = new Rubrique();
        $rubrique1->setNom('Musique et concerts');
        $rubrique0->setColor('#d98134');
        $manager->persist($rubrique1);
        $rubriques[1] = $rubrique1;

        $rubrique2 = new Rubrique();
        $rubrique2->setNom('Relaxation');
        $rubrique0->setColor('#bbf482');
        $manager->persist($rubrique2);
        $rubriques[2] = $rubrique2;

        $stock = [
            ['Merci Étienne pour ce moment de partage, d\'échange sur le voyage et la musique et ça tombe bien car le son pur de ton instrument nous emmène ailleurs, là où tout est possible, dans un monde meilleur !', 'Virginie', 47, $rubriques[2]],
            ['C’était vraiment cool comme expérience. Quand on lâche vraiment prise et que l’on ferme les yeux, ça t’emporte vraiment loin. Mon corps se détendais, mes pieds lâchaient des pulsations tout seul c’était assez bizarre comme sensation. Je ressentais les vibrations dans ma colonne vertébrale et c’est vraiment agréable c’est comme une sorte de massage mais interne. Franchement c’est un instrument hyper intriguant mais hyper relaxant c’est vraiment sympa à découvrir et assez original. Bonne continuation !', 'Anaïs', 18, $rubriques[2]],
            ['Merci Étienne pour cette épatante et apaisante expérience sensorielle, un moment de pure relaxation, un bonheur pour les oreilles et pour le corps. Merci et bonne route !', 'Marco', 36, $rubriques[2]],
            ['Expérience extrêmement agréable. On entre très rapidement dans la détente et la relaxation s’installe. Le corps baigné dans la musique douce du handpan se sent bercé par dans harmonies apaisantes. Je vous invite à expérimenter ce moment hors du temps, très régénérant.', 'Pascal', 59, $rubriques[2]],
            ['Pour planter le décor : j\'ai du mal à m\'endormir car je suis trop stressée, j\'ai donc essayé pas mal de techniques relaxantes (de la méditation à la sophrologie en passant par le yoga)... Sauf que leurs effets sont moindres comparé à la relaxation vibratoire, c\'est-à-dire que tu continues de ressentir les vibrations dans ton corps même quand la séance est terminée, comme une impression de légèreté. Je pense que si c\'est aussi efficace c\'est dû au fait qu\'il mobilise plusieurs sens : l\'ouïe (le son du handpan) et le toucher (contact du handpan sur le ventre + vibration). Bref je recommande amplement cette expérience, que ça soit pour guérir certains maux ou juste pour apprécier le moment :)', 'Lison', 20, $rubriques[2]],
            ['J\’ai beaucoup aimé l\’instrument que Étienne nous as présenté, j\'ai trouvé les sons de ce dernier très originaux. Ce pourquoi j’ai décidé de tenter l’expérience avec l’instrument sur le corps et c’est encore plus apaisant. Je conseille totalement de tester cette expérience sensorielle!', 'Elisa', 18, $rubriques[2]],
            ['Cette expérience très enrichissante m’a fait vivre de très agréables moments. Le contact de l’instrument sur mon corps me transportait un peu hors du temps. La musique apaisante me faisait penser un peu à la nature et dans ces moments je me situais dans un espace imaginaire comme si je voyageais un peu dans l’espace.', 'Bernard', 68, $rubriques[2]],
            ['Merci Etienne pour cette magnifique soirée à la maison en terrasse pleine de partage et de zenitude. Une soirée agréable à la découverte de ce magnifique instrument aux sons envoutants qui mènent à la relaxation dès les premières notes. Le bouquet final avec des sensations topissimes, le rapprochement avec l’instrument… Installée confortablement sur une table de massage avec le handpan sur le dos et la, génial ! Une connexion avec la musique… Que de bons moments… Encore merci à toi Etienne', 'Florence', 47, $rubriques[2]],
            ['J’ai apprécié tes explications préliminaires qui m’ont permis d’appréhender ce qui allait se passer durant la séance, dans mon corps et dans mon esprit, sans trop m’en dire pour que je puisse réellement découvrir de moi-même les sensations que cela allait me procurer. J’ai préféré avoir le handpan sur le ventre, je ressentais les vibrations dans les parties localisées de mon dos et les sons m’aidaient à m’apaiser. Lorsque j’étais positionnée sur le dos, j’avais bien plus la sensation que la handpan était à l’intérieur de moi, comme s’il venait détendre mes muscles et mes organes digestifs voire reproducteurs.', 'Miléna', 21, $rubriques[2]],
            ['Merci Etienne pour cette magnifique soirée à la maison en terrasse pleine de partage et de zenitude. Une soirée agréable à la découverte de ce magnifique instrument aux sons envoutants qui mènent à la relaxation dès les premières notes.', 'Florence', 47, $rubriques[1]],
            ['Merci Étienne pour ce moment de partage, d\'échange sur le voyage et la musique et ça tombe bien car le son pur de ton instrument nous emmène ailleurs, là où tout est possible, dans un monde meilleur !', 'Virginie', 47, $rubriques[1]],
            ['Nous avons adoré le blind test " Étienne à peu près" ^^  C\'est ludique, divertissant, de bonne longueur. Suffisamment pour qu\'on soit impliqué dans le jeu mais pas trop long pour que ça devienne lassant. Le choix des catégories était très bien ainsi que les morceaux, ça convenait à la moyenne d\'âge et suffisamment diversifié pour toucher tout le monde. En gros, c’était top !', 'Virginie', 41, $rubriques[0]],
            ['Dès les premières notes de Barbapapan sur ses soucoupes volantes musicales, nous avons tous été envoûtés, les adultes autant que les enfants. Ces sons magiques ne peuvent que vous transporter. Le handpan est un instrument fabuleux et bien qu\'originaire du pays voisin, il reste très peu connu dans nos contrées et fascine beaucoup ceux qui le découvrent, autant que ceux qui le redécouvrent d\'ailleurs. Le moment de douceur que nous a offert Barbapapan avec ses propres compos et ses reprises de musiques de film ou de séries restera gravé dans les mémoires du public de notre première scène ouverte. Merci à toi mystérieux enchanteur !', "Café de l'Eco'lette", 0, $rubriques[1]],
            ['Nous avons eu de très bons retours sur votre prestation, beaucoup de personnes ont découvert le handpan. Vous avez su avec votre musique mélodieuse et avec  vos explications intéresser un public nombreux. Les membres du conseil d’administration ont beaucoup apprécié votre animation.', 'Association Espoir de la Butte', 0, $rubriques[1]],
        ];

        // Création des commentaires

        for ($i = 0; $i < count($stock); ++$i) {
            $commentaire = new Commentaire();
            $commentaire->setMessage($stock[$i][0]);
            $commentaire->setPrenom($stock[$i][1]);
            $commentaire->setAge($stock[$i][2]);
            $commentaire->setRubrique($rubriques[2]);
            $commentaire->setValidate(true);
            $manager->persist($commentaire);
        }

        $manager->flush();
    }
}
