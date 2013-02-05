## 1. Installation
Add Ner0ticFoursquareBundle to your composer.json file accordingly.
```js
{
  "require": {
    "Ner0tic/foursquare-bundle": "*"
  }
}
```
Now use composer to add the bundle to your application.
```bash
$ php composer.phar update Ner0tic/foursquare-bundle
```
Composer will place the bundle in the `vendors/Ner0tic` directory.

#### Enable Bundle
Enable the bundle within the kernel.
```php
<?php // app/AppKernel.php
  public function registerBundles() 
  {
    $bundles = array(
      // ...
      new Ner0tic\FoursquareBundle\Ner0ticFoursquareBundle(),
    );
  }
```

#### Configure Bundle
 Add your api key and userid to your `app/config/config.yml` file.
```yaml
# app/config/config.yml
foursquare:
    api_key: XXXXXXXXX
    user_id: XXXXXXXXX
```
    
