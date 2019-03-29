<?php


interface IModel{
    public function all();
    public function delete();
    public function save();
}

interface IDriverDB{
    public function connect();
    public function toRead();
    public function toSave();
}

trait HasAttributes{

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function getAttribute($key){
        if (! $key) {
            return null;
        }

        if (array_key_exists($key, $this->attributes) ||
            $this->hasGetMutator($key)) {
            return $this->getAttributeValue($key);
        }

        // Here we will determine if the model base class itself contains this given key
        // since we don't want to treat any of those methods as relationships because
        // they are all intended as helper methods and none of these are relations.
        if (method_exists(self::class, $key)) {
            return null;
        }

        return null;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed $value
     * @return $this
     * @throws Exception
     */
    public function setAttribute($key, $value){
        // First we will check for the presence of a mutator for the set operation
        // which simply lets the developers tweak the attribute as it is set on
        // the model, such as "json_encoding" an listing of data for storage.
        if ($this->hasSetMutator($key)) {
            $method = 'set'.ucfirst($key).'Attribute';

            return $this->{$method}($value);
        }

        if ($this->isJsonCastable($key) && ! is_null($value)) {
            $value = $this->castAttributeAsJson($key, $value);
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasSetMutator($key)
    {
        return method_exists($this, 'set'.ucfirst($key).'Attribute');
    }

    /**
     * Determine whether a value is JSON castable for inbound manipulation.
     *
     * @param  string  $key
     * @return bool
     */
    protected function isJsonCastable($key)
    {
        return $this->hasCast($key, ['array', 'json', 'object', 'collection']);
    }

    /**
     * Cast the given attribute to JSON.
     *
     * @param  string $key
     * @param  mixed $value
     * @return string
     * @throws Exception
     */
    protected function castAttributeAsJson($key, $value)
    {
        $value = $this->asJson($value);

        if ($value === false) {
            throw new Exception($key.' - '.json_last_error_msg());
        }

        return $value;
    }

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasGetMutator($key)
    {
        return method_exists($this, 'get'.ucfirst($key).'Attribute');
    }

    /**
     * Get an attribute from the $attributes array.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeFromArray($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
        return null;
    }

    /**
     * Get the value of an attribute using its mutator.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateAttribute($key, $value)
    {
        return $this->{'get'.ucfirst($key).'Attribute'}($value);
    }

    /**
     * Determine whether an attribute should be cast to a native type.
     *
     * @param  string  $key
     * @param  array|string|null  $types
     * @return bool
     */
    public function hasCast($key, $types = null)
    {
        if (array_key_exists($key, $this->getCasts())) {
            return $types ? in_array($this->getCastType($key), (array) $types, true) : true;
        }

        return false;
    }

    /**
     * Get the type of cast for a model attribute.
     *
     * @param  string  $key
     * @return string
     */
    protected function getCastType($key)
    {
        return trim(strtolower($this->getCasts()[$key]));
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts()
    {
        return $this->casts;
    }

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        switch ($this->getCastType($key)) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                return (float) $value;
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'object':
                return $this->fromJson($value, true);
            case 'array':
            case 'json':
                return $this->fromJson($value);
            default:
                return $value;
        }
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = $this->getAttributeFromArray($key);

        // If the attribute has a get mutator, we will call that then return what
        // it returns as the value, which is useful for transforming values on
        // retrieval from the model to a form that is more useful for usage.
        if ($this->hasGetMutator($key)) {
            return $this->mutateAttribute($key, $value);
        }

        // If the attribute exists within the cast array, we will convert it to
        // an appropriate native PHP type dependant upon the associated value
        // given with the key in the pair. Dayle made this comment line up.
        if ($this->hasCast($key)) {
            return $this->castAttribute($key, $value);
        }

        return $value;
    }

    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value)
    {
        return json_encode($value);
    }

    /**
     * Decode the given JSON back into an array or object.
     *
     * @param  string  $value
     * @param  bool  $asObject
     * @return mixed
     */
    public function fromJson($value, $asObject = false)
    {
        return json_decode($value, ! $asObject);
    }

}

abstract class Model{

    use HasAttributes;

    private $providerDB;
    protected $table;
    protected $guard;

    protected $where;

    public function __construct()
    {
        //Ім'я дочірнього класу
        $this->table = strtolower(get_called_class());
        $this->providerDB = new FakeDB($this->table);
        $this->where = ['id' => 0];
    }

    //region magic methods
    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     * @throws Exception
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    public function __call($method, $parameters)
    {
        return $this->$method(...$parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
    //endregion magic methods

    /**
     * @throws Exception
     */
    protected function all(){

        $rawData = $this->providerDB->all();

        if($rawData){
            $this->fill($rawData);
        }
        return $this;
    }

    protected function get(){
        $this->providerDB->setIdentification($this->where);
        $rawData = $this->providerDB->get();
        if($rawData){
            $this->fill($rawData);
        }
        return $this;
    }

    protected function where(array $where){
        $this->where = $where;
        return $this;
    }

    protected function delete(){

    }

    protected function save(){
        $this->providerDB->setIdentification($this->where);
        $this->providerDB->setAttributes($this->attributes);
        return $this->providerDB->save();
    }

    protected function first(){
        $data = reset($this->attributes);
        if(!empty($data)){

            if(array_key_exists('id', $data) && $this->where['id'] == 0){
                $this->where['id'] = $data['id'];
            }

            $this->fill($data);
        }
        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     * @throws Exception
     */
    public function fill(array $attributes)
    {
        $this->attributes = []; //clear
        if(!empty($attributes) && is_array($attributes))
        {
            foreach ($attributes as $key=>$attr)
            {
                $this->setAttribute($key, $attr);
            }
        }
        return $this;
    }
}


class FakeDB implements IDriverDB, IModel {

    private $path;
    private $data;

    private $table;
    private $attributes;
    private $identification;

    public function __construct($table)
    {
        $this->table = $table;
        $this->connect();
    }

    //region getters / setters
    public function getIdentification()
    {
        return $this->identification;
    }
    public function getAttributes(){
        return $this->attributes;
    }

    public function setIdentification($identification)
    {
        $this->identification = $identification;
        return $this;
    }
    public function setAttributes($attributes){
        $this->attributes = $attributes;
        return $this;
    }
    //endregion getters / setters



    private function preparePath($db){
        return $this->path = __DIR__.'/'.$db;
    }

    public function all()
    {
        $rawData = $this->toRead();
        if(array_key_exists($this->table, $rawData)){
            return $rawData[$this->table];
        }
        return null;
    }

    public function get()
    {
        $rawData = $this->toRead();
        $res = array_filter($rawData[$this->table], function ($val) {
            return $this->filter($val);
        });
        return $res;
    }

    public function delete()
    {

    }

    //недороблений
    public function filter(array $attributes)
    {
        $identification = $this->getIdentification();
        //якщо фільтр по: ['id' => 1]
        if(count($identification) == 1)
        {
            if(is_array($identification[key($identification)]))
            {
                $param = $identification[key($identification)];
                $comparison = "return ".$attributes[key($identification)].' '.key($param).' '.$param[key($param)].";";
                return eval($comparison);
            } else {
                return $attributes[key($identification)] == $identification[key($identification)];
            }
        //якщо фільтр по: ['id'=> 1, 'order_amount'=>['>=' => 8500]]
        }elseif(count($identification) > 1){
            $comparison = '';

            foreach ($identification as $k=>$v){
                if(is_array($v)){
                    $comparison .= ' && '.$attributes[$k].key($v).$v[key($v)];
                } else {
                    $comparison .= ' && '.$attributes[$k].'=='.$v;
                }
            }

            return eval("return ".substr($comparison, 4).";");
        }

        return false;
    }

    //недороблений
    public function save()
    {
        $rawData = $this->toRead();

        $identification = $this->getIdentification();

        $b = array_map(function ($val) use($identification) {
            if(count($identification) == 1)
            {
                if($val[key($identification)] == $identification[key($identification)])
                {
                    foreach ($this->getAttributes() as $k=>$v)
                    {
                        if(array_key_exists($k, $val)){
                            $val[$k] = $v;
                        }
                    }
                }
            }
            return $val;
        }, $rawData[$this->table]);

        $rawData[$this->table] = $b;

        try{
            $this->data = $rawData;
            $this->toSave();
            return true;
        } catch (Exception $e){
            return false;
        }

    }

    public function toRead(){
        $this->data = unserialize(file_get_contents($this->path));
        return $this->data;
    }

    public function toSave(){
        return file_put_contents($this->path, serialize($this->data));
    }

    public function connect()
    {
        $this->preparePath('db.txt');
    }
}


class Order extends Model{

}

class User extends Model{

}



$user = Order::where(['id'=> 1])->get();
$single_order = $user->first();
__d($single_order);


function __d($val){
    echo '<pre>'; var_dump($val); die('</pre>');
}