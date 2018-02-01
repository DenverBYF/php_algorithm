<?php

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





