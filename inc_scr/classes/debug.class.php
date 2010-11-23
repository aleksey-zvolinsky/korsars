<?
/******************************************************************************\
  Class debug
  About : class for output logs
  Author: frendos
\******************************************************************************/
class debug{

  var $FIsDebug;// 0-no,1-yes
  var $FLogPos;//

  //============================================================================
  /** constructor */
  function debug( $AIsDebug=1,$ALogPos=0 )
  {
    $this->FIsDebug=$AIsDebug;
    $this->FLogPos=$ALogPos;
  }
  //============================================================================
  /** Create debuggibg info
    @AOut - mixed or array value
  */
  function _log( $AOut, $APos=0 )
  {
   // $IsDebug=true;
    //echo $this->IsDebug();
    if( !is_array( $AOut ) )
      if(substr($AOut,-1,1)=='_')
        $this->FLogPos--;
    if($this->FIsDebug==1)
    {
      ?><font color=green><?
      echo date('Y.m.d H:i:s').' '.str_repeat('&nbsp;&nbsp;',$this->FLogPos);
      if (is_array($AOut))
        echo nl2br(print_r($AOut,true));
      else
        echo $AOut;
       ?></font><br><?
    }
    if( !is_array( $AOut ) )
      if(substr($AOut,-1,1)!='_')
        $this->FLogPos+=$APos;
  }
  //============================================================================
  function _logf( $AOut,$AArr=Array(),$APos=0 )
  {
    $AOut=@vsprintf($AOut,$AArr);
    $this->_log($AOut,$APos);
  }
}
?>
