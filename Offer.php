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
	$low = 0;
	$high = count($rotateArray) - 1;
	while ($low < $high) {
		$mid = intval(($low + $high) / 2);
		if ($high - $low == 1) {
			return $rotateArray[$high];
		}
		if ($rotateArray[$mid] >= $rotateArray[$low]) {
			$low = $mid;
		} elseif ($rotateArray[$mid] <= $rotateArray[$high]) {
			$high = $mid;
		}
	}
	return 0;
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


/*
 * 给定一个double类型的浮点数base和int类型的整数exponent。求base的exponent次方。
 * */
function Power($base, $exponent)
{
	// write code here
	return pow($base, $exponent);
}


/*
 * 输入一个整数数组，实现一个函数来调整该数组中数字的顺序，
 * 使得所有的奇数位于数组的前半部分，所有的偶数位于位于数组的后半部分，
 * 并保证奇数和奇数，偶数和偶数之间的相对位置不变。
 * */
function reOrderArray($array)
{
	// write code here
	$a1 = [];
	$a2 = [];
	foreach ($array as $item) {
		if ($item % 2 == 0) {
			$a1[] = $item;
		} else {
			$a2[] = $item;
		}
	}
	return array_merge($a2, $a1);
}


/*
 * 输入一个链表，输出该链表中倒数第k个结点。
 * 注:两个指针进行遍历,第一个到达k时,第二个开始。
 * */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function FindKthToTail($head, $k)
{
	// write code here
	if ($k == 0) {
		return [];
	}
	$c = 0;
	$node1 = $head;
	$node2 = $head;
	while (!empty($node1->next)) {
		$c += 1;
		$node1 = $node1->next;
		if ($c >= $k) {
			$node2 = $node2->next;
		}
	}
	if ($k > $c + 1) {
		return [];
	}
	return $node2;
}


/*
 * 输入一个链表，反转链表后，输出链表的所有元素。
 * */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function ReverseList($pHead)
{
	// write code here
	$pre = null;
	$next = null;
	$node = $pHead;
	while (!empty($node)) {
		$next = $node->next;
		$node->next = $pre;
		$pre = $node;
		$node = $next;
	}
	return $pre;
}


/*
 * 输入两个单调递增的链表，输出两个链表合成后的链表，当然我们需要合成后的链表满足单调不减规则。
 * */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function Merge($pHead1, $pHead2)
{
	// write code here
	if (empty($pHead1)) {
		return $pHead2;
	}
	if (empty($pHead2)) {
		return $pHead1;
	}
	if ($pHead1->val < $pHead2->val) {
		$head = $pHead1;
		$head->next = Merge($pHead1->next, $pHead2);
	} else {
		$head = $pHead2;
		$head->next = Merge($pHead1, $pHead2->next);
	}
	return $head;
}


/*
 * 输入两棵二叉树A，B，判断B是不是A的子结构。（ps：我们约定空树不是任意一个树的子结构）
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function HasSubtree($pRoot1, $pRoot2)
{
	// write code here
	if (empty($pRoot2) or empty($pRoot1)) {
		return false;
	}
	return (judge($pRoot1, $pRoot2) or judge($pRoot1->left, $pRoot2) or judge($pRoot1->right, $pRoot2));
}
function judge($pRoot1, $pRoot2)
{
	if (empty($pRoot2)) {
		return true;
	}
	if (empty($pRoot1)) {
		return false;
	}
	if ($pRoot1->val !== $pRoot2->val) {
		return false;
	}
	return (judge($pRoot1->left, $pRoot2->left) and judge($pRoot1->right, $pRoot2->right));
}


/*
 * 操作给定的二叉树，将其变换为源二叉树的镜像
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function Mirror(&$root)
{
	// write code here
	$stack = [];
	$stack[] = $root;
	while (!empty($stack)) {
		$node = array_pop($stack);
		$tmp = $node->left;
		$node->left = $node->right;
		$node->right = $tmp;
		if (!empty($node->left)) {
			$stack[] = $node->left;
		}
		if (!empty($node->right)) {
			$stack[] = $node->right;
		}
	}
}


/*
 * 输入一个矩阵，按照从外向里以顺时针的顺序依次打印出每一个数字，
 * 例如，如果输入如下矩阵： 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16
 * 则依次打印出数字1,2,3,4,8,12,16,15,14,13,9,5,6,7,11,10.
 * */
function printMatrix($matrix)
{
	// write code here
	$row = count($matrix);
	$column = count($matrix[0]);
	$lu = 0;
	$ru = $column - 1;
	$ld = 0;
	$rd = $row - 1;
	$ret = [];
	while (($lu < $ru) && ($ld < $rd)) {
		for ($i = $lu; $i < $ru; $i++) {
			$ret[] = $matrix[$lu][$i];
		}
		for ($i = $lu; $i < $rd; $i++) {
			$ret[] = $matrix[$i][$ru];
		}
		for ($i = $ru; $i > $lu; $i--) {
			$ret[] = $matrix[$rd][$i];
		}
		for ($i = $rd; $i > $lu; $i--) {
			$ret[] = $matrix[$i][$lu];
		}
		$lu++;
		$ru--;
		$rd--;
		$ld++;
	}
	if ($lu == $ru and $ld < $rd) {        //剩一列
		for ($i = $lu; $i <= $rd; $i++) {
			$ret[] = $matrix[$i][$lu];
		}
	}
	if ($lu < $ru and $rd == $ld) {        //剩一行
		for ($i = $lu; $i <= $ru; $i++) {
			$ret[] = $matrix[$lu][$i];
		}
	}

	if ($lu == $ru and $rd == $ld ){
		$ret[] = $matrix[$lu][$ld];
	}
	return $ret;
}


/*
 * 定义栈的数据结构，请在该类型中实现一个能够得到栈最小元素的min函数。
 * */
$stack = [];
function mypush2($node)
{
	global $stack;
	// write code here
	array_push($stack, $node);
}
function mypop2()
{
	global $stack;
	// write code here
	return array_pop($stack);
}
function mytop()
{
	global $stack;
	// write code here
	return $stack[count($stack) - 1];
}
function mymin()
{
	global $stack;
	// write code here
	return min($stack);
}



/*
 * 输入两个整数序列，第一个序列表示栈的压入顺序，请判断第二个序列是否为该栈的弹出顺序。
 * 假设压入栈的所有数字均不相等。例如序列1,2,3,4,5是某栈的压入顺序，序列4，5,3,2,1是该压栈序列对应的一个弹出序列，
 * 但4,3,5,1,2就不可能是该压栈序列的弹出序列。（注意：这两个序列的长度是相等的）
 * */
$stack = [];
function IsPopOrder($pushV, $popV)
{
	// write code here
	global $stack;
	for ($i = 0; $i < count($popV); $i++) {
		while (myTop3() != $popV[$i] || empty($stack)) {
			if (empty($pushV)) {
				return false;
			}
			$node = array_shift($pushV);
			myPush3($node);
		}
		myPop3();
	}
	return true;
}
function myPush3($node)
{
	global $stack;
	array_push($stack, $node);
}
function myPop3()
{
	global $stack;
	array_pop($stack);
}
function myTop3()
{
	global $stack;
	if (empty($stack)) {
		return false;
	}
	return $stack[count($stack) - 1];
}


/*
 * 从上往下打印出二叉树的每个节点，同层节点从左至右打印。
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function PrintFromTopToBottom($root)
{
	// write code here
	$stack = [];    //利用队列进行层序遍历
	$stack[] = $root;
	$ret = [];
	while (!empty($stack)) {
		$node = array_shift($stack);
		$ret[] = $node->val;
		if (!empty($node->left)) {
			$stack[] = $node->left;
		}
		if (!empty($node->right)) {
			$stack[] = $node->right;
		}
	}
	return $ret;
}


/*
 * 输入一个整数数组，判断该数组是不是某二叉搜索树的后序遍历的结果。
 * 如果是则输出Yes,否则输出No。假设输入的数组的任意两个数字都互不相同。
 * */
function VerifySquenceOfBST($sequence)
{
	// write code here
	if (empty($sequence)) {
		return false;
	}
	return judge1($sequence, 0, count($sequence) - 1);
}
function judge1($root, $start, $end)
{
	$count = 0;
	if ($end - $start <= 1) {
		return true;
	}
	for ($i = 0; $i < $end; $i ++) {
		if ($root[$i] > $root[$end]) {
			break;
		}
		$count += 1;
	}
	for ($j = $count; $j < $end; $j ++) {
		if ($root[$j] < $root[$end]) {
			return false;
		}
	}
	$left = true;
	$right = true;
	if ($count > 0){
		$left = judge1($root, $start, $count - 1);
	}
	if ($count < count($root) - 1) {
		$right = judge1($root, $count, $end - 1);
	}
	return ($left && $right);
}


/*
 * 输入一颗二叉树和一个整数，打印出二叉树中结点值的和为输入整数的所有路径。
 * 路径定义为从树的根结点开始往下一直到叶结点所经过的结点形成一条路径。
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}
$path = [];
$stack = [];
$num = 0;*/
function FindPath($root, $expectNumber)
{
	global $num, $stack, $path;
	$judge = function ($root) {
		return (empty($root->left) and empty($root->right));
	};
	if (empty($root)) {
		return $path;
	}
	$stack[] = $root->val;
	$num += $root->val;
	if ($num === $expectNumber and $judge($root)) {
		$tmp = [];
		foreach ($stack as $eachRoot) {
			$tmp[] = $eachRoot;
		}
		$path[] = $tmp;
	}
	if ($num < $expectNumber and !(empty($root->left))) {
		FindPath($root->left, $expectNumber);
	}
	if ($num < $expectNumber and !(empty($root->right))) {
		FindPath($root->right, $expectNumber);
	}
	$num -= $root->val;
	array_pop($stack);
	return $path;
}


/*
 * 输入n个整数，找出其中最小的K个数。例如输入4,5,1,6,2,7,3,8这8个数字，则最小的4个数字是1,2,3,4,。
 * */
function GetLeastNumbers_Solution($input, $k)
{
	// write code here
	if ($k > count($input)) {
		return [];
	}
	sort($input);
	return array_slice($input,0 , $k);
}


/*
 * 数组中有一个数字出现的次数超过数组长度的一半，请找出这个数字。
 * 例如输入一个长度为9的数组{1,2,3,2,2,2,5,4,2}。由于数字2在数组中出现了5次，超过数组长度的一半，因此输出2。如果不存在则输出0。
 * */
function MoreThanHalfNum_Solution($numbers)
{
	// write code here
	$t = intval(count($numbers)/2);
	$count = array_count_values($numbers);
	foreach ($count as $key => $value) {
		if ($value > $t) {
			return $key;
		}
	}
	return 0;
}


/*
 * HZ偶尔会拿些专业问题来忽悠那些非计算机专业的同学。今天测试组开完会后,他又发话了:在古老的一维模式识别中,常常需要计算连续子向量的最大和,
 * 当向量全为正数的时候,问题很好解决。但是,如果向量中包含负数,是否应该包含某个负数,并期望旁边的正数会弥补它呢？
 * 例如:{6,-3,-2,7,-15,1,2,2},连续子向量的最大和为8(从第0个开始,到第3个为止)。你会不会被他忽悠住？(子向量的长度至少是1)
 * */
function FindGreatestSumOfSubArray($array)
{
	// write code here
	$tmp = $array[0];
	$max = $array[0];
	for ($i = 1; $i < count($array); $i++) {
		if ($tmp > 0) {
			$tmp += $array[$i];
		} else {
			$tmp = $array[$i];
		}
		if ($tmp > $max) {
			$max = $tmp;
		}
	}
	return $max;
}


/*
 * 求出1~13的整数中1出现的次数,并算出100~1300的整数中1出现的次数？
 * 为此他特别数了一下1~13中包含1的数字有1、10、11、12、13因此共出现6次,
 * 但是对于后面问题他就没辙了。ACMer希望你们帮帮他,并把问题更加普遍化,可以很快的求出任意非负整数区间中1出现的次数。
 * */
function NumberOf1Between1AndN_Solution($n)
{
	// write code here
	$ret = 0;
	$base = 1;
	$round = $n;
	while ($round > 0) {
		$weight = $round % 10;
		$round =  intval($round/10);
		$ret += $round * $base;
		if ($weight == 1) {
			$ret += ($n % $base) + 1;
		} else if ($weight > 1) {
			$ret += $base;
		}
		$base *= 10;
	}
	return $ret;
}


/*
 * 输入一个正整数数组，把数组里所有数字拼接起来排成一个数，打印能拼接出的所有数字中最小的一个。
 * 例如输入数组{3，32，321}，则打印出这三个数字能排成的最小数字为321323。
 * */
function PrintMinNumber($numbers)
{
	// write code here
	for ($i = 0; $i < count($numbers) - 1; $i++) {
		$flag = true;
		for ($j = $i + 1; $j < count($numbers); $j++) {
			if (parpre($numbers[$i], $numbers[$j])) {
				$flag = false;
				$tmp = $numbers[$i];
				$numbers[$i] = $numbers[$j];
				$numbers[$j] = $tmp;
			}
		}
		if ($flag) {
			break;
		}
	}
	return implode("", $numbers);
}
function parpre($num1, $num2)
{
	$n1 = (string)$num1 . (string)$num2;
	$n2 = (string)$num2 . (string)$num1;
	return intval($n1) > intval($n2);
}


/*
 * 把只包含因子2、3和5的数称作丑数（Ugly Number）。例如6、8都是丑数，但14不是，因为它包含因子7。
 * 习惯上我们把1当做是第一个丑数。求按从小到大的顺序的第N个丑数。
 * */
function GetUglyNumber_Solution($index)
{
	// write code here
	$ret = [];
	$ret[] = 1;
	if ($index < 1) {
		return 0;
	}
	$j = $k = $l =0;
	for ($i = 1; $i < $index; $i++) {
		$ret[$i] = min(min($ret[$j]*2, $ret[$k]*3), $ret[$l]*5);
		if ($ret[$i] == $ret[$j]*2) {
			$j +=1;
		}
		if ($ret[$i] == $ret[$k]*3) {
			$k +=1;
		}
		if ($ret[$i] == $ret[$l]*5) {
			$l +=1;
		}
	}
	return $ret[$index - 1];
}


/*
 * 在一个字符串(1<=字符串长度<=10000，全部由字母组成)中找到第一个只出现一次的字符,并返回它的位置
 * */
function FirstNotRepeatingChar($str)
{
	// write code here
	if (strlen($str) == 0) {
		return -1;
	}
	$str = str_split($str);
	$count = array_count_values($str);
	foreach ($count as $key => $value) {
		if ($value == 1) {
			return array_search($key, $str);
		}
	}
}


/*
 * 输入两个链表，找出它们的第一个公共结点。
 * */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}*/
function FindFirstCommonNode($pHead1, $pHead2)
{
	// write code here
	$count1 = $count2 = 0;
	$p1 = $pHead1;
	$p2 = $pHead2;
	while (!empty($pHead1)) {
		$count1 += 1;
		$pHead1 = $pHead1->next;
	}
	while (!empty($pHead2)) {
		$count2 += 1;
		$pHead2 = $pHead2->next;
	}
	if ($count1 > $count2) {
		$t = $count1 - $count2;
		$pLong = $p1;
		$pShort = $p2;
	} else {
		$t = $count2 - $count1;
		$pLong = $p2;
		$pShort = $p1;
	}
	for ($i = 0; $i < $t; $i++) {
		$pLong = $pLong->next;
	}
	while (!empty($pLong) and !empty($pShort)) {
		if ($pLong === $pShort) {
			return $pLong;
		}
		$pLong = $pLong->next;
		$pShort = $pShort->next;
	}
	return false;
}


/*
 * 统计一个数字在排序数组中出现的次数。
 * */
function GetNumberOfK($data, $k)
{
	// write code here
	$data = array_count_values($data);
	if (!in_array($k, array_keys($data))) {
		return 0;
	} else {
		return $data[$k];
	}
}


/*
 * 输入一棵二叉树，求该树的深度。从根结点到叶结点依次经过的结点（含根、叶结点）形成树的一条路径，最长路径的长度为树的深度。
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function TreeDepth($pRoot)
{
	// write code here
	if (empty($pRoot)) {
		return 0;
	}
	$left = TreeDepth($pRoot->left);
	$right = TreeDepth($pRoot->right);
	$depth = $left > $right?$left:$right;
	return 1 + $depth;
}


/*
 * 输入一棵二叉树，判断该二叉树是否是平衡二叉树。
 * */
/*class TreeNode{
    var $val;
    var $left = NULL;
    var $right = NULL;
    function __construct($val){
        $this->val = $val;
    }
}*/
function IsBalanced_Solution($pRoot)
{
	// write code here
	if (empty($pRoot)) {
		return true;
	}
	$left = depth($pRoot->left);
	$right = depth($pRoot->right);
	if (max($left,$right) - min($left,$right) > 1) {
		return false;
	}
	return IsBalanced_Solution($pRoot->left) && IsBalanced_Solution($pRoot->right);
}

function depth($root)
{
	if (empty($root)) {
		return 0;
	}
	$left = depth($root->left);
	$right = depth($root->right);
	$depth = $left > $right?$left:$right;
	return 1 + $depth;
}


/*
 * 一个整型数组里除了两个数字之外，其他的数字都出现了两次。请写程序找出这两个只出现一次的数字。
 * */
function FindNumsAppearOnce($array)
{
	// write code here
	// return list, 比如[a,b]，其中ab是出现一次的两个数字
	$array = array_count_values($array);
	asort($array);
	$key = array_keys($array);
	return array_slice($key, 0, 2);
}



