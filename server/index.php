<?
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Main functions to return stuff to be displayed on Pebble. */

function get_btc_price() {
	$rates = json_decode(file_get_contents("https://bitpay.com/api/rates"));
	return "BTC " . sprintf("%.1f", $rates[0]->{"rate"}); // . "(" . $rates[0]->{"code"} . ")";
}

function get_mailbox_counts() {
	$boxes = parse_ini_file("mailboxes.conf", true);
	$counts = Array();

	foreach ($boxes as $name => $config) {
		$connect_string = "{" . $config{"server"} . ":" . $config{"port"} . "/imap/novalidate-cert" . ($config{"ssl"} ? "/ssl" : "") . "}INBOX";
		array_push($counts, mail_count($connect_string, $config{"username"}, $config{"password"}));
	}
	return join($counts, " ");
}

function get_top_line() {
	return file_get_contents("top.txt");
}

/* Helper functions. */

function mail_count($host, $username, $password) {
	$mbox = imap_open($host, $username, $password);
	if ($mbox) {
		$result = imap_search($mbox, 'UNSEEN');
		return count($result);
	}
}

?>{"1":"<?=get_top_line()?>","2":"<?=get_btc_price();?>","3":"<?=get_mailbox_counts();?>"}
