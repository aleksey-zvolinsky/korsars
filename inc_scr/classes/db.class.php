<?PHP
/*******************************************************************************
  Class db
  About : abstract class for work with some database
  Author: frendos
*******************************************************************************/

require_once(DataDir.'classes/debug.class.php');
class db
{
  //debug
  //var $FIsDebug=false;
  //var $FLogPos=0;
  var $FD;//copy of debug class
  //server
  var $FNameDb;
  var $FUser;
  var $FHost;
  var $FPass;
  var $FDbLink;
  //sql
  var $FSqlText;
  var $FSqlWhere;
  var $FSqlOrder;
  var $FArraySql/*=array()*/;
  //sql-range
  var $FLowBound;
  var $FHighBound;
  var $FPageNumber;
  var $FRowPerPage;
  //service variable
  var $FTmp_sep='++++++++++';

  //============================================================================
  /** constructor of db-class */
  function db( $IsDebug=0 )
  {
    $this->FD=new debug($IsDebug);
    $old=error_reporting(E_ALL ^ E_NOTICE);
    if(!DEFINED(DB))
      define('DB','');
    $this->FNameDb=DB;
    if(!DEFINED(DB_USER))
      define('DB_USER','');
    $this->FUser=DB_USER;
    if(!DEFINED(DB_HOST))
      define('DB_HOST','');
    $this->FHost=DB_HOST;
    if(!DEFINED(DB_PASSWD))
      define('DB_PASSWD','');
    $this->FPass=DB_PASSWD;
    error_reporting($old);
    $this->FD->_log('Class db created');
  }
  //============================================================================
  /** abstract function must create connection */
  function DbConnect()
  {
    return true;
  }
  //============================================================================
  /** abstract function must destroy connection */
  function DbDisconnect()
  {
    return true;
  }
  //============================================================================
  /** Get sql-text from file
     @AFilePath - path to sql file
  */
  function SetSqlFromFile( $AFilePath )
  {
    $this->FD->_log('db->SetSqlFromFile',1);
    $this->FSqlFile=$AFilePath;
    $this->FD->_log($this->FSqlFile);
    // Открываем файл на чтение
    $fd = fopen($this->FSqlFile,"r");
    if (!$fd) die("<strong>Ошибка при открытии файла ".$filename." </strong><br>");
    // Читаем файл в переменную
    $tmp= $this->SetSql( fread( $fd, filesize( $this->FSqlFile ) ) );
    // Закрываем файл и возвращаем техт
    fclose( $fd );
    $this->FD->_log('db->SetSqlFromFile_');
    return $tmp;
  }
  //============================================================================
  /** @ASql - sql-text */
  function SetSql( $ASql='' )
  {
    $this->FD->_log('db->SetSql',1);
    $this->FD->_log($ASql);
    if ($ASql!='')
      $this->FSqlText=$ASql;
    $this->FD->_log('db->SetSql_');
    return $this->FSqlText;
  }
  //============================================================================
  /** Set range of sql-query
    @ALowBound,@AHighBound - bounds of sql-query
  */
  function SetRange( $ALowBound,$AHighBound )
  {
    $this->FLowBound=$ALowBound;
    $this->FHighBound=$AHighBound;
  }
  //============================================================================
  /** Set range of sql-query by pages
    @APageNumb - page number
    @ARowsPerPage - rows per page
  */
  function SetRangeByPage( $APageNumb,$ARowsPerPage )
  {
    $this->FPageNumber=$APageNumb;
    $this->FRowPerPage=$ARowsPerPage;
    $this->SetRange($APageNumb*$ARowsPerPage+1-$ARowsPerPage,$APageNumb*$ARowsPerPage);
  }
  //============================================================================
  /** Get ranged navigation of current sql-query
    @ALinkFormat - link for page;
    @ADetNavigationFormat,@ADetNavigationFormatSelected - formats for output
      detailed navigation :
        {BEGIN_NUM} - insert first number in period
        {END_NUM} - insert last number in period
        {PAGE_NUM} - insert page number
    @AArrCaptions=array('FIRST'=>to_first_page,'LAST'=>to_last_page,
      'PREVIOUS'=>to_previous_page,'NEXT'=>to_next_page)
  */
  function GetRangedNavigation(
    $ALinkFormatAdd=array(0=>'<a href="link?page={PAGE_NUM}">{PAGE_CAPTION}</a>','{PAGE_CAPTION}'),
    $ALinkFormatDet=array(0=>'<a href="link?page={PAGE_NUM}">[{BEGIN_NUM}..{END_NUM}]</a>','[{BEGIN_NUM}..{END_NUM}]'),
    $AArrCaptionAdd=array('FIRST'=>'[Первая]','LAST'=>'[Последняя]','PREVIOUS'=>'[Предыдущая]','NEXT'=>'[Следущая]')
    )
  {
    $this->FD->_logf('db->GetRangedNavigation(%s,%s,%s)',array($ALinkFormatAdd,$ALinkFormatDet,$AArrCaptionAdd),1);
    //initialize some params
    $tmp=$this->SetSql();
    $arr=$this->GetArray($this->GetSql(),false);
    $row_count=count($arr);
    $this->SetSql($tmp);
    $full_page_count=(int)($row_count/$this->FRowPerPage);//кол-во полных страниц
    $row_last_page=$row_count-($full_page_count*$this->FRowPerPage);//кол-во записей на последней странице
	$page_count= $row_last_page==0 ? $full_page_count : $full_page_count+1;//кол-во страниц для вывода
    //get addition navigation
    $this->FD->_log('get addition navigation');

    $LinkFormatKey= $this->FPageNumber != 1 ? 0 : 1;//линк или просто надпись для первых кнопок
    $res_first=$this->FormatStr($ALinkFormatAdd[$LinkFormatKey],1,$AArrCaptionAdd['FIRST'],0,0);//первая
    $res_previous=$this->FormatStr($ALinkFormatAdd[$LinkFormatKey],
      $this->FPageNumber-1,$AArrCaptionAdd['PREVIOUS'],0,0);//предыдущая

    $LinkFormatKey= $this->FPageNumber != $page_count ? 0 : 1; //линк или просто надпись для последних кнопок
    $res_last=$this->FormatStr($ALinkFormatAdd[$LinkFormatKey],
      $page_count,$AArrCaptionAdd['LAST'],0,0);//последняя
    $res_next=$this->FormatStr($ALinkFormatAdd[$LinkFormatKey],
      $this->FPageNumber+1,$AArrCaptionAdd['NEXT'],0,0);//следующая
    //get detailed navigation
    $this->FD->_log('get detailed navigation');
    for ( $i=1,$prevbtn=0; $full_page_count>=$i ; $i++,$prevbtn+=$this->FRowPerPage )
    {
      $LinkFormatKey= $i != $this->FPageNumber ? 0 : 1;
      $res_det[]=$this->FormatStr($ALinkFormatDet[$LinkFormatKey],$i,'',$prevbtn+1,$prevbtn+$this->FRowPerPage);
    }
    if($page_count!=$full_page_count)
    {
      $LinkFormatKey= $page_count != $this->FPageNumber ? 0 : 1;
      $res_det[]=$this->FormatStr($ALinkFormatDet[$LinkFormatKey],$i,'',$prevbtn+1,$row_count);
    }
    $this->FD->_log('db->GetRangedNavigation_');
    return $res_first.$res_previous.implode(' ',$res_det).$res_next.$res_last;
  }
  //============================================================================
  function FormatStr($AStrFormat,$APageNum,$APageCaption,$ABeginNum,$AEndNum)
  {
     $str=str_replace('{PAGE_NUM}',$APageNum,$AStrFormat);
     $str=str_replace('{PAGE_CAPTION}',$APageCaption,$str);
     $str=str_replace('{BEGIN_NUM}',$ABeginNum,$str);
     $str=str_replace('{END_NUM}',$AEndNum,$str);
     $this->FD->_log($AStrFormat.'->'.$str);
     return $str;
  }
  //============================================================================
  /** Execute sql */
  function GoSql($ASql='')
  {
    /* some code */
  }
  //============================================================================
  /** function get array of query-result
    @ASql - sql-query if not SetSql
    @ASql - if $AOverrideSql==false then function not change main sql
    @return = array( row_number=> array( field_name1=>value1,field_name2=>value2 ) )
  */
  function GetArray($ASql='')
  {
    /* some code */
  }
  //============================================================================
  /** function return value of service sql-query not override main sql
    @ASql - sql-query
    @AReturnType - case of
      'ALL': return row-array
      'FIRST' or '': return value of first field from query
  */
  function GetValues($ASql,$AReturnType='FIRST')
  {
    $this->FD->_logf('db->GetValues(%s)',array($ASql),1);
    $arr=$this->GetArray($ASql);
    $AReturnType=strtoupper($AReturnType);
    switch($AReturnType):
      case '':case 'FIRST':
        $k_arr=array_keys($arr[0]);
        return $arr[0][$k_arr[0]];
      break;
      case 'ALL':
        return $arr[0];
      break;
    endswitch;
    $this->FD->_log('db->GetValues_');
  }

  //============================================================================
  /** function get formated text of query-result
    @AFormatText - text with marks of fields // {FIELDNAME}
  */
  function GetFormatQuery( $AFormatText,$AReturn=null )
  {
    $this->FD->_logf('db->GetFormatQuery(%s,%s)',array(htmlentities($AFormatText),$AReturn),1);
    $this->GetArray();
    $l_res='';
    //$this->FD->_log($this->FArraySql[0]);
    $l_keys=array_keys($this->FArraySql[0]);
    $this->FD->_log($l_keys);
    foreach($this->FArraySql as $l_record)
    {
      //$this->FD->_log($p++);$this->FD->_log($l_record);
      $l_str=$AFormatText;
      foreach($l_keys as $l_key)
        if( strpos(  $l_str, '{'.strtoupper ( $l_key ).'}'  )!==false )
          $l_str=str_replace('{'.strtoupper ( $l_key ).'}',$l_record[$l_key] , $l_str);
      $l_res.=$l_str.'
      ';
    }
    $this->FD->_log('db->GetFormatQuery_');
    if($AReturn)
      return $l_res;
    else
      echo $l_res;
  }
  //============================================================================
  /** Function is insert if new row and update if row not exists
    @ATable - table name;
    @AArrFields - array( 0=>field_name1,field_name2, ... );
    @AArrValues - array( 0=>field_value1,field_value2, ... );
    @APKField - key_field_name;
    @APKValue - key_field_value.
  */
  function InsOrUpd( $ATable,$AArrFields,$AArrValues,$APKField='',$APKValue='' )
  {
    $this->FD->_logf('db->InsOrUpd(%s,%s,%s,%s,%s)',array($ATable,$AArrFields,$AArrValues,$APKField,$APKValue));
    if($this->IsRowExist( $ATable,$APKField,$APKValue ) )
      $this->Update($ATable,$AArrFields,$AArrValues,$APKField,$APKValue);
    else
      $this->Insert($ATable,$AArrFields,$AArrValues);
    $this->FD->_log('db->InsOrUpd_');
  }
  //============================================================================
  /** Testign for existing row in a @ATable
    @ATable - table name;
    @AField,@AValue - key-field name and value
  */
  function IsRowExist( $ATable,$AField,$AValue )
  {
    $this->FD->_logf( 'db->IsRowExist(%s,%s,%s)', array($ATable,$AField,$AValue),1 );
    if($AField!='' and $AValue!='')
    {
      $sql=sprintf ( 'select count(*) CNT from %s where %s="%s" ', $ATable, $AField, $AValue );
      $res= $this->GetValues($sql)==0 ? false : true;
/*      $arr=$this->GetArray($sql,false);
      $this->FD->_log($arr[0]['CNT']);
      $res= $arr[0]['CNT']==0 ? false : true;*/
    }
    else
      $res= false;
    $this->FD->_log('db->IsRowExist_='.$res);
    return $res;
  }
  //============================================================================
  /** Insert row into table
    @ATable - table name
    @AArrFields - array( 0=>field_name1,field_name2, ... );
    @AArrValues - array( 0=>field_value1,field_value2, ... );
  */
  function Insert( $ATable,$AArrFields,$AArrValues )
  {
    $this->FD->_logf('db->Insert(%s,%s,%s)',array($ATable,$AArrFields,$AArrValues),1);
    $tmp_val=implode($this->FTmp_sep,$AArrValues);
    $tmp_val=str_replace('"','&quot;',$tmp_val);
    $AArrValues=explode($this->FTmp_sep,$tmp_val);
    $val=implode('","',$AArrValues);
    $val='"'.$val.'"';
    $sql=sprintf ('insert into %s(%s) values (%s)',$ATable,implode(',',$AArrFields), $val);
    $this->FD->_log($sql);
    $this->GoSql($sql);
    $this->FD->_log('db->Insert_');
  }
  //============================================================================
  /** Update row in a table
    @ATable - table name;
    @AArrFields - array( 0=>field_name1,field_name2, ... );
    @AArrValues - array( 0=>field_value1,field_value2, ... );
    @APKField - key_field_name;
    @APKValue - key_field_value.
  */
  function Update( $ATable,$AArrFields,$AArrValues,$APKField,$APKValue )
  {
    $this->FD->_logf('db->Update(%s,%s,%s,%s,%s)',array($ATable,$AArrFields,$AArrValues,$APKField,$APKValue),1);
    $tmp_val=implode($this->FTmp_sep,$AArrValues);
    $tmp_val=str_replace('"','&quot;',$tmp_val);
    $AArrValues=explode($this->FTmp_sep,$tmp_val);
    $sql=sprintf ( 'update %s set ', $ATable );
    $koma='';
    for( $i=0; isset($AArrFields[$i]) ; $i++ )
    {
      $sql.=$koma.sprintf( ' %s="%s" ', $AArrFields[$i], $AArrValues[$i] );
      $koma=',';
    }
    $sql.=sprintf ( ' where %s="%s" ', $APKField, $APKValue );
    $this->GoSql( $sql );
    $this->FD->_log('db->Update_');
  }
  //============================================================================
  /** Delete row from table
    @ATable - table name;
    @APKField - key_field_name;
    @APKValue - key_field_value.
  */
  function Delete( $ATable,$APKField,$APKValue )
  {
    $this->FD->_logf('db->Delete(%s,%s,%s)',array($ATable,$APKField,$APKValue),1);
    $sql=sprintf ( 'delete from %s', $ATable );
    $sql.=sprintf ( ' where %s="%s" ', $APKField, $APKValue );
    $this->GoSql( $sql );
    $this->FD->_log('db->Delete_');
  }

  //============================================================================
  /** Addon of function @InsOrUpd what get params for edit from user form
    @ATable - table name;
    @AArrFormFields - array( 0=>form's_input_name1,form's_input_name2,... );
    @APKField - key_field_name;
    @APKValue - key_field_value.
  */
  function InsOrUpdByForm( $ATable,$AArrFormFields,$APKField='',$APKValue='' )
  {
    $this->FD->_logf('db->InsOrUpdByForm(%s,%s,%s,%s)',array($ATable,$AArrFormFields,$APKField,$APKValue),1);
    $this->GetFieldValueArraysByForm($AArrFormFields,$arrFields,$arrValues);
    $this->InsOrUpd( $ATable,$arrFields,$arrValues,$APKField,$APKValue );
    $this->FD->_log('db->InsOrUpdByForm_');
  }
  //================================================================================
  /** Get params for edit from user form
    @AArrFormFields - array( 0=>name_input_element1,name_input_element2,... );
    @AArrFields - array( 0=>field_name1,field_name2, ... );
    @AArrValues - array( 0=>field_value1,field_value2, ... );
  */
  function GetFieldValueArraysByForm($AArrFormFields,&$AArrFields,&$AArrValues)
  {
    $this->FD->_logf('db->GetFieldValueArraysByForm(%s,%s,%s)',array($AArrFormFields,&$AArrFields,&$AArrValues),1);
    $IsFirst='Y';
    //$this->FD->_log($AArrFormFields);
    //$this->FD->_log($_POST);
    foreach($AArrFormFields as $FormField)
    {
      //$this->FD->_log($FormField);
      if(GetVal($FormField)!='')
      {
       //$this->FD->_log(GetVal($FormField));
        if($IsFirst=='Y')
        {
          $AArrFields[0]=$FormField;
          $AArrValues[0]=GetVal($FormField);
          $IsFirst='N';
        }
        else
        {
          $AArrFields[]=$FormField;
          $AArrValues[]=GetVal($FormField);
        }
      }
    }
    //$this->FD->_log($AArrFields);
    //$this->FD->_log($AArrValues);
    $this->FD->_log('db->GetFieldValueArraysByForm_');
  }
  function SetWhere( $AWhere )
  {
    $this->FD->_logf('db->SetWhere(%s)',array($AWhere),1);
    $this->FSqlWhere=' '.$AWhere.' ';
    $this->FD->_log('db->SetWhere_');
  }
  function SetOrder( $AOrder )
  {
    $this->FD->_logf('db->SetOrder(%s)',array($AOrder),1);
    $this->FSqlOrder=' '.$AOrder.' ';
    $this->FD->_log('db->SetOrder_');
  }
  function GetFullSql()
  {
    $this->FD->_log('db->GetFullSql',1);
    $sql=$this->FSqlText.$this->FSqlWhere.$this->FSqlOrder;
    $this->FD->_log($sql);
    $this->FD->_log('db->GetFullSql_');
    return $sql;
  }
  function GetSql()
  {
    $this->FD->_log('db->GetSql',1);
    $sql=$this->FSqlText.$this->FSqlWhere.$this->FSqlOrder;
    $this->FD->_log($sql);
    $this->FD->_log('db->GetSql_');
    return $sql;
  }
}
?>