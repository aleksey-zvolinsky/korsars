<?php /* Smarty version 2.6.14, created on 2006-10-04 16:58:15
         compiled from news.tpl */ ?>
<table border="1" width="100%">
<?php $_from = $this->_tpl_vars['NewsItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['NewsItem']):
        $this->_foreach['Outer']['iteration']++;
?>
  <tr>
    <td width="140px">
      <?php echo $this->_tpl_vars['NewsItem']['date']; ?>

    </td>
    <td>
      <?php echo $this->_tpl_vars['NewsItem']['text']; ?>

    </td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
  <tr>
    <td align="center" colspan="2">
      <?php echo $this->_tpl_vars['Navigation']; ?>

    </td>
  </tr>
</table>