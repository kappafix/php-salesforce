# PHP Salesforce REST API wrapper

Forked from:
```nachitox/php-salesforce-rest-api``` ```bjsmasth/php-salesforce-rest-api``` ```Cleeng/php-salesforce-rest-api``` ```jerkob/php-salesforce-rest-api-forked```


## Install

Via **[composer](https://getcomposer.org/)**

``` bash
composer require kappafix/php-salesforce
```

# Getting Started

Setting up a Connected App

1. Log into your Salesforce org
2. Click on Setup in the upper right-hand menu
3. Under Build click ```Create > Apps ```
4. Scroll to the bottom and click ```New``` under Connected Apps.
5. Enter the following details for the remote application:
    - Connected App Name
    - API Name
    - Contact Email
    - Enable OAuth Settings under the API dropdown
    - Callback URL
    - Select access scope (If you need a refresh token, specify it here)
6. Click Save

After saving, you will now be given a _consumer key_ and _consumer secret_. Update your config file with values for ```consumerKey``` and ```consumerSecret```

# Setup

Authentication

```bash
	
	/*save the config options in a config file*/
	
    $options = [
        'grant_type' => 'password',
        'client_id' => 'CONSUMERKEY', /* insert consumer key here */
        'client_secret' => 'CONSUMERSECRET', /* insert consumer secret here */
        'username' => 'SALESFORCE_USERNAME', /* insert Salesforce username here */
        'password' => 'SALESFORCE_PASSWORD' . 'SECURITY_TOKEN', /* insert Salesforce user password and security token here */
		'endPoint' => 'https://login.salesforce.com/', /* if you want to login to a Sandbox change the url to https://test.salesforce.com/ */
		'apiVersion' => 'v48.0'
    ];

	$salesforce = new \Kappafix\Salesforce\SfCaller($options);

    /* if you need access token or instance url */
    $accessToken = $salesforce->getAccessToken();
    $instanceUrl = $salesforce->getInstanceUrl();
```

Query

```bash
    $query = 'SELECT Id,Name FROM ACCOUNT LIMIT 100';

    
    /* returns array with the queried data */
    $data = $salesforce->query($query);

```

Create

```bash

    $data = [
       'Name' => 'Some name',
    ];

    /* returns the id of the created object */
    $salesforce->Account->insert( $data);
```

Update

```bash
    $new_data = [
       'Name' => 'another name',
    ];

    /* returns statuscode */
    $salesforce->Account->update($id, $new_data);
```

Upsert

```bash
    $new_data = [
       'Name' => 'another name',
    ];

    /* returns statuscode */
    $salesforce->Account->upsert( 'API Name/ Field Name', 'value', $new_data);
```

Delete

```bash
    $salesforce->Account->delete($id);
```

Get

```bash
    $salesforce->Account->get($id);
```

Describe

```bash
    $salesforce->'Account'->describe();
```

Custom endpoint

```bash
    $salesforce->Account->customEndpoint('apex/myCustomEndpoint', $data, 200);
```

#### Changelog: ####


##### 16.03.2021 #####
 - made easier to use, especially if you use it in multiple area of your code
 - added a SalesforceWrapper on SalesforceFunctions
 - added a SfCaller for the syntax $salesforce->Object->method($arguments)
