<?php   if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 数据库操作类
 *
 * @version        $Id: dsql.class.php 2013-7-13 下午18:04:40 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

class dsql extends db_connect{
    /**
	 * 保存或生成一个DB对象，设定盐的长度
	 *
	 * @param object $db 数据库对象
	 * @param int $saltLength 密码盐的长度
	 */
    public $querynum = 0;  //查询的次数

    public $querysql = "";

    function __construct($db=NULL){
		parent::__construct($db);
    }

    function dsql(){
        $this->__construct();
    }

	/**
	 * 取得数据库的表信息
	 * @access function
	 * @return array
	 */
	function getTables() {
		try{
			$stmt = $this->db->prepare("SHOW TABLES");

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_NUM);
			$stmt->closeCursor();

			$tabs = array();
			foreach($results as $tab => $tbname){
				$state = $this->getTableState("SHOW TABLE STATUS LIKE '%s'", $tbname[0]);
				$tabs[$tab]['name'] = $tbname[0];
				$tabs[$tab]['Rows'] = $state[0]['Rows'];
				$tabs[$tab]['Data_length'] = sizeformat($state[0]['Data_length']);
				$tabs[$tab]['Comment'] = $state[0]['Comment'];
			}
			return $tabs;

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	/**
	 * 取得数据表的详细信息
	 * @access function
	 * @return array
	 */
	function getTableState($sql, $table = ''){
		$sql = sprintf($sql, $table);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * 取得表字段
	 * @access function
	 * @return array
	 */
	function getTableFields($table = ''){
		$stmt = $this->db->prepare("SELECT * FROM `".$table."`");
		$stmt->execute();
		$fields = array();
		for($i=0; $i<$stmt->columnCount(); $i++) {
			$meta = $stmt->getColumnMeta($i);
    		array_push($fields, $meta['name']);
  		}
		return $fields;
	}

	/**
	 * 优化所有表
	 * @access function
	 * @return string
	 */
	function optimizeAllTables() {
		try{
			$stmt = $this->db->prepare("SHOW TABLES");

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_NUM);
			$stmt->closeCursor();

			foreach($results as $tab => $tbname){
				$this->optimizeTables($tbname[0]);
			}
			return json_encode("优化成功！");

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	/**
	 * 优化表
	 *
	 * @param string $tables table1,table2,table3....
	 * @return tables
	 */
	public function optimizeTables($table) {
		$sql = sprintf('OPTIMIZE TABLE %s', $table);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * 修复所有表
	 * @access function
	 * @return string
	 */
	function repairAllTables() {
		try{
			$stmt = $this->db->prepare("SHOW TABLES");

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_NUM);
			$stmt->closeCursor();

			foreach($results as $tab => $tbname){
				$this->repairTables($tbname[0]);
			}
			return json_encode("修复成功！");

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	/**
	 * 修复表
	 *
	 * @param string $tables table1,table2,table3....
	 * @return tables
	 */
	public function repairTables($table) {
		$sql = sprintf('REPAIR TABLE %s EXTENDED', $table);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $results;
	}


    /**
     *  获取指定ID的分类
     *
     * @param     int    $id  大类ID
     * @return    array
     */
    function getOptionList($id=0, $action){
		$sql = $this->SetQuery("SELECT `id`, `typename` FROM `#@__".$action."type` WHERE `parentid` = $id ORDER BY 'weight'");
		try{
			$stmt = $this->db->prepare($sql);

			if(!empty($id)){
				$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			}

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

			return $results;

		}catch(Exception $e){
			die($e->getMessage());
		}
    }

	/**
     *  遍历所有分类
     *
     * @return    array
     */
	function getTypeList($id=0, $tab, $son = true, $page = 1, $pageSize = 100000, $cond = ""){
		$page = empty($page) ? 1 : $page;
		$pageSize = empty($pageSize) ? 1000 : $pageSize;
		$atpage = $pageSize*($page-1);
		$where = " LIMIT $atpage, $pageSize";
		$return = array();

		$id = (int)$id;
		$page = (int)$page;
		$pageSize = (int)$pageSize;

		$sql = $this->SetQuery("SELECT * FROM `#@__".$tab."` WHERE `parentid` = $id".$cond." ORDER BY `weight`".$where);

		try{
			$stmt = $this->db->prepare($sql);

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count   = $stmt->rowCount();
			$stmt->closeCursor();

			if($results && $count > 0){//如果有子类

				foreach($results as $k => $v){
					$return[$k]['id']       = $v['id'];
					$return[$k]['parentid'] = $v['parentid'];
					$return[$k]['typename'] = $v['typename'];

					//区域或地铁信息不需要链接地址
					if(!strpos($tab, "addr") && !strpos($tab, "subway") && !strpos($tab, "site_area")){

            $par = array(
    					"service"     => preg_replace("/_?type/", "", preg_replace("/_?news/", "", preg_replace("/_?newstype/", "", $tab))),
    					"template"    => "list",
    					"typeid"      => $v['id']
    				);

						$return[$k]["url"]    = getUrlPath($par);
					}

					//区域需要把城市天气ID和城市拼音输出
					if($tab == "site_area"){
						$return[$k]["pinyin"] = $v['pinyin'];
						$return[$k]["weather_code"] = $v['weather_code'];
					}

                    //新闻、图片特殊字段【拼音、拼音首字母】
                    if($tab == "articletype" || $tab == "imagetype"){
                        $return[$k]["pinyin"] = $v['pinyin'];
                        $return[$k]["py"] = $v['py'];
                    }

					//团购特殊用法【热门、文字颜色】
					if($tab == "tuantype" || $tab == "tuanaddr"){
						$return[$k]['hot'] = $v['hot'];
						if($tab != "tuanaddr"){
							$return[$k]['color'] = $v['color'];
						}
					}


					//房产特殊用法【区域坐标】
					if($tab == "houseaddr"){
						$return[$k]['longitude'] = $v['longitude'];
						$return[$k]['latitude'] = $v['latitude'];
					}


					if($son){
						$return[$k]["lower"] = $this->getTypeList($v['id'], $tab, $son, 1, 100000, $cond);
					}else{
						$sql = $this->SetQuery("SELECT `id` FROM `#@__".$tab."` WHERE `parentid` = ".$v['id']);
						$stmt = $this->db->prepare($sql);
						$stmt->execute();
						$count   = $stmt->rowCount();
						$stmt->closeCursor();
						if($count > 0){
							$return[$k]["lower"] = $count;
						}
					}
				}

				return $return;
			}else{
				return "";
			}

		}catch(Exception $e){
			return '{"state": 200, "info": "分类获取失败！"}';
		}

	}

	/**
     *  获取分类名称
     *
     * @access    public
     * @param     int    $id  大类ID
     * @return    array
     */
    function getTypeName($sql){
		try{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

			return $results;

		}catch(Exception $e){
			die($e->getMessage());
		}
    }

	/**
     * 执行SQL
     *
	 * @param     string $sql 要操作的sql语句
     * @return    json
     */
	public function dsqlOper($sql, $type, $fetch = "ASSOC"){
		try{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$this->querynum++;
			$this->querysql .= $sql."<br />";

			//最后一次插入的ID
			if($type == "lastid"){
				return $this->db->lastInsertId();

			//总条数
			}else if($type == "totalCount"){
				return $stmt->rowCount();

			//数据列表
			}else if($type == "results"){
				if($fetch == "ASSOC"){
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}elseif($fetch == "NUM"){
					return $stmt->fetchAll(PDO::FETCH_NUM);
				}

			//更新数据
			}else if($type == "update"){
				return "ok";
			}

			$stmt->closeCursor();

		}catch(Exception $e){
			return '{"state": 200, "info": "操作失败！"}';
		}
	}


    /**
     * 获取数据库的版本信息
     * @return array
     */
    public function getDriverVersion(){
        return $this->db->getAttribute(PDO::ATTR_SERVER_VERSION);
    }


    /**
     * 获取数据库的大小尺寸
     * @return array
     */
    public function getDriverSize(){
        return $this->db->getAttribute(PDO::ATTR_PERSISTENT);
    }

}
