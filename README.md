# Bitcoin Web Ticker

This is a quick and dirty implementation of a full-page ticker for Bitcoin Core and Bitcoin Cash.

It is made in PHP and contains all dependencies it needs. It pulls price data from Kraken (currently the only exchange supported).

To use, just follow the instructions:

## How to use

This script requires PHP 5.4+

1. Have a `bitcoind` or `bitcoin-qt` running and configured to accept RPC calls.<br>Read more about this [here](https://en.bitcoin.it/wiki/Running_Bitcoin).
2. Duplicate the file `config.example.php` into `config.php` and fill out the credentials as explained.
3. Serve the files from a PHP capable server and open the page.
4. Voilà!

## Screenshot

![A screenshot of the ticker interface.](http://i.imgur.com/3vfSWXo.png)

## Details

The displayed data is as follows:

<table style="text-align: center;">
	<tr>
		<td colspan="3">Bitcoin Cash Price<br>24h Price Average</td>
		<td colspan="3">Bitcoin Core Price<br>24h Price Average</td>
	</tr>
	<tr>
		<td colspan="2">RPC Server Status</td>
		<td colspan="2">RPC Server Block Height</td>
		<td colspan="2">RPC Server Connections Count</td>
	<tr>
	<tr>
		<td colspan="3">RPC Server Reported Difficulty</td>
		<td colspan="3">RPC Server Reported Net Hashrate</td>
	</tr>
</table>

## Configurations

The available configurations (apart from credentials) are:

* `$configuration['refresh_rate']`<br>The refresh rate for the page, in seconds. Set it to `null` to disable the meta-refresh tag from being inserted.
* `$configuration['fiat_currency']`<br>The fiat currency to use for prices. Currently the only tested ones are `EUR` for Euros and `USD` for American Dollars.

## License

```
The MIT License (MIT)

Copyright (c) 2017 Bruno Philipe

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```

## Third party libraries used

### [EasyBitcoin.php](https://github.com/aceat64/EasyBitcoin-PHP):

```
The MIT License (MIT)

Copyright (c) 2013 Andrew LeCody

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```

### [KrakenAPIClient.php](https://github.com/payward/kraken-api-client/tree/master/php):

```
The MIT License (MIT)

Copyright (c) 2013 Payward, Inc

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```
