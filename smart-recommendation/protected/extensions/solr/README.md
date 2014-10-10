solr-php-yii
============

This extension is Yii version of Solr-client-Php. It is compatable with Solr 4.x and uses Solr-client-Php to communicate with the Solr server


Requirements
------------------------------------------------------------------

Yii 1.0 or above


Installation 
------------------------------------------------------------------

Install the release file under protected/extensions

Add to `protected/config/main.php` // autoloading model and component classes

```bash
'import'=>array(
        'application.models.*',
               'application.components.*',
              'application.extensions.solr.*',
    )
 
'components'=>array(
       'userSearch'=>array(
            'class'=>'CSolrComponent',
            'host'=>'localhost',
            'port'=>8983,
            'indexPath'=>'/solr/user'
        ),
      'commentSearch'=>array(
            'class'=>'CSolrComponent',
            'host'=>'localhost',
            'port'=>8983,
            'indexPath'=>'/solr/comment'
        ),
```

Usage 
----------------------------------------------------------

See the following code example:
```bash
//To add or update an entry in your index
Yii::app()->commentSearch->updateOne(array('id'=>1,
                            'name'=>'tom',
                            'age'=>22)
                      );
//To add or update many documents
 
Yii::app()->userSearch->updateMany(array('1'=>array('id'=>1,
                                        'name'=>'tom',
                                        'age'=> 25),
                             '2'=>array('id'=>2,
                                        'name'=>'pitt')
                     );
 
//To search in your index
$result= Yii::app()->userSearch->get('name:tom',0,20);
echo "Results number is ".$result->response->numFound;
foreach($result->response->docs as $doc){
   echo "{$doc->name} <br>";
}
```
