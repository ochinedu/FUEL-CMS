<h1>Tester Module Documentation</h1>
<p>This Tester documentation is for version the Blog module version <?=TESTER_VERSION?>.</p>

<h2>Overview</h2>
<p>The Tester module allows you to easily create tests and run them in the FUEL admin. 
To create a test, add a <dfn>test</dfn> folder within your applications folder. Tester will read that folder to create it's list of tests you are able to run.
It will even scan other modules for test directories to include in it's list of tests to run. <p>

<p>Some other important features to point out:</p>
<ul>
	<li>If you have SQL that you want to include in your test, add it to a <dfn>tests/sql</dfn> folder and you can call it in your test class's setup method (see below)</li>
	<li>Test classes should always end with the suffix <dfn>_test</dfn> (e.g. my_app_test.php)</li>
	<li>Test class methods should always begin with the prefix <dfn>test_</dfn></li>
	<li>Test database information can be set in the <dfn>config/tester.php</dfn> file</li>
</ul>

<h2>Example</h2>
<pre class="php:brush">
&lt;?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_site_test extends Tester_base {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function setup()
	{
		$this->load_sql('test_generic_schema.sql');

		// load a basic MY_Model to test
		require_once('test_custom_records_model.php');
	}
	
	public function test_find_by_key()
	{
		$test_custom_records_model = new Test_custom_records_model();

		// test find_by_key
		$record = $test_custom_records_model->find_by_key(1);
		$test = $record->full_name;
		$expected = 'Darth Vader';
		$this->run($test, $expected, 'find_by_key custom record object property test');
	
		// test get_full_name() method version
		$test = $record->get_full_name();
		$this->run($test, $expected, 'find_one custom record object method test');
	}
	
	public function test_goto_page()
	{
		//http://code.google.com/p/phpquery/wiki/Manual
		$post['test']= 'test';
		$home = $this->load_page('home', $post);

		$test = pq("#content")->size();
		$expected = 1;
		$this->run($test, $expected, 'Test for content node');

		$test = pq("#logo")->size();
		$expected = 1;
		$this->run($test, $expected, 'Test for logo node');
	}
	

}


</pre>


<h1>Function Reference</h1>

<h2>run(<var>test</var>, <var>expected</var>, <var>'[name]'</var>)</h2>
<p>Runs a test passing the value and the expected results. 
The <dfn>name</dfn> parameter will help identify it in the results page.</p>


<h2>setup()</h2>
<p>Placeholder to be overwritten by child classes for test setup (like database table creation etc).</p>


<h2>tear_down()</h2>
<p>Is called at the end of the test and will remove any test database that has been created.</p>


<h2>format_test_name(<var>'[name]'</var>, <var>test</var>, <var>expected</var>)</h2>
<p>Formats the test name to include the test and expected results.</p>


<h2>config_item(<var>'[key]'</var>)</h2>
<p>Return Tester specific configuration items.</p>


<h2>db_connect(<var>'[dsn]'</var>)</h2>
<p>Connects to the testing database
The <dfn>dsn</dfn> parameter is the database connection information for the test database.</p>


<h2>db_exists(<var>'[dsn]'</var>)</h2>
<p>Tests if the database for testing exists. Returns a boolean.</p>


<h2>create_db(<var>[connect]</var>)</h2>
<p>Creates the database and connects if <dfn>connect</dfn> parameter is set to TRUE.</p>


<h2>remove_db(<var>[connect]</var>)</h2>
<p>Removes the database and connects if $connect parameter is set to TRUE.</p>


<h2>load_sql(<var>'file'</var>, <var>[module]</var>)</h2>
<p>Loads the sql from a file in the {module}/test/sql folder. The default module is <dfn>tester</dfn>.</p>


<h2>load_page(<var>'file'</var>, <var>[module]</var>)</h2>
<p>Loads the results of call to a controller. Additionally creates pq function to query dom nodes.
The <dfn>pq</dfn> function allows you to use jQuery like syntax to query dom nodes on your page.
For more information, visit the <a href="http://code.google.com/p/phpquery/wiki/Manual" target="_blank">phpQuery</a> manual.
</p>
