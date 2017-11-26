<?php 
/**
 * 新闻资讯Model
 * @author mwqnice
 * 2017/11/15
 */
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model{

	public function __construct() {
		parent::__construct();
	}

	/**
	 * @desc 获取新闻信息
	 * @param id int
	 * @return $data array 数组
	 * @edittime  2017-11-15
	 */
	public function getNewsInfoById($id){
		if(!$id){
			return array();
			exit();
		}

		$data = M('News')->where("id=$id")->find();
		return $data;
	}

	/**
	 * @desc 获取新闻资讯列表
	 * @param id int
	 * @return $data array 分类数组
	 * @edittime  2017-11-15
	 */
	public function getNewsList($id=0){
		if(!$id){
			return array();
			exit();
		}

		$data = M('News')->where(" status = 1 and cate_id=$id")->order('sort asc,id asc')->select();

		return $data;
	}
	/**
	 * @desc 添加新闻
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function addNews($data){
		if(empty($data)){
			return 0;
			exit();
		}
		$res = M('News')->add($data);
		return $res>0?1:0;
	}
	/**
	 * @desc 修改新闻
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function editNews($data){
		if(empty($data)){
			return 0;
			exit();
		}
		$res = M('News')->save($data);
		return $res>0?1:0;
	}
	/**
	 * @desc 删除新闻
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function delNews($data){
		if(!$data['id']){
			return 0;
			exit();
		}
		$sql 	= "update ".C('DB_PREFIX')."news set status=(status+1)%2 where id=".$data['id'];
		$res 	= M('News')->execute($sql);
		return $res?1:0;
	}
	
	/**
	 * @desc 审核新闻
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function auditNews($data){
		if(!$data['id']){
			return 0;
			exit();
		}
		$sql 	= "update ".C('DB_PREFIX')."news set is_audit=(is_audit+1)%2 where id=".$data['id'];
		$res 	= M('News')->execute($sql);
		return $res?1:0;
	}
	//==================================新闻分类=========================================//

	/**
	 * @desc 获取新闻资讯分类
	 * @param null
	 * @return $data array 分类数组
	 * @edittime  2017-11-15
	 */
	public function getNewsCategory(){

		$data = M('News_category')->field('id,name')->where(" status = 1")->order('sort asc,id asc')->select();

		return $data;
	}

	/**
	 * @desc 获取新闻分类信息
	 * @param id int
	 * @return $data array 数组
	 * @edittime  2017-11-15
	 */
	public function getNewsCateInfoById($id){
		if(!$id){
			return array();
			exit();
		}

		$data = M('News_category')->where("id=$id")->find();
		return $data;
	}
	/**
	 * @desc 添加新闻分类
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function addNewsCategory($data){
		if(empty($data)){
			return 0;
			exit();
		}
		$res = M('News_category')->add($data);
		return $res>0?1:0;
	}
	/**
	 * @desc 修改新闻分类
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function editNewsCategory($data){
		if(empty($data)){
			return 0;
			exit();
		}
		$res = M('News_category')->save($data);
		return $res>0?1:0;
	}
	/**
	 * @desc 删除新闻分类
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function delNewsCategory($data){
		if(!$data['id']){
			return 0;
			exit();
		}
		$sql 	= "update ".C('DB_PREFIX')."news_category set status=(status+1)%2 where id=".$data['id'];
		$res 	= M('News_category')->execute($sql);
		return $res?1:0;
	}
	
	/**
	 * @desc 审核新闻分类
	 * @param data array
	 * @return $res int
	 * @edittime  2017-11-15
	 */
	public function auditNewsCategory($data){
		if(!$data['id']){
			return 0;
			exit();
		}
		$sql 	= "update ".C('DB_PREFIX')."news_category set is_show=(is_show+1)%2 where id=".$data['id'];
		$res 	= M('News_category')->execute($sql);
		return $res?1:0;
	}

	
}
?>
