# mySomfony

## installation de fosuserbundle

http://www.tutodidacte.com/symfony2-installer-fosuserbundle?debut_article_rubrique_date=10#pagination_article_rubrique_date


http://www.foulquier.info/tutoriaux/creation-dun-back-office-sur-symfony-2-3-avec-sonataadminbundle-et-fosuserbundle-sf2-back-office-part-1


http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_doctrine_crud.html


-----------------------
### créer  un bundle
<pre>php app/console generate:bundle</pre>

### créer la db depuis les entity
<pre>php app/console doctrine:schema:update --force</pre>

### créer les S/G depuis les entity
<pre>php app/console doctrine:generate:entities AppBundle/Entity/Product</pre>

### lance les tests (créer dans Bundle\DataFixtures\ORM)
<pre>php app/console doctrine:fixtures:load</pre>

### créer les fichiers CRUD depuis les entity
<pre>php app/console generate:doctrine:crud</pre>

### créer  les formulaire CRUD depuis les entity
<pre>php app/console doctrine:generate:form TclBundle:Feed</pre>

-----------------------
### convertir db en xml
<pre>php app/console doctrine:mapping:import --force DomotiquebundleModuleBundle yml</pre>

### construi les entitie
<pre>php app/console doctrine:mapping:convert annotation ./src</pre>

-----------------------

### créer un utilisateur
<pre>php app/console fos:user:create</pre>

### promu un utilisateur
<pre>php app/console fos:user:promote</pre>

-----------------------

### créer les fichiers de traduction en yml pour un bundle
<pre>php app/console translation:update --force --output-format=yml fr CommunUserBundle</pre>

### test les traduction d'un bundle
<pre>php app/console debug:translation fr CommunUserBundle</pre>