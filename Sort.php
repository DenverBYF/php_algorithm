<?php
/**
 * Created by PhpStorm.
 * User: denverb
 * Date: 18/2/26
 * Time: 下午6:28
 */

/*
 * 各种排序算法
 * */
class Sort
{
	public $data;
	public function __construct($data)
	{
		$this->data = $data;
	}

	/*
	 * 选择排序
	 * 每一次从待排序的数据中选择出最大或者最小的一个元素。放在序列的开始位置。
	 * */
	public function selectionSort()
	{
		$len = count($this->data);
		for ($i = 0; $i < $len - 1; $i ++) {
			//每次都默认第一个是最小值
			$min = $i;
			for ($j = $i + 1; $j < $len; $j ++) {
				if ($this->data[$j] < $this->data[$min]) {
					$min = $j;
				}
			}
			if ($min !== $i) {
				self::swap($this->data[$i], $this->data[$min]);
			}
		}
		return $this->data;
	}

	/*
	 * 冒泡排序
	 * 加入$flag进行优化
	 * */
	public function bubbleSort()
	{
		$len = count(($this->data));
		for ($i = 0; $i < $len - 1; $i ++) {
			$flag = true;
			for ($j = $i + 1; $j < $len; $j ++) {
				if ($this->data[$j] < $this->data[$i]) {
					$flag = false;
					self::swap($this->data[$j], $this->data[$i]);
				}
			}
			if ($flag) {
				break;
			}
		}
		return $this->data;
	}

	/*
	 * 快速排序
	 * 将数据分割成独立的两部分,其中一部分数据比另一部分所有数据都要小,然后再按此方法对两部分数据分别进行排序。
	 * */
	public function quickSort($data)
	{
		$len = count($data);
		if ($len <= 1) {
			return $data;
		}
		$base = $min = $max =[];
		$baseItem = $data[0];
		for ($i = 0; $i < $len; $i ++) {
			if ($data[$i] < $baseItem) {
				$min[] = $data[$i];
			} elseif ($data[$i] > $baseItem) {
				$max[] = $data[$i];
			} else {
				$base[] = $data[$i];
			}
		}
		$min = $this->quickSort($min);
		$max = $this->quickSort($max);
		return array_merge($min, $base, $max);
	}

	/*
	 * 插入排序
	 * */
	public function insertSort()
	{
		$len = count($this->data);
		for ($i = 1; $i < $len; $i ++) {
			$tmp = $this->data[$i];
			for ($j = $i - 1; $j >= 0 && $this->data[$j] > $tmp; $j --) {
				$this->data[$j + 1] = $this->data[$j];
			}
			$this->data[$j + 1] = $tmp;
		}
		return $this->data;
	}

	/*
	 * 希尔排序
	 * 选取增量进行分组,每一组使用插入排序
	 * */
	public function shellSort()
	{
		$len = count($this->data);
		$inc = intval($len / 2);
		while ($inc > 1) {
			for ($i = $inc; $i < $len; $i ++) {
				$tmp = $this->data[$i];
				for ($j = $i - $inc; $j >= 0 && $this->data[$j] > $this->data[$j + $inc]; $j -= $inc) {
					$this->data[$j + $inc] = $this->data[$j];
				}
				$this->data[$j + $inc] = $tmp;
			}
			$inc = intval($inc / 2);
		}
		return $this->data;
	}

	/*
	 * 归并排序
	 * */
	public function mergeSort($data)
	{
		$len = count($data);
		if ($len <= 1) {
			return $data;
		}
		$mid = intval($len / 2);
		$leftArray = array_slice($data, 0, $mid);
		$rightArray = array_slice($data, $mid);
		$left = self::mergeSort($leftArray);
		$right = self::mergeSort($rightArray);
		$ret = self::arrayMerge($left, $right);
		return $ret;
	}

	/*
	 * 有序合并两个数组
	 * */
	protected function arrayMerge($arr1, $arr2)
	{
		$ret = [];
		while (count($arr1) && count($arr2)) {
			$ret[] = $arr1[0] < $arr2[0]?array_shift($arr1):array_shift($arr2);
		}
		return array_merge($ret, $arr1, $arr2);
	}

	/*
	 * 堆排序
	 * */
	public function heapSort()
	{
		$len = count($this->data);
		self::buildHeap($this->data, $len);
		for ($i = $len - 1; $i > 0; $i --) {
			self::swap($this->data[$i], $this->data[0]);
			$len --;
			self::buildHeap($this->data, $len);
		}
		return $this->data;
	}

	/*
	 * 建立堆结构
	 * */
	protected function buildHeap(&$array, $len)
	{
		for ($index = intval($len / 2) - 1; $index >= 0; $index --) {
			$left = $index * 2 + 1;
			$right = $index * 2 + 2;
			if ($left < $len) {
				$max = $left;
				if ($right < $len && $array[$right] > $array[$max]) {
					$max = $right;
				}
				if ($array[$max] > $array[$index]) {
					self::swap($array[$max], $array[$index]);
				}
			}
		}
	}

	protected function swap(&$a, &$b)
	{
		$a = $a ^ $b;
		$b = $a ^ $b;
		$a = $a ^ $b;
	}
}
