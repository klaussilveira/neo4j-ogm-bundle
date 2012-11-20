Neo4j OGM Bundle
================

This bundle provides a simple integration of the 
"[Neo4j PHP Object Graph Mapper](https://github.com/lphuberdeau/Neo4j-PHP-OGM)" from 
Louis-Philippe Huberdeau into Symfony2. The Neo4j OGM is an object management layer 
built on top of Josh Adell's [Neo4jPHP](https://github.com/jadell/neo4jphp). It allows
manipulation of data inside the Neo4j graph database through the REST connectors.

## Installation

To install this bundle, add this to your project's composer.json:

``` json
"require": {
    // ...
    "klaussilveira/neo4j-ogm-bundle": "dev-master",
}
```

Next, update your vendors by running:

``` bash
$ composer update
```

Now enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Neo4j\OGM\OGMBundle\Neo4jOGMBundle(),
    );
}
```

And configure the bundle by adding the `neo4j_ogm` namespace into `config.yml`:

``` yaml
neo4j_ogm:
    host: 'localhost'
    port: 7474
```

Congratulations! You're ready to use Neo4j OGM into Symfony2.

## Basic Usage

The only thing to do is to request the `neo4j.manager` service from the 
container to get an instance of `HireVoice\Neo4j\EntityManager`.

``` php
<?php

$em = $this->container->get('neo4j.manager');
$repo = $em->getRepository('Entity\\User');
$john = $repo->findOneByFullName('John Doe');

$list = $em->createCypherQuery()
    ->startWithNode('john', $john)
    ->match('john -[:follow]-> followedBy <-[:follow]- similarInterest')
    ->match('similarInterest -[:follow]-> potentialMatch')
    ->end('potentialMatch', 'count(*)')
    ->order('count(*) DESC')
    ->limit(10)
    ->getList();
```

## Configuration

You can easily configure the Neo4j OGM by changing `neo4j_ogm` on your config.yml:

``` yaml
neo4j_ogm:
    transport: 'curl'
    host: 'localhost'
    port: 7474
    username: 'test'
    password: '123456'
    proxy_dir: '/tmp'
    debug: true
```