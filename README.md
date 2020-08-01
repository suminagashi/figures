#Figures

**Statistics for your symfony app, simply.**

## Install the bundle :

> Flex recipe incoming...

### Register the bundle :

``` php
// config/bundles.php

return [
    ...
    Suminagashi\FiguresBundle\FiguresBundle::class => ['all' => true],
];
```

### Add the Figure entity to your database :

```bash
php bin/console doctrine:schema:update --force
```

### Setup your entities :

First you need to import `Suminagashi\FiguresBundle\Annotation\Watch` annotation. Then you have to write add the key of your stat, the type (cumul or count) and the lifecycle (at which lifecycle you want the stat to register).

```php

use Suminagashi\FiguresBundle\Annotation\Watch;

class Product
{
    //...

    /**
     *
     * @ORM\Column(type="integer")
     *
     * @Watch(key="product:price", type="cumul", lifecycle="update")
     * @Watch(key="product:sell", type="count", lifecycle="create")
     */
    private $price;

    //***

```

### How does this works :

There is two mode of stats calculation :
- `count` is for counting the number of sales (e.g).
- `cumul` is for calculating the amount of sales (e.g).

### How to get a specific stats :

First you need to import `Suminagashi\FiguresBundle\Tools\Figures` in your code. Then you can autowire the class and start using it. We provide few methods to help you :

```php
$figures = new Figures();

$figures->all('key');
$figures->getToday('key');
$figures->getLastweek('key');
$figures->getLastmonth('key');
$figures->getLastyear('key');
$figures->get('key', 'start', 'end');
```

### Coming :

- Stat percentages calculations.
- Statut type
- Better exception handling
- Handle delete (cascade)
