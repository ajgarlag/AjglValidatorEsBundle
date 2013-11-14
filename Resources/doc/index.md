AjglValidatorEsBundle
=====================

This bundles integrates the AjglValidatorEs library into Symfony.


Instalation
-----------

###Download AjglValidatorEsBundle

Add FOSUserBundle in your composer.json:

```js
{
    "require": {
        "ajgl/validator-es-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update ajgl/validator-es-bundle
```

Composer will install the bundle to your project's `vendor/ajgl` directory.


###Enable the Bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ajgl\Bundle\ValidatorEsBundle\AjglValidatorEsBundle(),
    );
}
```

###Add new constraints to your classes

You can now define new constraints in your classes. For example:

```yaml
# src/Acme/UserBundle/Resources/config/validation.yml
Acme\UserBundle\Entity\User:
    properties:
        id:
            - "AjglEs:Dni": ~
```

By default, the new constraints namespaces is aliased as `AjglEs`. You can
modify in the bundle configuration

Configuration
-------------

To configure the bundle, add the following configuration to your `config.yml`
file.

``` yaml
# app/config/config.yml
ajgl_validator_es:
    namespace_alias: "Es"#"AjglEs" by default
```
