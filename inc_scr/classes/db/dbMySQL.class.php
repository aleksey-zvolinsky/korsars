<?PHP
/*******************************************************************************
  Class dbMySQL
  About : class for work with MySQL, extends from db
  Author: frendos
*******************************************************************************/

require(DataDir.'classes/db.class.php');

class dbMySQL extends db
{
  var $FSqlLimit;
  var $FFields=array();
  /**
    fields and they properties
    array('<name>'=>array(<preperties>)
    )
  */

  //============================================================================
  /** construnctor of dbMySql-class */
  function dbMySql( $AIsDebug=0 )
  {
    db::db($AIsDebug);
    $this->FD->_log('Class dbMySql created');
  }
  //============================================================================
  /** function must create connection to MySQL */
  function DbConnect()
  {
    $this->FD->_log('dbMySQL->DbConnect',1);
    $q=@mysql_connect($this->FHost,$this->FUser,$this->FPass) or die("Îøèáêà ïîäêëş÷åíèÿ ê ÁÄ. ".mysql_error());
    echo mysql_error();
    //$this->$FDbLink=@mysql_connect(DB_HOST,DB_USER,DB_PASSWD) or die("Îøèáêà ïîäêëş÷åíèÿ ê ÁÄ. ".mysql_error());
    $this->FD->_log('dbMySQL->DbConnect_');
    $t=@mysql_select_db($this->FNameDb) or die("Îøèáêà âûáîğà ÁÄ. ".mysql_error());
  }
  //================================================================================
  /** function must destroy connection from MySQL */
  function DbDisconnect()
  {
    $this->FD->_log('dbMySQL->DbDisconnect',1);
    $this->FD->_log('dbMySQL->DbDisconnect_');
    return @mysql_close() or die("Îøèáêà îòêëş÷åíèÿ îò ÁÄ. ".mysql_error());
  }
  //================================================================================
  /** Set range of sql-query
    @ALowBound,@AHighBound - bounds of sql-query
  */
  function SetRange($ALowBound,$AHighBound)
  {
    db::SetRange($ALowBound,$AHighBound);
    $this->FSqlLimit=" limit ".($this->FLowBound-1).",".$this->FRowPerPage." ";
  }
  //================================================================================
  /** function execute sql */
  function GoSql( $ASql='' )
  {
    $this->FD->_logf('dbMySQL->GoSql(%s)',array($ASql),1);
    if($ASql!='')
      $this->SetSql($ASql);
    $this->DbConnect();
    $query_result = @mysql_query($this->FSqlText) or die("dbMySQL->GoSql:Îøèáêà âûïîëíåíèÿ çàïğîñà. ".mysql_error());
    //$this->FreeSQLResult($query_result) or die("dbMySQL->Îøèáêà îñâîáîæäåíèÿ ğåçóëüòàòà çàïğîñà. ".mysql_error());
    $this->DbDisconnect();
    $this->FD->_log('dbMySQL->GoSql_');
  }
  //================================================================================
  /** function get array of query-result */
  function GetArray( $ASql='' )
  {
    $this->FD->_logf('dbMySQL->GetArray(%s)',array($ASql),1);
    $this->DbConnect();

    if($ASql=='')
      $sql=$this->GetFullSql();
    else
      $sql=$ASql;
    $this->FD->_log($sql);
    $query_result = @mysql_query($sql) or die("dbMySQL->GetArray:Îøèáêà âûïîëíåíèÿ çàïğîñà. ".$sql." ".mysql_error());
    $i=0;
    while ($row = mysql_fetch_assoc($query_result))
      $ArraySql[$i++]=$row;
    if( isset($ArraySql) )
	    $this->FArraySql=$ArraySql;
	else
		$this->FArraySql=null;
    //$this->FD->_log($this->FArraySql);
    $this->FreeSQLResult($query_result) or die("dbMySQL->GetArray:Îøèáêà îñâîáîæäåíèÿ ğåçóëüòàòà çàïğîñà. ".mysql_error());
    $this->DbDisconnect();
    $this->FD->_log('dbMySQL->GetArray_');
    return $this->FArraySql;
  }
  //================================================================================
  /** free sql-result */
  function FreeSQLResult( $query_result )
  {
    $this->FD->_log('dbMySQL->FreeSQLResult',1);
    $this->FD->_log('dbMySQL->FreeSQLResult_');
    return @mysql_free_result($query_result) or die("dbMySQL->FreeResult:. ".mysql_error());

  }
  //================================================================================
  function GetFullSql()
  {
    $this->FD->_log('db->GetFullSql',1);
    $this->FD->_log($this->FSqlText);
    $this->FD->_log($this->FSqlWhere);
    $this->FD->_log($this->FSqlOrder);
    $this->FD->_log($this->FSqlLimit);
    $this->FD->_log('db->GetFullSql_');
    return $this->FSqlText.$this->FSqlWhere.$this->FSqlOrder.$this->FSqlLimit;
  }
  //============================================================================
  function getFields( $ATable )
  {
    $this->FD->_logf('dbMySQL->getFields(%s)',array($ATable),1);
    $this->DbConnect();
    $sql="SHOW FULL COLUMNS FROM $ATable";
    $this->FD->_log($sql);
    $this->FFields=$this->getArray($sql);
    // Äîïîëíèòåëüíàÿ îáğàáîòêà
    foreach($this->FFields as $key=>$field):
    	if(strpos($field['Type'],'enum')==strpos($field['Type'],'set'))
    	{
	    	if(strpos($field['Type'],'('))
	    	{	    		$size=substr($field['Type'],strpos($field['Type'],'(')+1);
	    		$size=substr($size,0,strpos($size,')'));
	    		$this->FFields[$key]['Size']=$size;	    	}
	    }
    endforeach;
    $this->FD->_log('dbMySQL->getFields_');
    return $this->FFields;
  }
}

?>