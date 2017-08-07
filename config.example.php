<?php

// Duplicate this file and rename it to config.php

// Bitcoin RCP server credentials
// Find out how to configure your bitcoin node here:
//
// https://en.bitcoin.it/wiki/Running_Bitcoin
//
// After you configured your node, fill out the settings below:
//
$credentials['rcp_user'] = ''; // username ex: 'admin'
$credentials['rcp_pass'] = ''; // password ex: 'pass1234'
$credentials['rcp_host'] = '127.0.0.1'; // host ex: '127.0.0.1' or 'my.btcrcp.example.com'
$credentials['rcp_port'] = '8332'; // port usually 8332

// Refresh rate. Set to null to disable automatic reload.
$configuration['refresh_rate'] = 60; // One minute

// Currency, only tested for 'EUR' and 'USD'.
$configuration['fiat_currency'] = 'EUR';