<?phpnamespace VGPM\Cmd;class Base {	private $_request = [];	public function __construct() {	}	public function setRequest($data) {		$this->_request = $data;	}	public function postParam($key) {		$ret = filter_input(INPUT_POST, $key);		return $ret;	}	public function getParam($key) {		$ret = filter_input(INPUT_GET, $key);		return $ret;	}	public function outMsg($code = 0, $msg = 'ok') {		header('Content-Type:application/json;charset=UTF-8');		echo json_encode(['code' => $code, 'msg' => $msg], JSON_UNESCAPED_UNICODE);		exit;	}	public function out($data = []) {		header('Content-Type:application/json;charset=UTF-8');		echo json_encode($data, JSON_UNESCAPED_UNICODE);		exit;	}	public function outGrid($total, $rows) {		header('Content-Type:application/json;charset=UTF-8');		$ret = [			'Rows'  => $rows,			'Total' => $total,		];		echo json_encode($ret, JSON_UNESCAPED_UNICODE);		exit;	}	public function where() {		$sdate       = $this->postParam('sdate');		$edate       = $this->postParam('edate');		$player_id   = $this->postParam('player_id');		$server_id   = $this->postParam('server_id');		$consumer_id = $this->postParam('consumer_id');		$sdate       = !empty($sdate) ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d', time() - 7 * 86400);		$edate       = !empty($edate) ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');		$where       = [			'created_at' => [['>=', $sdate . ' 00:00:00'], ['<=', $edate . ' 23:59:59']],		];		if (!empty($player_id)) {			$where['player_id'] = $player_id;		}		if (!empty($server_id)) {			$where['server_id'] = $server_id;		}		if ($consumer_id > 0) {			$where['consumer_id'] = $consumer_id;		}		return $where;	}}