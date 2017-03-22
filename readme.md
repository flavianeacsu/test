--> set DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env

--> create models, controllers and migrations for Producers and Products
php artisan make:model Producer -mc
php artisan make:model Product -mc

--> set fields for tables in the migrations just made
pentru producers
 $table->increments('id');
 $table->string('name');
 $table->timestamps();

pentru products
$table->increments('id');
$table->string('name');
$table->string('description');
$table->integer('producer_id');
$table->timestamps();

--> php artisan migrate
--> insert data in producers table manually

--> set relationship between tables
ProducerModel -> public function products()
    {
    	$this->hasMany(Product::class);
    }

ProductModel -> public function producer()
    {
    	$this.belongsTo(Producer::class);
    }

--> set up routes
Route::get('/add', 'ProductController@create');
Route::post('/add', 'ProductController@store');

--> set up create method in ProductController
public function create()
    {
    	$products = Product::latest()->get();
    	$producers = Producer::latest()->get();
    	return view('create', compact('products','producers'));
    }

--> set up create view where I have the HTML for my form

--> set up store method in ProductController
 public function store()
    {
    	//validate
    	$this->validate(request(), [
    		'name' => 'required',
    		'description' => 'required',
    		'producer' => 'required'
    	]);

    	//get producer_id
    	$producer_id = Producer::where('name',request('producer'))->first()->id;

    	//store product
    	Product::create([
    		'name' => request('name'),
    		'description' => request('description'),
    		'producer_id' => $producer_id
    	]);

    	//redirect
    	return redirect()->home();
    }


