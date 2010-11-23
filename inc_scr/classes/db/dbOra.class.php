<?PHP
require(DataDir.'classes/db.class.php');

class dbOra extends db
{
	var $Fdb
	
	function dbOra($ANameDb)
	{
		db::db($ANameDb);
	}
	//================================================================================	
	/**	function must create connection	*/
	function DbConnect()
	{
		$this->GetServerLogin();
		$FDbLink=oci_connect($FLogin, $FPass, $FHost);
	}
	//================================================================================	
	/**	function must destroy connection	*/	
	function DbDisconnect()
	{

	}		
	//================================================================================	
	/**	*/
	function SetRange($ALowBound,$AHighBound)
	{
		db::SetRange($ALowBound,$AHighBound);
		$FSqlText.=" select * from ($FSqlText) where rownum between $FLowBound and $FHighBound ";
	}
	//================================================================================	
	/**	function execute sql */
	function GoSql()
	{ 
		$this->DbConnect();
		$cur=oci_parse($DbLink,$FSqlText);
		$e=oci_execute($cur);
		if (!$cur) 
		{
			$e = oci_error($cur); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			echo "<pre>";
			echo htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			echo "</pre>";
		} 
		$this->DbDisconnect();
	}
	//================================================================================
	/**	function get array of query-result	*/
	function GetArray()
	{
		$this->DbConnect();
		$cur = oci_parse ($FDbLink, $FSqlText);
		oci_execute ($cur);
		if (!$cur) 
		{
			$e = oci_error($cur); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			echo "<pre>";
			echo htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			echo "</pre>";
		}
		$i=0;
		while ( $l_row = oci_fetch_array(  $cur, OCI_ASSOC  ) )
		{
			$FArraySql[$i++]=$l_row;
		}		
		$this->DbDisconnect();
		if($i==0)
			return null;
		else
			return $FArraySql;
	}
	//================================================================================
	function GetServerLogin()
	{
		switch($FNameDb):
		case '104':
			$FUser = OIL_104_USER;
			$FHost = OIL_104_TNS;
			$FPass = OIL_104_PASS;
		break;
		case '106':
			$FUser = OIL_106_USER;
			$FHost = OIL_106_TNS;
			$FPass = OIL_106_PASS;
		break;
		case '108':
			$FUser = OIL_108_USER;
			$FHost = OIL_108_TNS;
			$FPass = OIL_108_PASS;
		break;
		case 'CHK':
			$FUser = OIL_CHK_USER;
			$FHost = OIL_CHK_TNS;
			$FPass = OIL_CHK_PASS;
		break;
		endswitch;
    };
}

?>