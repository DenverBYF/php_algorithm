<?php
/**
 * Created by PhpStorm.
 * User: denverb
 * Date: 18/2/11
 * Time: 上午10:27
 * 剑指offer的PHP实现
 */


/*
* 在一个二维数组中，每一行都按照从左到右递增的顺序排序，
* 每一列都按照从上到下递增的顺序排序。请完成一个函数，输入这样的一个二维数组和一个整数，判断数组中是否含有该整数。
*/
function Find($target, $array)
{
	$columns = count($array[0]);	//列数
	$line = count($array);		//行数
	$tmp = $array[$line - 1][$columns - 1];
	if ($target < $array[0][0] or $target > $array[$line - 1][$columns - 1]) {
		return false;
	}
	$cStart = 0;
	$lStart = $line - 1;
	while ($cStart < $columns and $lStart > -1){
		$tmp = $array[$lStart][$cStart];
		if ($tmp > $target) {
			$lStart = $lStart - 1;
		} elseif ($tmp < $target) {
			$cStart = $cStart + 1;
		} else {
			return true;
		}
	}
	return false;
}


/*
 * 请实现一个函数，将一个字符串中的空格替换成“%20”。例如，当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy。
 * */
function replaceSpace($str)
{
	return str_replace(' ', '%20', $str);
}


/*
 * 输入一个链表，从尾到头打印链表每个节点的值。
 * */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function printListFromTailToHead($head)
{
	//
	$ret = [];
	if (empty($head)) {
		return $ret;
	}
	while (!empty($head)) {
		$ret[] = $head->val;
		$head = $head->next;
	}
	return array_reverse($ret);
}


/*
 * 输入某二叉树的前序遍历和中序遍历的结果，请重建出该二叉树。假设输入的前序遍历和中序遍历的结果中都不含重复的数字。
 * 例如输入前序遍历序列{1,2,4,7,3,5,6,8}和中序遍历序列{4,7,2,1,5,3,8,6}，则重建二叉树并返回。
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function reConstructBinaryTree($pre, $vin)
{
	//
	return buildTree($pre, $vin, 0, count($pre) - 1, 0, count($vin) - 1);
}
function buildTree($pre, $vin, $pStart, $pEnd, $vStart, $vEnd)
{
	if ($pStart > $pEnd || $vStart > $vEnd) {
		return ;
	}
	$root = new TreeNode($pre[$pStart]);
	$rootIndex = array_keys($vin, $root->val)[0];	//跟节点在中序遍历中的位置
	$leftLen = $rootIndex - $vStart;	//左子树长度
	$root->left = buildTree($pre, $vin, $pStart+ 1, $pStart + $leftLen, $vStart, $rootIndex - 1);	//构建左子树
	$root->right = buildTree($pre, $vin, $pStart + $leftLen + 1, $pEnd, $rootIndex + 1, $vEnd);		//构建右子树
	return $root;
}


/*
 * 用两个栈来实现一个队列，完成队列的Push和Pop操作。 队列中的元素为int类型。
 * */
$arr1 = [];
$arr2 = [];
function mypush($node)
{
	// write code here
	global $arr1, $arr2;
	array_push($arr1, $node);
}
function mypop()
{
	// write code here
	global $arr1, $arr2;
	if (!empty($arr2)) {
		return array_pop($arr2);
	} else {
		while (!empty($arr1)) {
			array_push($arr2, array_pop($arr1));
		}
		return array_pop($arr2);
	}
}


/*
 * 把一个数组最开始的若干个元素搬到数组的末尾，我们称之为数组的旋转。
 * 输入一个非递减排序的数组的一个旋转，输出旋转数组的最小元素。
 * 例如数组{3,4,5,1,2}为{1,2,3,4,5}的一个旋转，该数组的最小值为1。
 * NOTE：给出的所有元素都大于0，若数组大小为0，请返回0。
 * */
function minNumberInRotateArray($rotateArray)
{
	// write code here
}


/*
 * 大家都知道斐波那契数列，现在要求输入一个整数n，请你输出斐波那契数列的第n项。n<=39
 * */
function Fibonacci($n)
{
	$ret = [];
	$ret[0] = 0;
	$ret[1] = 1;
	for ($i = 2; $i < $n + 1 ; $i++) {
		$ret[] = $ret[$i - 1] + $ret[$i - 2];
	}
	return $ret[$n];
}


/*
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级。求该青蛙跳上一个n级的台阶总共有多少种跳法。
 * */
function jumpFloor($number)
{
	return Fib($number);
}
function Fib($n)
{
	$ret = [];
	$ret[0] = 0;
	$ret[1] = 1;
	$ret[2] = 2;
	for ($i = 3; $i < $n + 1; $i++) {
		$ret[] = $ret[$i - 1] + $ret[$i - 2];
	}
	return $ret[$n];
}


/*
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级……它也可以跳上n级。求该青蛙跳上一个n级的台阶总共有多少种跳法。
 * */
function jumpFloorII($number)
{
	if ($number == 0) {
		return 0;
	}
	if ($number == 1) {
		return 1;
	}
	if ($number > 1) {
		return 2*jumpFloorII($number - 1);
	}
}


/*
 * 我们可以用2*1的小矩形横着或者竖着去覆盖更大的矩形。请问用n个2*1的小矩形无重叠地覆盖一个2*n的大矩形，总共有多少种方法？
 * */
function rectCover($number)
{
	// write code here
	return Fib2($number);
}
function Fib2($number) {
	$ret = [];
	$ret[0] = 0;
	$ret[1] = 1;
	$ret[2] = 2;
	for ($i = 3; $i < $number + 1; $i++) {
		$ret[] = $ret[$i - 1] + $ret[$i - 2];
	}
	return $ret[$number];
}


/*
 * 输入一个整数，输出该数二进制表示中1的个数。其中负数用补码表示。
 * */
function NumberOf1($n)
{
	// write code here
	$count = 0;
	if($n < 0){ // 处理负数
		$n = $n&0x7FFFFFFF;
		++$count;
	}
	while($n != 0){
		$count++;
		$n = $n & ($n-1);
	}
	return $count;
}