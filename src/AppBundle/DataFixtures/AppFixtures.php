<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;
use AppBundle\Entity\Section;
use AppBundle\Entity\Content;
use AppBundle\Entity\ContentBlock;
use AppBundle\Entity\Query;
use AppBundle\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new User;
        $category = new Category;
        $section = new Section;
        $content = new Content;
        $contentBlock = new ContentBlock;
        $query = new Query;
        $article = new Article;

        $admin->setEmail('superadmin@fixt.com');
        $admin->setPassword('$2y$10$23S9DhyczuI4JJayORceheu1vEgZT1b4irYPQFsV1.9ULQkeJ0GvW'); //admin
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setName('Admin');
        $admin->setConsentName(false);
        $admin->setLastName('Admin');
        $admin->setConsentLastName(false);
        $admin->setNickName('Admin');
        $admin->setBirthdate(new \Datetime('now'));
        $admin->setGender('male');
        $admin->setStatus('employed');
        $admin->setConsentMail(true);
        $admin->setAddress('24 Grande Rue Dijon');
        $admin->setZipcode('21000');
        $admin->setCity('Dijon');
        $admin->setDepartment('Côte d\'or');
        $admin->setPhone('0381457896');
        $admin->setUsePhone(true);
        $admin->setMobile('0681457896');
        $admin->setUseMobile(true);
        $admin->setConsentTerms(true);
        $admin->setConsentNews(true);
        $admin->setEnabled(true);
        $admin->setDeleted(false);

        $category->setTitle('Category-1');
        $category->setIntro('<p>Category 1</p>');
        $category->setLink('Link');
        $category->setDomain('Domaine-1');
        $category->setFooter('<p>Footer 1</p>');
        $category->setPublished(true);
        $category->setSlug('Category-1');
        $category->setColor('#d11010');
        
        $section->setCategory($category);
        $section->setTitle('Section-1');
        $section->setIntro('<p>Section-1</p>');
        $section->setLink('Link');
        $section->setSlug('Section-1');
        $section->setColor('#000000');
        $section->setPublished(true);

        $content->setSection($section);
        $content->setTitle('Content-1');
        $content->setIntro('<p>Intro</p>');
        $content->setType('type_1');
        $content->setSlug('Content-1');
        $content->setPublished(true);

        $query->setType('AND');
        $query->setName('query-1');
        $query->setDescription('Dummy fixtured query');
        $query->setEntity('organism');
        $query->setFilters([
            'field' => 'name',
            'value' => 'Un nom'
        ],[
            'field' => 'zipcode',
            'value' => '21000'
        ]);

        $contentBlock->setContent($content);
        $contentBlock->setType('jobs_maps');
        $contentBlock->setTitle('Bloc de contenus 1');
        $contentBlock->setQuery($query);
        
        $article->setTitle('My Article');
        $article->setIntroduction('Introdution');
        $article->setContent('<p> Le contenus </p>');
        $article->setSection($section);

        $manager->persist($admin);
        $manager->persist($category);
        $manager->persist($section);
        $manager->persist($content);
        $manager->persist($contentBlock);
        $manager->persist($query);
        $manager->persist($article);

        $manager->flush();
    }
}
