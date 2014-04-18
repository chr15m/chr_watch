<?
function get_btc_price() {
	$rates = json_decode(file_get_contents("https://bitpay.com/api/rates"));
	return "BTC " . sprintf("%.1f", $rates[0]->{"rate"}); // . "(" . $rates[0]->{"code"} . ")";
}

function get_mailbox_counts() {
	$m = `grep -c -e "^Status: O" /var/spool/mail/chrism`;
	$w = `grep -c -e "^Status: O" /var/spool/mail/mccormickit`;
	return $m . " " . $c;
}

?>{"1":"","2":"<?=get_btc_price();?>","3":"<?=get_mailbox_counts();?>"}
