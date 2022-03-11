<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_data extends Base_Controller
{

    /* for <thead></thead> - Start */
    private $local_th_title         = ['#', '訂單編號','訂單狀態', '客戶名','公司','電子郵件','電話', '國家',"街道","城市","洲","價錢", '動作'];
    private $local_th_width         = ['150px', '', '','', '','','', '','',"","","",""];
    private $local_order_column     = ['id',  '', '' ,'', '', '','','','',"","","","",""];
    private $local_can_order_fields = [0,];

   // private $type                   = ['BRIDAL-GOWNS', 'EVENING-GOWNS'];


   
    /* for <thead></thead> - End */


    //編輯文章參數
    private $param = [
        //																							md 		sm
        ["姓名",		 	"username", 			"text", 			"", 		TRUE, 	"", 	4, 		12],
        ["電話",             "phone",             "text",             "",         FALSE,     "",    4,         12, 2 / 1],
        
        ["住址",                "addr",             "text",             "",         FALSE,     "",    4,         12, 2 / 1],
        ["生日",             "birthday",             "text",             "",         FALSE,     "",     12,         12, 2 / 1],
        ["密碼",             "password",             "text",             "",         FALSE,     "",     12,         12, 2 / 1],
       
        // ["輪播圖1",             "img1",             "img",             "",         FALSE,     "",     0.667,         12, 2 / 1],
        // ["輪播圖2",             "img2",             "img",             "",         FALSE,     "",     0.667,         12, 2 / 1],
        ["信箱",             "email",             "text",             "",         FALSE,     "",     0.667,         12, 2 / 1],
        // ["連結",             "link",             "text",             "",         FALSE,     "",     0.667,         12, 2 / 1],
       
       
       
       

        //["作品介紹",             "content",             "text",             "",         FALSE,     "",     12,         12, 2 / 1],
       // ["購買連結",             "shop_link",             "text",             "",         FALSE,     "",     12,         12, 2 / 1],
        //["獵場類別",		 	"category", 		"select", 			"", 		TRUE, 	"", 	4, 		12, ['id', 'title']],
        //["獵場類別",		 	"classify", 		"select", 			"", 		TRUE, 	"", 	4, 		12, ['id', 'title']],
        //["公告內容",		 	"content", 			"textarea", 			"", 		TRUE, 	"", 	12, 		12],
        //	["公告是否公開",	 	"is_private", 			"select", 			"", 		TRUE, 	"", 	4, 		12, ['id', 'title']],
        /*["審核機制",		 	"header", 			"header", 			"", 		TRUE, 	"", 	12, 		12],
		["審核問題1",		 	"q1",	 			"text", 			"", 		FALSE, 	"", 	12, 		12],
		["審核問題2",		 	"q2",	 			"text", 			"", 		FALSE, 	"", 	12, 		12],
		["審核問題3",		 	"q3",	 			"text", 			"", 		FALSE, 	"", 	12, 		12],*/
    ];

    private $hobby_param = [
        //																							md 		sm
        ["獵場名稱",             "name",             "text",             "",         TRUE,     "",     4,         12],
        ["獵場顯示名稱",        "show_name",             "text",             "",         TRUE,     "",     4,         12],
        ["獵場封面圖",             "banner",             "img_multi_without_crop",             "",         TRUE,     "",     12,         12, 2 / 1],
        ["獵場代表圖",             "content",             "text",             "",         TRUE,     "",     12,         12, 1],
        ["獵場類別",             "category",         "select",             "",         TRUE,     "",     4,         12, ['id', 'title']],
        ["獵場類別",             "classify",         "select",             "",         TRUE,     "",     4,         12, ['id', 'title']],
        ["獵場規則",             "rule",             "textarea",             "",         TRUE,     "",     12,         12],
        ["獵場是否公開",         "is_private",             "select",             "",         TRUE,     "",     4,         12, ['id', 'title']],
        ["審核機制",             "header",             "header",             "",         TRUE,     "",     12,         12],
        ["審核問題1",             "q1",                 "text",             "",         FALSE,     "",     12,         12],
        ["審核問題2",             "q2",                 "text",             "",         FALSE,     "",     12,         12],
        ["審核問題3",             "q3",                 "text",             "",         FALSE,     "",     12,         12],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->is_mgr_login();
        $this->load->model('order_data_model');

        $this->data['active'] = 'order_data';
        $this->action = base_url() . 'mgr/order_data/';
    }

    // ---------------------------------------------------------------------活動列表 start
    public function index()
    {
        
        $this->data = array_merge($this->data, array(
            'sub_active'              => 'order_data',
            'parent'                  => '',
            // 'parent_link'             => base_url() . 'mgr/event/main',
            'custom_del_url'          => base_url() . 'mgr/order_data/local_del',
            'title'                   => '圖片列表',
            'action'                  => $this->action,
            'th_title'                => $this->local_th_title,
            'th_width'                => $this->local_th_width,
            'can_order_fields'        => $this->local_can_order_fields,
            'default_order_column'    => 0,
            'default_order_direction' => 'ASC',
            //'category'                => $this->type, 
            'tool_btns'               => [

                ['add order_data', base_url() . 'mgr/order_data/add', 'btn-primary'],
            ],
        ));
        
        

        $this->load->view('mgr/template_list', $this->data);
    }

    public function data()
    {
        
        //下拉式選單選取
        // if (!isset($_POST["data_type"]))
        //     $data_type = 'BRIDAL-GOWNS';
        // else
        //     $data_type = $_POST["data_type"];
        

        //var_dump($data_type);
          
        $page        = ($this->input->post("page")) ? $this->input->post("page") : 1;
        $search      = ($this->input->post("search")) ? $this->input->post("search") : "";
        $order       = ($this->input->post("order")) ? $this->input->post("order") : 0;
        $direction   = ($this->input->post("direction")) ? $this->input->post("direction") : "ASC";

        $order_column = $this->local_order_column;
        $canbe_search_field = ["id", "name", "item_no","create_date"];

        $syntax = "is_delete= 0   ";
        if ($search != "") {
            $syntax .= " AND (";
            $index = 0;
            foreach ($canbe_search_field as $field) {
                if (
                    $index > 0
                ) $syntax .= " OR ";
                $syntax .= $field . " LIKE '%" . $search . "%'";
                $index++;
            }
            $syntax .= ")";
        }

        $order_by = "id ASC";
        if ($order_column[$order] != "") {
            $order_by = $order_column[$order] . " " . $direction . ", " . $order_by;
        }

        $data = $this->order_data_model->get_local_list($syntax, $order_by, $page, $this->page_count);
        $html = "";
        foreach ($data['list'] as $item) {
            $html .= $this->load->view("mgr/items/order_data_local_item", array(
                "item" =>    $item,
            ), TRUE);
        }
        if ($search != "") $html = preg_replace('/' . $search . '/i', '<mark data-markjs="true">' . $search . '</mark>', $html);

        $this->output(TRUE, "成功", array(
            "html"       =>    $html,
            "page"       =>    $page,
            "total_page" =>    $data['total_page']
        ));
    }


    public function add()
    {
        require('./vendors/autoload.php');
        //require('C:/xampp/htdocs/new_wedding/vendors/autoload.php');
        if ($_POST) {
            $data = $this->process_post_data($this->param);



            var_dump($data);
            if ($this->order_data_model->add($data) !== FALSE) {


                $this->js_output_and_redirect("新增成功", base_url() . "mgr/order_data/index/");
            } else {
                $this->js_output_and_back("發生錯誤");
            }
        } else {
            //$this->data['pics'] = $this->Bulletin_model->get_banner($id);



            $this->data['param'] = $this->param;
            $this->data['title'] = '新增圖片';
            $this->data['sub_active'] =  'order_data';

            $this->data['parent'] = '圖片列表';
            $this->data['parent_link'] = base_url() . "mgr/order_data/index/";

            $this->data['action'] = base_url() . "mgr/order_data/add/";
            $this->data['submit_txt'] = "新增";

            $this->data['select']['type'] = array( ['id' => 'BRIDAL-GOWNS', 'title' => 'BRIDAL-GOWNS'],['id' => 'EVENING-GOWNS', 'title' => 'EVENING-GOWNS']);
            // TODO: 新欄位還沒串


            $this->load->view("mgr/template_form", $this->data);
        }
    }

    public function edit($id)
    {

        require('./vendors/autoload.php');
        //require('C:/xampp/htdocs/new_wedding/vendors/autoload.php');
        $order_data = $this->order_data_model->get_data($id);
        //var_dump($order_data);
        //exit;
        if ($_POST) {
            $data = $this->process_post_data($this->param);

            if ($this->order_data_model->edit($id, $data)) {

                $this->js_output_and_redirect("編輯成功", base_url() . "mgr/order_data/");
            } else {
                $this->js_output_and_back("發生錯誤");
            }
        } else {
            //$this->data['pics'] = $this->order_data_model->get_banner($id);
            $this->data['type'] = 'edit';
            $this->data['param'] = $this->set_data_to_param($this->param, $order_data);
            $this->data['title'] = '編輯照片';
            $this->data['sub_active'] =  'order_data';

            $this->data['parent'] = '圖片列表';
            $this->data['parent_link'] = base_url() . "mgr/order_data/";
            $this->data['select']['type'] = array(['id' => 'EVENING-GOWNS', 'title' => 'EVENING-GOWNS'], ['id' => 'BRIDAL-GOWNS', 'title' => 'BRIDAL-GOWNS']);
            
            $this->data['action'] = base_url() . "mgr/order_data/edit/" . $id;
            $this->data['submit_txt'] = "確認編輯";
            //$this->data['select']['type'] = array(['id' => 'all_order_data', 'title' => 'all_order_data'], ['id' => 'ready_to_wear', 'title' => 'ready_to_wear'],['id' => 'customize', 'title' => 'customize'],['id' => 'order_data', 'title' => 'order_data']);
            // TODO: 新欄位還沒串
            //$this->data['select']['category'] = $this->order_data_model->get_hobby_order_data_classify();
            //$this->data['classify'] = json_encode($this->data['select']['category']);
            //$this->data['select']['is_private'] = array(['id' => 1, 'title' => '公開'], ['id' => 0, 'title' => '不公開']);
            // TODO: 新欄位還沒串
            // !d($this->data);
            // exit;

           // var_dump($this->data['select']['type']);
            //exit;
            $this->load->view("mgr/template_form", $this->data);
        }
    }

    public function local_del($id)
    {
        //$id = $this->input->post('id');

        // var_dump($id);
        if (!is_numeric($id)) $this->output(FALSE, '發生錯誤');
        if ($this->order_data_model->edit($id, array('is_delete' => 1))) {
            //$this->output(TRUE, 'success');
            $this->js_output_and_redirect("刪除成功", base_url() . "mgr/order_data/");
        } else {
            $this->output(FALSE, 'fail');
        }
    }
    // ----------------------------------------------------------------活動列表 end

    // ----------------------------------------------------------------文章列表 start
    public function post_list($order_data_id)
    {
        $order_data = $this->order_data_model->get_data($order_data_id);
        $this->data = array_merge($this->data, array(
            'sub_active'              => 'order_data_MGR_LOCAL',
            'parent'                  => ($order_data['type'] == 'local') ? '在地獵場列表' : '同好獵場',
            'parent_link'             => ($order_data['type'] == 'local') ? base_url() . 'mgr/huntground/local' : base_url() . 'mgr/huntground/hobby',
            'custom_data_url'          => base_url() . 'mgr/order_data/post_data/' . $order_data_id,
            'title'                   => '【' . $order_data['name'] . '】的文章列表',
            'action'                  => $this->action,
            'th_title'                => $this->post_th_title,
            'th_width'                => $this->post_th_width,
            'can_order_fields'        => $this->post_can_order_fields,
            'default_order_column'    => 0,
            'default_order_direction' => 'ASC',
            'tool_btns'               => [
                // ['新增抽獎活動', base_url() . 'mgr/event/list_add', 'btn-primary'],
            ],
        ));

        $this->load->view('mgr/home_template_list', $this->data);
    }

    public function post_data($order_data_id)
    {
        $page        = ($this->input->post("page"))            ? $this->input->post("page")        : 1;
        $search      = ($this->input->post("search"))        ? $this->input->post("search")        : '';
        $order       = ($this->input->post("order"))        ? $this->input->post("order")        : 0;
        $direction   = ($this->input->post("direction"))    ? $this->input->post("direction")     : 'DESC';
        $status       = ($this->input->post("status"))        ? $this->input->post("status")        : 'ALL';
        $user_id     = ($this->input->post("user_id"))        ? $this->input->post("user_id")        : 0;

        $order_data = $this->order_data_model->get_data($order_data_id);

        $syntax    = "P.is_delete=0 AND post_at='order_data' AND relation_id='$order_data_id'";
        if ($status != 'ALL')
            $syntax .= " AND ( P.`status` = '" . $status . "' )";

        // set SQL : ORDER BY
        $order_by = ' P.`create_date` DESC';
        if ($this->hobby_order_column[$order] != '')
            $order_by = '`' . $this->hobby_order_column[$order] . '` ' . $direction . ', ' . $order_by;

        $lists = $this->order_data_model->get_post_list($syntax, $order_by, intval($page), $page_count = 20);

        // Combine item html
        $html = '';

        if ($search !== '') {
            $lists['data'] = &$this->set_search_lists($search, $lists['data'], $this->post_canbe_search_field);
        }

        foreach ($lists['list'] as $item) {
            $html .= $this->load->view("mgr/items/huntground_post_item", array(
                'item' => $item,
                'order_data' => $order_data,
            ), TRUE);
        }

        $this->output(TRUE, '資料取得成功', array(
            'html'             => $html,
            'page'             => $page,
            'total_page'     => $lists['total_page'],
        ));
    }

    // ----------------------------------------------------------------文章列表 end

    // ----------------------------------------------------------------同好獵場 start
    public function hobby()
    {
        $this->data = array_merge($this->data, array(
            'sub_active'              => 'HUNTGROUND_HOBBY',
            'parent'                  => '',
            // 'parent_link'             => base_url() . 'mgr/event/main',
            'custom_data_url'          => base_url() . 'mgr/huntground/hobby_data',
            'custom_del_url'          => base_url() . 'mgr/huntground/hobby_del',
            'title'                   => '同好獵場列表',
            'action'                  => $this->action,
            'th_title'                => $this->hobby_th_title,
            'th_width'                => $this->hobby_th_width,
            'can_order_fields'        => $this->hobby_can_order_fields,
            'default_order_column'    => 0,
            'default_order_direction' => 'ASC',
            'tool_btns'               => [
                ['新增同好獵場', base_url() . 'mgr/huntground/hobby_add', 'btn-primary'],
            ],
        ));

        $this->load->view('mgr/template_list', $this->data);
    }

    public function hobby_data()
    {
        $page        = ($this->input->post("page")) ? $this->input->post("page") : 1;
        $search      = ($this->input->post("search")) ? $this->input->post("search") : "";
        $order       = ($this->input->post("order")) ? $this->input->post("order") : 0;
        $direction   = ($this->input->post("direction")) ? $this->input->post("direction") : "ASC";

        $order_column = $this->local_order_column;
        $canbe_search_field = ["id", "title", "rule", "start_datetime", "end_datetime", "create_date"];

        $syntax = "is_delete=0 ";
        if ($search != "") {
            $syntax .= " AND (";
            $index = 0;
            foreach ($canbe_search_field as $field) {
                if (
                    $index > 0
                ) $syntax .= " OR ";
                $syntax .= $field . " LIKE '%" . $search . "%'";
                $index++;
            }
            $syntax .= ")";
        }

        $order_by = "id ASC";
        if ($order_column[$order] != "") {
            $order_by = $order_column[$order] . " " . $direction . ", " . $order_by;
        }

        $data = $this->order_data_model->get_local_list($syntax, $order_by, $page, $this->page_count);
        $html = "";
        foreach ($data['list'] as $item) {
            $html .= $this->load->view("mgr/items/order_data_local_item", array(
                "item" =>    $item,
            ), TRUE);
        }
        if ($search != "") $html = preg_replace('/' . $search . '/i', '<mark data-markjs="true">' . $search . '</mark>', $html);

        $this->output(TRUE, "成功", array(
            "html"       =>    $html,
            "page"       =>    $page,
            "total_page" =>    $data['total_page']
        ));
    }

    public function hobby_add()
    {
        if ($_POST) {
            require('./vendor/autoload.php');
            $data = $this->process_post_data($this->hobby_param);
            // TODO: 新欄位還沒串
            if ($this->order_data_model->edit($id, $data)) {
                $this->js_output_and_redirect("編輯成功", base_url() . "mgr/huntground/local/");
            } else {
                $this->js_output_and_back("發生錯誤");
            }
        } else {
            $this->data['title'] = '新增獵場';
            $this->data['sub_active'] = 'HUNTGROUND_HOBBY';

            $this->data['parent'] = '同好獵場列表';
            $this->data['parent_link'] = base_url() . "mgr/huntground/hobby";

            $this->data['action'] = base_url() . "mgr/huntground/hobby_add";
            $this->data['submit_txt'] = "新增";
            $this->data['param'] = $this->hobby_param;
            $this->data['select']['category'] = $this->order_data_model->get_hobby_order_data_classify();
            $this->data['classify'] = json_encode($this->data['select']['category']);
            $this->data['select']['is_private'] = array(['id' => 1, 'title' => '公開'], ['id' => 0, 'title' => '不公開']);

            $this->load->view("mgr/order_data_form", $this->data);
        }
    }

    // ----------------------------------------------------------------同好獵場 end
}
