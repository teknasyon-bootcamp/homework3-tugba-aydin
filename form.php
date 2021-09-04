<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */

/**
 * 
 */
class Form 
{
    // fields,action ve method propertyleri tanımlandı
    private $fields;
    private $method;
    private $action;
    
    //action ve method parametrelerini alan constructor tanımlandı
    private function __construct($action,$method)
    {
        //gönderilen parametreler propertylere atandı
        $this->action=$action;
        $this->method=$method;
    }

    // Diziye alan eklemesi yapan fonksiyon yazıldı
    function addField($value,$key,$default=null){ 
        //gönderilen parametreler diziye atandı
        $this->fields[]=["key"=>$key,"value"=>$value,"default"=>$default];
    }
 
    // methodun değerinin değiştirileceği fonksiyon yazıldı
    function setMethod($method){
        //gönderilen parametreyle method propertysi değiştirildi
        $this->method=$method;
    }

    //form'un ilgili alanlarını HTML çıktı olarak veren fonksiyon yazıldı
    function render(){
        
        $response='';

        //dizimizdeki değerleri döngü yapısıyla HTML elemanlarına aktardık
        foreach ($this->fields as $field) {
            $label="<label for='".$field["key"]."'>".$field['value']."</label>";
            $input="<input type='text' name='".$field["key"]."'";
            if($field['default']!=null){
                $input=$input." value='".$field["default"]."' />";
            }
            else{
                $input=$input."/>";
            }
            $response.=$label.$input;
        }
        $response.="<button type='submit'>Gönder</button>";
        $form="<form method='$this->method' action='$this->action'>".$response."</form>";
        echo($form);
    }

    //POST metotuna göre işlem yapan fonksiyon yazıldı
    static function createPostForm($action){
        $form=new Form($action,"POST");
        return $form;
    }

    //GET metotuna göre işlem yapan fonksiyon yazıldı
    static function createGetForm($action){
        $form=new Form($action,"GET");
        return $form;
    }

    //Parametre olarak gönderilen metota göre işlem yapan fonksiyon yazıldı
    static function createForm($action,$method){
        $form=new Form($action,$method);
        return $form;
    }
}
