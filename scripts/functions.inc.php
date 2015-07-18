<?php
function loginUser($un,$psw)
{
	$_SESSION['uid'] = $uid = Adapter::getAValue('UID','`person`','name=?',array($un),"s");
	$_SESSION['type'] = Adapter::getAValue('type','`person`','uid=?',array($uid),"i");
	if($uid == -1){print 1;return;}
	if(!Adapter::isExists('`person`','UID=? AND hash=?',array($uid,getHash($psw)),"is")){print 2;return;}
	/*login code*/
	$_SESSION['logged'] = 1;
	print 3;
}

function logOutUser()
{
	try
	{
		$_SESSION['logged'] = 0;
		unset($_SESSION['uid']);
	}catch(Exception $e){return 0;}
	return 1;
}

function getCustomers($arr)
{
	if(isset($arr['field']))
	{
		return json_encode(Adapter::getRecords('*','customer',$arr['field'] . ' like ?',array('%'.$arr['filter'].'%'),'s'));
	}
	return json_encode(Adapter::getRecords('*','customer','?',array(1),'i'));
}

function addcustomer($arr)
{
	Adapter::insertDBP('customer','name,company,address,tel,email',5,array($arr['name'],$arr['company'],$arr['address'],$arr['phone'],$arr['email']),'sssss');
	return 1;
}

function getCalls()
{

	return json_encode(bulkLongToDate(Adapter::getRecords('distinct `customer`.`company` AS `company`,`person`.`name` AS `name`,`calls`.`date` AS `date`,`calls`.`feedback` AS `feedback`,`calls`.`remarks` AS `remarks`,`person`.`UID` AS `uid`','((`calls` join `customer` on((`calls`.`custid` = `customer`.`custid`))) join `person` on((`calls`.`uid` = `person`.`UID`)))','? order by date desc',array(1),'i')));
}

function addCall($arr)
{
	Adapter::insertDBP('calls','custid,uid,date,feedback,remarks',5,array($arr['custid'],$_SESSION['uid'],time(),$arr['feed'],$arr['rem']),'iiiss');
	return 1;
}

/*long to date bulk*/
function bulkLongToDate($arr)
{
	foreach($arr as $key => $value)
	{
	  $arr[$key]['date'] = date(getDateString($value['date']));
	}
	return $arr;
}
/*long to date*/
function getDateString($date)
{
	return date('d-m-Y',$date);
}

/*Text to Hash*/
function getHash($text)
{
	return hash_hmac("sha256",$text,'dsj cgeygcr37gidug i3ug d7 guG Gugu ',false);
}
?>