<?php
/*
*二叉搜索树
*左子树节点值小于根节点
*右子树节点值大于根节点
*/

ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

require_once('base.php');

/**
*二叉搜索树
*/
class binarySearchTree 
{
	protected $root;	//根节点

	public function __construct($root)
	{
		$this->root = $root;
	}

	//寻找最大值
	public function findMax()
	{
		$tmpNode = $this->root;
		while (!empty($tmpNode->right)) {
			$tmpNode = $tmpNode->right;
		}
		return $tmpNode->value;
	}

	//寻找最小值
	public function findMin()
	{
		$tmpNode = $this->root;
		while (!empty($tmpNode->left)) {
			$tmpNode = $tmpNode->left;
		}
		return $tmpNode->value;
	}

	//查找
	public function search($value)
	{
		$tmpNode = $this->root;
		while (!(empty($tmpNode))) {
			if ($tmpNode->value == $value) {
				return $tmpNode;
			} else if ($tmpNode->value < $value) {
				$tmpNode = $tmpNode->right;
			} else {
				$tmpNode = $tmpNode->left;
			}
		}
		return false;
	}

	//插入
	public function insert($value)
	{
		if ($this->search($value)) {
			exit('已存在');
			return ;
		}
		$tmpNode = $this->root;
		$newNode = new node($value, null, null);
		while (!empty($tmpNode)) {
			if ($tmpNode->value < $value) {
				if (empty($tmpNode->right)) {
					$tmpNode->right = $newNode;
					return ;
				}
				$tmpNode = $tmpNode->right;
			} else {
				if (empty($tmpNode->left)) {
					$tmpNode->left = $newNode;
					return ;
				}
				$tmpNode = $tmpNode->left;
			}
		}
	}

	//寻找前驱节点
	public function findPreNode($node)
	{
		if (!$this->search($node->value)) {
			exit('无此节点');
			return ;
		}
		$tmpNode = $this->root;
		if ($tmpNode->value == $node->value) {	//为根节点
			return null;
		}
		while (!empty($tmpNode)) {
			if ($tmpNode->value < $node->value) {
				if ($tmpNode->right->value == $node->value) {
					return $tmpNode;
				}
				$tmpNode = $tmpNode->right;
			} else {
				if ($tmpNode->left->value == $node->value) {
					return $tmpNode;
				}
				$tmpNode = $tmpNode->left;
			}
		}
	}

	//删除
	public function delete($value)
	{
		if ($node = $this->search($value)) {
			if (empty($node->left) and empty($node->right)) {	//删除节点为叶子节点
				$preNode = $this->findPreNode($node);
				if (empty($preNode)) {	//如果为根节点
					$this->root = null;
				}
				if ($preNode->value < $value) {		//判断其位于前驱节点的左节点还是右节点
					$preNode->right = null;
				} else {
					$preNode->left = null;
				}
			} else if (!empty($node->left) and !empty($node->right)) {	//删除节点左右子树都非空
				$leftNode = $node->right;								//将删除节点和其右子树的最左节点交换后再删除
				while (!empty($leftNode->left)) {
					$leftNode = $leftNode->left;		//找出右子树的最做节点
				}
				$tmpValue = $leftNode->value;
				$this->delete($tmpValue);	//删除掉需删除节点的右子树的最左节点
				$node->value = $tmpValue;	//将原需删除节点的值修改为其右子树最左节点的值
			} else {							//左右子树有一个不为空
				$preNode = $this->findPreNode($node);	//将其前驱节点原本指向其的指针指向其子节点
				if (empty($preNode)) {
					$this->root = empty($node->right)?$node->left:$node->right;
				}
				if ($preNode->value < $value) {
					$preNode->right = empty($node->right)?$node->left:$node->right;
				} else {
					$preNode->left = empty($node->right)?$node->left:$node->right;
				}
			}
		} else {
			exit('不存在');
			return ;
		}
	}
}


