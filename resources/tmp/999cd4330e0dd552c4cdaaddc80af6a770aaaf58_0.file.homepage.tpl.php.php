<?php
/* Smarty version 3.1.33, created on 2019-10-20 22:23:27
  from '/home/mohammed/personal_projects/E-store/E-mall/resources/views/homepage.tpl.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dacb42f863ef5_00080452',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '999cd4330e0dd552c4cdaaddc80af6a770aaaf58' => 
    array (
      0 => '/home/mohammed/personal_projects/E-store/E-mall/resources/views/homepage.tpl.php',
      1 => 1571599405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dacb42f863ef5_00080452 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9884103645dacb42f8622d3_60648145', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/base.tpl.php");
}
/* {block "content"} */
class Block_9884103645dacb42f8622d3_60648145 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9884103645dacb42f8622d3_60648145',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <h1>Welcome to the homepage</h1>
<?php
}
}
/* {/block "content"} */
}
