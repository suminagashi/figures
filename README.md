<h1 style="text-align:center">Figures</h1>

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

### Create the Stats entity :

```bash
php bin/console figures:init
```

### Setup your entities :

> Setup coming

### How does this works :

There is two mode of stats calculation : cumul & count.

```Cumul :

order, 150, 2020/08/01 11:00,
order, 103, 2020/08/01 12:00,
order, 10, 2020/08/01 13:00,
order, 20, 2020/08/01 14:00,
order, 120, 2020/08/01 15:00,
order, 2420, 2020/08/01 16:00,
order, 1, 2020/08/01 20:00,

= 2804

Count :

user, 1, 2020/08/01 11:00,
user, 1, 2020/08/01 12:00,
user, 1, 2020/08/01 13:00,
user, 1, 2020/08/01 14:00,
user, 1, 2020/08/01 15:00,
user, 1, 2020/08/01 16:00,
user, 1, 2020/08/01 20:00,

= 7```
