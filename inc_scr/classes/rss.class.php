<?
/*
example of RSS-file

<?xml version="1.0"?>
<rss version="2.0.1">
  <channel>
    <title>Liftoff News</title>
    <link>http://liftoff.msfc.nasa.gov/</link>
    <description>Liftoff to Space Exploration.</description>
    <language>en-us</language>
    <pubDate>Tue, 10 Jun 2003 04:00:00 GMT</pubDate>
    <icon>http://liftoff.msfc.nasa.gov/icon.gif</icon>

    <lastBuildDate>Tue, 10 Jun 2003 09:41:01 GMT</lastBuildDate>
    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
    <generator>Weblog Editor 2.0</generator>
    <managingEditor>editor@example.com</managingEditor>
    <webMaster>webmaster@example.com</webMaster>

    <item>
      <title>Star City</title>
      <link>http://liftoff.msfc.nasa.gov/news/2003/news-starcity.asp</link>
      <description>How do Americans get ready to work with Russians aboard the
        International Space Station? They take a crash course in culture, language
        and protocol at Russia's Star City.</description>
      <pubDate>Tue, 03 Jun 2003 09:39:21 GMT</pubDate>
      <guid>http://liftoff.msfc.nasa.gov/2003/06/03.html#item573</guid>
    </item>

    <item>
      <title>Astronauts' Dirty Laundry</title>
      <link>http://liftoff.msfc.nasa.gov/news/2003/news-laundry.asp</link>
      <description>Compared to earlier spacecraft, the International Space
        Station has many luxuries, but laundry facilities are not one of them.
        Instead, astronauts have other options.</description>
      <pubDate>Tue, 20 May 2003 08:56:02 GMT</pubDate>
      <guid>http://liftoff.msfc.nasa.gov/2003/05/20.html#item570</guid>
    </item>
  </channel>
</rss>
*/

/*******************************************************************************
  Class rss
  About : class edit rss-feeds
  Author: frendos
*******************************************************************************/
//require(DataDir.'classes/debug.class.php');

class rss
{
  //debug
  var $FD;//copy of debug class
  //xml
  var $FHeader; // header of RSS-file
  var $FContent; // content of RSS-file
  var $FFooter; // footer of RSS-file
  var $FAll; // all RSS-file in string
  var $FArrAll; // all RSS-file in array
  var $FExport; // path to RSS-file
  var $FExportTmp; //tmp
  var $FExportContent; // content of RSS-file
  //var $FMaxRecords=10;
  var $FItemKeys=array('TITLE','LINK','DESCRIPTION','PUBDATE','AUTHOR');
  var $FItem=array('TITLE'=>'','LINK'=>'','DESCRIPTION'=>'','PUBDATE'=>'','AUTHOR'=>'');
  var $FItemCount=-1;

  //============================================================================
  /** constructor
    @AExportFile path to RSS-file
  */
  function rss( $AExportFile, $AIsDebug=0 )
  {
    $this->FD=new debug($AIsDebug);
    $this->FD->_log('create rss class');
    $this->FExport=$AExportFile;
    // Read file
    $this->FArrAll = file($this->FExport);
    //$this->FD->_log($this->FArrAll);
    $this->FAll= implode('',$this->FArrAll);
    // Devide file for part
    $part='header';
    foreach($this->FArrAll as $str)
    {

      if(($part=='header')&&(strpos(strtoupper($str),'<ITEM>')!==false))
        $part='content';
      elseif(($part=='content')&&(strpos(strtoupper($str),'</CHANNEL>')!==false))
        $part='footer';
      $this->FD->_log($part);
      $this->FD->_log(htmlentities($str));
      switch($part)
      {
        case 'header': $this->FHeader[]=$str;  break;
        case 'content': $this->FContent[]=$str;  break;
        case 'footer': $this->FFooter[]=$str;  break;
      }
    }
    $this->FD->_log($this->FHeader);
    $this->FD->_log($this->FContent);
    $this->FD->_log($this->FFooter);
  }
  //============================================================================
  /** Append item to begin of RSS-file
    @AItem - array like array('TITLE'=>'','LINK'=>'','DESCRIPTION'=>'','PUBDATE'=>'','AUTHOR'=>'')
    @AWithKeys - array with key or not
  */
  function PushItem( $AItem,$AWithKeys=true )
  {
    $this->FItemCount=-1;
    if($AWithKeys==true)
      $this->FItem=$AItem;
    else
      $this->FItem = array_combine($this->FItemKeys, $AItem);
    $date=$this->FItem['PUBDATE']=='' ? date("r") : $this->FItem['PUBDATE'];
    array_unshift(
      $this->FContent,
      "    <item>\n",
      "      <title>".$this->FItem['TITLE']."</title>\n",
      "      <link>".$this->FItem['LINK']."</link>\n",
      "      <guid>".$this->FItem['LINK']."</guid>\n",
      "      <description>".$this->FItem['DESCRIPTION']."</description>\n",
      "      <pubDate>".$date."</pubDate>\n",
      "      <author>".$this->FItem['AUTHOR']."</author>\n",
      "    </item>\n"
      );
  }
  //============================================================================
  /** Delete item from end of RSS-file */
  function PopItem()
  {
    $this->FItemCount=-1;
    if($AWithKeys==true)
      $FItem=$AItem;
    else
      $FItem = array_combine($FItemKeys, $AItem);
    foreach($this->FContent as $str)
    {
      $i++;
      if(strpos($str,'<item>')!==false)
        $last=$i;
    }
    array_slice($this->FContent,$last);
  }
  //============================================================================
  /** Get count of items in a file */
  function ItemCount()
  {
    if($this->FItemCount==-1)
    {
      $this->FItemCount=0;
      foreach($this->FContent as $str)
        if(strpos($str,'<item>')!==false)
          $this->FItemCount++;
    }
    return $this->FItemCount;
  }
  //============================================================================
  /** clear RSS-file, delete old
    @AMaxRecords - count of records what must be leave in RSS-file
  */
  function ClearItems( $AMaxRecords )
  {
    $this->FItemCount=-1;
    $MustDie=$this->ItemCount()-$AMaxRecords;
    for($i=0;$i<$MustDie;$i++)
      $this->PopItem();
  }
  //============================================================================
  /** create RSS-file
    @TmpFile - temporary file for writing RSS-file
  */
  function GetRss( $ATmpFile='' )
  {
    $this->FD->_log('GetRss',1);
    if($ATmpFile=='')
    {
      $rnd = rand(0, 1000);
      $this->FExportTmp = $this->FExport.$rnd;
    }
    else
      $this->FExportTmp = $ATmpFile;
    // Собираем ленту
    $rss_document = array_merge(
      $this->FHeader,
      $this->FContent,
      $this->FFooter
      );
    $fp = fopen($this->FExportTmp, "w");
    foreach($rss_document as $rss_document_line)
      fwrite($fp, $rss_document_line);
    fclose($fp);
    rename($this->FExportTmp, $this->FExport);
    $this->FD->_log('GetRss_');
  }

}
?>
