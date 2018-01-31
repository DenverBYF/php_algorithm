<?php

ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

/**
*二叉树节点
*/
class node
{
	public $value, $left, $right;
	function __construct($value, $left, $right)
	{
		$this->value = $value;
		$this->left = $left;
		$this->right = $right;
	}
}

/**
*三种遍历方法
*/
class sort 
{
	protected $root;
	function __construct(node $root)
	{
		$this->root = $root;
	}

	//先序	跟节点->左子树->右子树
	public function sort1()
	{	
		$stack = [];
		array_push($stack, $this->root);
		while (!empty($stack)) {
			$node = array_pop($stack);
			echo($node->value);
			if (!empty($node->right)) {	//先压入右子树
				array_push($stack, $node->right);
			} 
			if (!empty($node->left)) {	//后压入左子树
				array_push($stack, $node->left);
			}
		}
	}

	//中序	左子树->跟节点->右子树
	public function sort2()
	{
		$stack = [];
		$node = $this->root;
		while (!empty($stack) or !empty($node)) {	//栈不为空或者当前根节点不为空
			while (!empty($node)) {		//压入当前跟节点的所有左子树节点
				array_push($stack, $node);
				$node = $node->left;
			}
			$node = array_pop($stack);
			echo($node->value);
			$node = $node->right;	//进入当前节点的右子树
		}
	}

	//后序	左子树->右子树->跟节点
	public function sort3()
	{
		$stack = [];
		$retStack = [];	//输出栈
		array_push($stack, $this->root);
		while (!empty($stack)) {
			$node = array_pop($stack);
			array_push($retStack, $node);
			if (!empty($node->left)) {
				array_push($stack, $node->left);
			}
			if (!empty($node->right)) {
				array_push($stack, $node->right);
			}
		}
		while (!empty($retStack)) {
			echo(array_pop($retStack)->value);
		}
	}
}



$g = new node(4, null, null);
$h = new node(7, null, null);
$d = new node(3, $g, null);
$e = new node(5, $h, null);
$b = new node(1, $d, $e);
$f = new node(6, null, null);
$c = new node(2, $f, null);
$a = new node(0, $b, $c);

$sort = new sort($a);
echo "先序遍历: ";
$sort->sort1();
echo "<br> 中序遍历: ";
$sort->sort2();
echo "<br> 后序遍历: ";
$sort->sort3();



