<?php

// WARNING: You don't need to change anything in this file. Just duplicate the file config.example.php,
// name it config.php, and follow the instructions in it. Then open this file in the browser.

/**
 * Simple web stats for Bitcoin and Bitcoin Cash
 *
 * See https://github.com/brunophilipe/bitcoin-web-ticker for more info.
 *
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2017 Bruno Philipe
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once 'KrakenAPIClient.php';
require_once 'easybitcoin.php';
require_once 'config.php';

/** KRAKEN PART **/

// Credentials only needed for private calls. We only use public ones here.
// If you modify this file to show private Kraken API data, you will need to add your credentials here.
$kraken = new KrakenAPI('', '', 'https://api.kraken.com');

$page_fiat = $configuration['fiat_currency'];

$ticker_data = $kraken->QueryPublic('Ticker', ['pair' => "BCH$page_fiat,XBT$page_fiat"]);
$ticker_bch = $ticker_data['result']["BCH$page_fiat"];
$ticker_btc = $ticker_data['result']["XXBTZ$page_fiat"];

$last_price_bch = floatval($ticker_bch['a'][0]);
$last_price_btc = floatval($ticker_btc['a'][0]);

$avg_24h_bch = floatval($ticker_bch['p'][1]);
$avg_24h_btc = floatval($ticker_btc['p'][1]);

$price_bch_class = $last_price_bch >= $avg_24h_bch ? 'good' : 'bad';
$price_btc_class = $last_price_btc >= $avg_24h_btc ? 'good' : 'bad';

/** FULL NODE PART **/

$bitcoin = new Bitcoin($credentials['rcp_user'],$credentials['rcp_pass'],$credentials['rcp_host'],$credentials['rcp_port']);

$node_info = $bitcoin->getinfo();

$node_status_class = $node_info !== false ? 'good' : 'bad';
$node_status = $node_info !== false ? 'Up' : 'Down';

$node_block_height = $node_info !== false ? $node_info['blocks'] : $bitcoin->error;
$node_connections = $node_info !== false ? $node_info['connections'] : '?';

$node_hash = $bitcoin->getnetworkhashps();

$node_network_hash = $node_hash !== false ? format_multiplier(floatval($node_hash)) . 'h/s' : '?';
$node_network_diff = $node_hash !== false ? format_multiplier($node_info['difficulty']) : '?';

/** Extra Stuff **/

// This will build a URL back to the current page, so that we can reload it.
$page_refresh_rate = $configuration['refresh_rate'];

if ($page_refresh_rate !== null)
{
	$page_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
else
{
	$page_url = null;
}

// This will build the fiat currency symbol
$page_fiat_symbol = '';

switch ($page_fiat)
{
	case 'EUR':
		$page_fiat_symbol = '€';
		break;

	case 'USD':
		$page_fiat_symbol = '$';
		break;
}

function format_multiplier($input)
{
	if ($input / 1000000000000000000.0 > 1.0)
	{
		$value = $input / 1000000000000000000.0;
		return sprintf('%.02fH', $value);
	}
	elseif ($input / 1000000000000000.0 > 1.0)
	{
		$value = $input / 1000000000000000.0;
		return sprintf('%.02fP', $value);
	}
	elseif ($input / 1000000000000.0 > 1.0)
	{
		$value = $input / 1000000000000.0;
		return sprintf('%.02fT', $value);
	}
	elseif ($input / 1000000000.0 > 1.0)
	{
		$value = $input / 1000000000.0;
		return sprintf('%.02fG', $value);
	}
	elseif ($input / 1000000.0 > 1.0)
	{
		$value = $input / 1000000.0;
		return sprintf('%.02fM', $value);
	}
	elseif ($input / 1000.0 > 1.0)
	{
		$value = $input / 1000.0;
		return sprintf('%.02fk', $value);
	}
	else
	{
		return "{$input}";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticker</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
<?= $page_url !== null ? "\t<meta http-equiv=\"refresh\" content=\"$page_refresh_rate;url=$page_url\">\n" : "" ?>
	<style type="text/css">
		body
		{
			background-color: #000;
			margin: 0;
			padding: 0;
			color: white;
			height: 100vh;
			font-family: 'Roboto', sans-serif;
		}

		table
		{
			width: 100%;
			border: none;
			table-layout: fixed;
		}

		td
		{
			border-style: solid;
			border-color: #111;
			text-align: center;
		}

		tr.label
		{
			font-size: 24px;
			height: 48px;
		}

		tr.info
		{
			font-size: 40px;
		}

		tr.info span
		{
			font-weight: 600;
		}

		tr.info small
		{
			font-size: 50%;
		}

		.bad
		{
			color: #cb0000;
		}

		.good
		{
			color: #00cb00;
		}

		.big
		{
			font-size: 150%;
		}
	</style>
</head>
<body>
	<table cellpadding="0" cellspacing="0" border="none" style="height: 40%">
		<tr class="label">
			<td>Bitcoin Cash</td>
			<td>Bitcoin Core</td>
		</tr>
		<tr class="info">
			<td>
				<span class="<?=$price_bch_class?> big"><?php printf("%s%.02f", $page_fiat_symbol, $last_price_bch); ?></span><br><small><?php printf("%s%.02f", $page_fiat_symbol, $avg_24h_bch); ?></small>
			</td>
			<td>
				<span class="<?=$price_btc_class?> big"><?php printf("%s%.02f", $page_fiat_symbol, $last_price_btc); ?></span><br><small><?php printf("%s%.02f", $page_fiat_symbol, $avg_24h_btc); ?></small>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" border="none" style="height: 60%">
		<tr class="label">
			<td colspan="2">Node Status</td>
			<td colspan="2">Block Height</td>
			<td colspan="2">Connections</td>
		</tr>
		<tr class="info">
			<td colspan="2">
				<span class="<?=$node_status_class?>"><?= $node_status ?></span>
			</td>
			<td colspan="2">
				<span><?= $node_block_height ?></span>
			</td>
			<td colspan="2">
				<span><?= $node_connections ?></span>
			</td>
		</tr>
		<tr class="label">
			<td colspan="3">Difficulty</td>
			<td colspan="3">Hash Rate</td>
		</tr>
		<tr class="info">
			<td colspan="3">
				<span><?= $node_network_diff ?></span>
			</td>
			<td colspan="3">
				<span><?= $node_network_hash ?></span>
			</td>
		</tr>
	</table>
</body>
</html>