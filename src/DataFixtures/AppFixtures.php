<?php

namespace App\DataFixtures;

use App\Entity\ArtCategory;
use App\Entity\Article;
use App\Entity\Author;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    /**
     * AppFixtures constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $cat1 = new ArtCategory();
        $cat1->setName('Université');
        $cat1->setDescription('Articles en rapport avec l\'université');
        $cat1->setColor("#2372b9");

        $cat2 = new ArtCategory();
        $cat2->setName('Vie étudiante');
        $cat2->setDescription('Articles en rapport avec la vie étudiante');
        $cat2->setColor("#2ecc71");

        $cat3 = new ArtCategory();
        $cat3->setName('Vie associative');
        $cat3->setDescription('Articles en rapport avec la vie associative');
        $cat3->setColor("#e67e22");

        $cat4 = new ArtCategory();
        $cat4->setName('Vie culturelle');
        $cat4->setDescription('Articles en rapport avec la vie culturelle');
        $cat4->setColor("#9b59b6");

        $cat5 = new ArtCategory();
        $cat5->setName('Vie sportive');
        $cat5->setDescription('Articles en rapport avec la vie sportive');
        $cat5->setColor("#e74c3c");

        $cat6 = new ArtCategory();
        $cat6->setName('Politique');
        $cat6->setDescription('Articles en rapport avec la politique universitaire');
        $cat6->setColor("#f1c40f");

        $cat7 = new ArtCategory();
        $cat7->setName('Actualités');
        $cat7->setDescription('Articles en rapport avec les actualités universitaires');
        $cat7->setColor("#3498db");

        $cat8 = new ArtCategory();
        $cat8->setName('Recherche');
        $cat8->setDescription('Articles en rapport avec la recherche universitaire');
        $cat8->setColor("#1abc9c");

        $cat9 = new ArtCategory();
        $cat9->setName('Astuces');
        $cat9->setDescription('Articles en rapport avec des astuces pour les étudiants');
        $cat9->setColor("#f39c12");

        $cat10 = new ArtCategory();
        $cat10->setName('Autres');
        $cat10->setDescription('Articles en rapport avec l\'université mais qui ne rentrent pas dans les autres catégories');
        $cat10->setColor("#95a5a6");

        $author1 = new Author();
        $author1->setFirstname('Jean');
        $author1->setName('Dupont');
        $author1->setEmail('jeandupont@example.com');
        $author1->setPhone('0606060606');

        $author2 = new Author();
        $author2->setFirstname('Marie');
        $author2->setName('Durand');
        $author2->setEmail('marieduand@example.com');
        $author2->setPhone('0707070707');

        $art1 = new Article();
        $art1->setTitle('Lorem ipsum 1');
        $art1->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl. Nullam sed scelerisque justo. Cras non nunc vel nunc luctus dictum. Morbi nec ante sit amet sem consectetur viverra. Phasellus non sapien id nibh aliquet posuere. Vivamus in mauris et dolor lacinia congue. Mauris mollis, risus a aliquet convallis, nisi dui feugiat justo, vitae pretium eros justo ut diam. Sed quis odio non enim porta eleifend. Proin nec justo ut diam pretium faucibus. Duis euismod, massa eget faucibus porttitor, odio metus tincidunt mauris, nec placerat risus nibh eget neque. Mauris tempus, nulla nec dignissim lacinia, leo ante lacinia nunc, at consequat sem lorem quis lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras auctor, felis et elementum vehicula, orci ante aliquam mauris, id scelerisque dui lorem vel lacus. Sed in eros id ex tincidunt iaculis.');
        $art1->setIdCategory($cat1);
        $art1->setDate(new \DateTime());
        $art1->setThumbnailUrl("https://picsum.photos/600/400?random=1");
        $art1->addAuthor($author1);
        $art1->setFeatured(true);
        $art1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl.');
        $art1->setYoutubeLink("DsemU6yb7hA?si=D6XjTJUvQ1_nFPll");

        $art2 = new Article();
        $art2->setTitle('Lorem ipsum 2');
        $art2->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl. Nullam sed scelerisque justo. Cras non nunc vel nunc luctus dictum. Morbi nec ante sit amet sem consectetur viverra. Phasellus non sapien id nibh aliquet posuere. Vivamus in mauris et dolor lacinia congue. Mauris mollis, risus a aliquet convallis, nisi dui feugiat justo, vitae pretium eros justo ut diam. Sed quis odio non enim porta eleifend. Proin nec justo ut diam pretium faucibus. Duis euismod, massa eget faucibus porttitor, odio metus tincidunt mauris, nec placerat risus nibh eget neque. Mauris tempus, nulla nec dignissim lacinia, leo ante lacinia nunc, at consequat sem lorem quis lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras auctor, felis et elementum vehicula, orci ante aliquam mauris, id scelerisque dui lorem vel lacus. Sed in eros id ex tincidunt iaculis.');
        $art2->setIdCategory($cat2);
        $art2->setDate(new \DateTime());
        $art2->setThumbnailUrl("https://picsum.photos/600/400?random=2");
        $art2->addAuthor($author2);
        $art2->setFeatured(true);
        $art2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl.');
        $art2->setYoutubeLink("DsemU6yb7hA?si=D6XjTJUvQ1_nFPll");

        $art3 = new Article();
        $art3->setTitle('Lorem ipsum 3');
        $art3->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl. Nullam sed scelerisque justo. Cras non nunc vel nunc luctus dictum. Morbi nec ante sit amet sem consectetur viverra. Phasellus non sapien id nibh aliquet posuere. Vivamus in mauris et dolor lacinia congue. Mauris mollis, risus a aliquet convallis, nisi dui feugiat justo, vitae pretium eros justo ut diam. Sed quis odio non enim porta eleifend. Proin nec justo ut diam pretium faucibus. Duis euismod, massa eget faucibus porttitor, odio metus tincidunt mauris, nec placerat risus nibh eget neque. Mauris tempus, nulla nec dignissim lacinia, leo ante lacinia nunc, at consequat sem lorem quis lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras auctor, felis et elementum vehicula, orci ante aliquam mauris, id scelerisque dui lorem vel lacus. Sed in eros id ex tincidunt iaculis.');
        $art3->setIdCategory($cat3);
        $art3->setDate(new \DateTime());
        $art3->setThumbnailUrl("https://picsum.photos/600/400?random=3");
        $art3->addAuthor($author1);
        $art3->setFeatured(false);
        $art3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl.');
        $art3->setYoutubeLink("DsemU6yb7hA?si=D6XjTJUvQ1_nFPll");

        $art4 = new Article();
        $art4->setTitle('Lorem ipsum 4');
        $art4->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl. Nullam sed scelerisque justo. Cras non nunc vel nunc luctus dictum. Morbi nec ante sit amet sem consectetur viverra. Phasellus non sapien id nibh aliquet posuere. Vivamus in mauris et dolor lacinia congue. Mauris mollis, risus a aliquet convallis, nisi dui feugiat justo, vitae pretium eros justo ut diam. Sed quis odio non enim porta eleifend. Proin nec justo ut diam pretium faucibus. Duis euismod, massa eget faucibus porttitor, odio metus tincidunt mauris, nec placerat risus nibh eget neque. Mauris tempus, nulla nec dignissim lacinia, leo ante lacinia nunc, at consequat sem lorem quis lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras auctor, felis et elementum vehicula, orci ante aliquam mauris, id scelerisque dui lorem vel lacus. Sed in eros id ex tincidunt iaculis.');
        $art4->setIdCategory($cat4);
        $art4->setDate(new \DateTime());
        $art4->setThumbnailUrl("https://picsum.photos/600/400?random=4");
        $art4->addAuthor($author2);
        $art4->setFeatured(false);
        $art4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam aliquet, nunc nisl aliquet nunc, quis aliquam nisl nisl vitae nisl.');
        $art4->setYoutubeLink("DsemU6yb7hA?si=D6XjTJUvQ1_nFPll");

        $user1 = new User();
        $user1->setEmail('admin@example.com');
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'root'));
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setDate(new \DateTimeImmutable());
        $user1->setName('Admin');
        $user1->setCountry('France');
        $user1->setCity('La Rochelle');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->persist($cat4);
        $manager->persist($cat5);
        $manager->persist($cat6);
        $manager->persist($cat7);
        $manager->persist($cat8);
        $manager->persist($cat9);
        $manager->persist($cat10);

        $manager->persist($author1);
        $manager->persist($author2);

        $manager->persist($art1);
        $manager->persist($art2);
        $manager->persist($art3);
        $manager->persist($art4);

        $manager->persist($user1);

        $manager->flush();
    }
}
